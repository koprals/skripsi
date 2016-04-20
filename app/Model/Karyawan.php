<?php
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
class Karyawan extends AppModel
{
	public $name = "Karyawan";

	public function beforeSave($options = array())
	{
		if(!empty($this->data[$this->name]['password'])) {
				$passwordHasher = new SimplePasswordHasher();
			    $this->data[$this->name]['password'] 	= $passwordHasher->hash(
				strtolower($this->data[$this->name]['password'])
			    );
			$this->data[$this->name]['username']	=	strtolower($this->data[$this->name]['username']);
		}
		return true;
	}
	
	public function ValidateAdmin()
	{
		$this->validate	=	array(
			'username' => array(
				'notEmpty' => array(
					'rule' => "notEmpty",
					'message' => "Please insert your username"
				)
			),
			'password' => array(
				'notEmpty' => array(
					'rule' => "notEmpty",
					'message' => "Please insert your password"
				)
			)
		);
	}

	public function BindImageContent($reset	=	true)
	{
		$this->bindModel(array(
			"hasOne"	=>	array(
				"Big"	=>	array(
					"className"		=>	"Content",
					"foreignKey"	=>	"model_id",
					"conditions"	=>	array(
						"Big.model"	=>	$this->name,
						"Big.type"	=>	"big"
					)
				)
			)
		),$reset);
	}
	
	function VirtualFieldActivated()
	{
		$this->virtualFields = array(
			'SKelamin'		=> 'IF(('.$this->name.'.jenis_kelamin=\'0\'),\'Laki-Laki\',\'Perempuan\')',
			'SAgama'		=> "IF(".$this->name.".agama=0, 'Buddha', IF(".$this->name.".agama=1, 'Hindu', IF(".$this->name.".agama=2, 'Kristen Katolik', IF(".$this->name.".agama=3, 'Kristen Protestan', 'Islam'))))",
			'SPendidikan'	=> "IF(".$this->name.".pendidikan=0, 'SMA', IF(".$this->name.".pendidikan=1, 'S1', IF(".$this->name.".pendidikan=2, 'S2', 'S3')))"
		);
	}
	
	function ValidateAdd()
	{
		App::uses('CakeNumber', 'Utility');
		$this->validate 	= array(
			'nama' => array(
				'notEmpty' => array(
					'rule' => "notEmpty",
					'message' => "Please insert data"
				)
			),
			'username' => array(
				'notEmpty' => array(
					'rule' => "notEmpty",
					'message' => "Please insert data"
				)
			),
			'password' => array(
				'notEmpty' => array(
					'rule' => "notEmpty",
					'message' => "Please insert data"
				)
			),
			'no_ktp' => array(
				'notEmpty' => array(
					'rule' => "notEmpty",
					'message' => "Please insert data"
				)
			),
			'alamat' => array(
				'notEmpty' => array(
					'rule' => "notEmpty",
					'message' => "Please insert data"
				)
			),
			'jenis_kelamin' => array(
				'notEmpty' => array(
					'rule' => "notEmpty",
					'message' => "Please insert data"
				)
			),
			'tempat_lahir' => array(
				'notEmpty' => array(
					'rule' => "notEmpty",
					'message' => "Please insert data"
				)
			),
			'agama' => array(
				'notEmpty' => array(
					'rule' => "notEmpty",
					'message' => "Please insert data"
				)
			),
			'telepon' => array(
				'notEmpty' => array(
					'rule' => "notEmpty",
					'message' => "Please insert State Name"
				)
			),
			'pendidikan' => array(
				'notEmpty' => array(
					'rule' => "notEmpty",
					'message' => "Please insert State Name"
				)
			),
			'role' => array(
				'notEmpty' => array(
					'rule' => "notEmpty",
					'message' => "Please insert State Name"
				)
			),
			'nik_karyawan' => array(
				'rule' => 'isUnique',
				"message" => 'This NIK Karyawan has already been taken'
			)
		);
	}
	
	function ValidateEdit()
	{
		App::uses('CakeNumber', 'Utility');
		$this->validate 	= array(
			"id"	=>	array(
				'notEmpty' => array(
					'rule' => "notEmpty",
					'message' => 'Sorry we cannot find your ID.'	
				),
				'IsExists' => array(
					'rule' => "IsExists",
					'message' => 'Sorry we cannot find your details data.'	
				)
			),
			'nama' => array(
				'notEmpty' => array(
					'rule' => "notEmpty",
					'message' => "Please insert data"
				)
			),
			'username' => array(
				'notEmpty' => array(
					'rule' => "notEmpty",
					'message' => "Please insert data"
				)
			),
			'password' => array(
				'notEmpty' => array(
					'rule' => "notEmpty",
					'message' => "Please insert data"
				)
			),
			'no_ktp' => array(
				'notEmpty' => array(
					'rule' => "notEmpty",
					'message' => "Please insert data"
				)
			),
			'alamat' => array(
				'notEmpty' => array(
					'rule' => "notEmpty",
					'message' => "Please insert data"
				)
			),
			'jenis_kelamin' => array(
				'notEmpty' => array(
					'rule' => "notEmpty",
					'message' => "Please insert data"
				)
			),
			'tempat_lahir' => array(
				'notEmpty' => array(
					'rule' => "notEmpty",
					'message' => "Please insert data"
				)
			),
			'agama' => array(
				'notEmpty' => array(
					'rule' => "notEmpty",
					'message' => "Please insert data"
				)
			),
			'telepon' => array(
				'notEmpty' => array(
					'rule' => "notEmpty",
					'message' => "Please insert State Name"
				)
			),
			'pendidikan' => array(
				'notEmpty' => array(
					'rule' => "notEmpty",
					'message' => "Please insert State Name"
				)
			),
			'role' => array(
				'notEmpty' => array(
					'rule' => "notEmpty",
					'message' => "Please insert State Name"
				)
			),
		);
	}
	function IsExists($fields = array())
	{
		foreach($fields as $key=>$value)
		{
			$data	=	$this->findById($value);
			if(!empty($data)) return true;
		}
		return false;
	}
	function size( $field=array(), $aloowedsize) 
    {
		foreach( $field as $key => $value ){
            $size = intval($value['size']);
            if($size > $aloowedsize) {
                return FALSE;
            } else {
                continue;
            }
        }
        return TRUE;
    }
	
	
	function notEmptyImage($fields = array())
	{
		foreach($fields as $key=>$value)
		{
			if(empty($value['name']))
			{
				return false;
			}
		}
		
		return true;
	}
	function validateName($file=array(),$ext=array())
	{
		$err	=	array();
		$i=0;
		
		foreach($file as $file)
		{
			$i++;
			
			if(!empty($file['name']))
			{
				if(!Validation::extension($file['name'], $ext))
				{
					return false;
				}
			}
		}
		return true;
	}
	
	function imagewidth($field=array(), $allowwidth=0)
	{
		
		foreach( $field as $key => $value ){
			if(!empty($value['name']))
			{
				$imgInfo	= getimagesize($value['tmp_name']);
				$width		= $imgInfo[0];
				
				if($width < $allowwidth)
				{
					return false;
				}
			}
        }
        return TRUE;
	}
	
	function imageheight($field=array(), $allowheight=0)
	{
		
		foreach( $field as $key => $value ){
			if(!empty($value['name']))
			{
				$imgInfo	= getimagesize($value['tmp_name']);
				$height		= $imgInfo[1];
				
				if($height < $allowheight)
				{
					return false;
				}
			}
        }
        return TRUE;
	}
}
?>