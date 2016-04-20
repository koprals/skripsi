<?php
class ProfilJabatan extends AppModel
{
	public $name = "ProfilJabatan";
	public $displayField = 'nama_jabatan';

	
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
			'SStatus'		=> 'IF(('.$this->name.'.status=\'1\'),\'Active\',\'Hide\')',
		);
	}
	
	function ValidateAdd()
	{
		App::uses('CakeNumber', 'Utility');
		$this->validate = array(
			'nama_jabatan' => array(
					'rule' => "checkName",
					'message' => "Nama Jabatan has been used"
				),
			'common_sense' => array(
				'notEmpty' => array(
					'rule' => "notEmpty",
					'message' => "Please insert data"
				)
			),
			'verbalisasi_ide' => array(
				'notEmpty' => array(
					'rule' => "notEmpty",
					'message' => "Please insert data"
				)
			),
			'sistematika_berpikir' => array(
				'notEmpty' => array(
					'rule' => "notEmpty",
					'message' => "Please insert data"
				)
			),
			'penalaran' => array(
				'notEmpty' => array(
					'rule' => "notEmpty",
					'message' => "Please insert data"
				)
			),
			'konsentrasi' => array(
				'notEmpty' => array(
					'rule' => "notEmpty",
					'message' => "Please insert data"
				)
			),
			'logika_praktis' => array(
				'notEmpty' => array(
					'rule' => "notEmpty",
					'message' => "Please insert data"
				)
			),
			'fleksibilitas_berpikir' => array(
				'notEmpty' => array(
					'rule' => "notEmpty",
					'message' => "Please insert data"
				)
			),
			'imajinasi' => array(
				'notEmpty' => array(
					'rule' => "notEmpty",
					'message' => "Please insert data"
				)
			),
			'antisipasi' => array(
				'notEmpty' => array(
					'rule' => "notEmpty",
					'message' => "Please insert data"
				)
			),
			'iq' => array(
				'notEmpty' => array(
					'rule' => "notEmpty",
					'message' => "Please insert data"
				)
			),
			'energi_sikis' => array(
				'notEmpty' => array(
					'rule' => "notEmpty",
					'message' => "Please insert data"
				)
			),
			'ketelitian' => array(
				'notEmpty' => array(
					'rule' => "notEmpty",
					'message' => "Please insert data"
				)
			),
			'kehatian' => array(
				'notEmpty' => array(
					'rule' => "notEmpty",
					'message' => "Please insert data"
				)
			),
			'pengendalian_perasaan' => array(
				'notEmpty' => array(
					'rule' => "notEmpty",
					'message' => "Please insert data"
				)
			),
			'dorongan_prestasi' => array(
				'notEmpty' => array(
					'rule' => "notEmpty",
					'message' => "Please insert data"
				)
			),
			'perencanaan' => array(
				'notEmpty' => array(
					'rule' => "notEmpty",
					'message' => "Please insert data"
				)
			),
			'kekuasaan' => array(
				'notEmpty' => array(
					'rule' => "notEmpty",
					'message' => "Please insert data"
				)
			),
			'pengaruh' => array(
				'notEmpty' => array(
					'rule' => "notEmpty",
					'message' => "Please insert data"
				)
			),
			'keteguhan_hati' => array(
				'notEmpty' => array(
					'rule' => "notEmpty",
					'message' => "Please insert data"
				)
			),
			'pemenuhan' => array(
				'notEmpty' => array(
					'rule' => "notEmpty",
					'message' => "Please insert data"
				)
			),
			'presentase_bobot_pengetahuan' => array(
				'notEmpty' => array(
					'rule' => "notEmpty",
					'message' => "Please insert data"
				)
			),
			'presentase_bobot_sikap_kerja' => array(
				'notEmpty' => array(
					'rule' => "notEmpty",
					'message' => "Please insert data"
				)
			),
			'presentase_bobot_prilaku' => array(
				'notEmpty' => array(
					'rule' => "notEmpty",
					'message' => "Please insert data"
				)
			),
		);
	}

	function checkName($check)
	{
		$conditions = array(
			'ProfilJabatan.nama_jabatan' => $this->data['ProfilJabatan']['nama_jabatan']
			);
				if (array_key_exists('id', $this->data['ProfilJabatan'])) {
		                $conditions['ProfilJabatan.id <>'] = $this->data['ProfilJabatan']['id'];
		            }
		            $result = $this->find('count', array('conditions' => $conditions));
		      		return ($result <= 0);
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
			'name' => array(
				'notEmpty' => array(
					'rule' => "notEmpty",
					'message' => "Please insert State name"
				)
			)
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