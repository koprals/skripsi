<?php
class HasilAkhirsController extends AppController
{
	var $uses			=	"HasilAkhir";
	var $ControllerName	=	"HasilAkhirs";
	var $ModelName		=	"HasilAkhir";
	var $helpers		=	array("Text");

	function beforeFilter()
	{
		parent::beforeFilter();
		$this->set("ControllerName",$this->ControllerName);
		$this->set("ModelName",$this->ModelName);
		$this->set('lft_menu_category_id',"2");
	}
	
	function Laporan()
	{
		$this->Session->delete("Search.".$this->ControllerName);
		$this->Session->delete('Search.'.$this->ControllerName.'Operand');

		$this->loadModel('ProfilJabatan');
		$profilJabatans = $this->ProfilJabatan->find('list', array(
			'fields' => 'nama_jabatan'
			)
		);
		 $this->set(compact('profilJabatans'));
	}

	function ListItem()
	{
		$this->layout = 'ajax';
		$this->loadModel($this->ModelName);

		//DEFINE LAYOUT, LIMIT AND OPERAND
		$viewpage			=	empty($this->params['named']['limit']) ? 50 : $this->params['named']['limit'];
		$order				=	array("{$this->ModelName}.total_akhir" => "DESC");
		$operand			=	"AND";

		//DEFINE SEARCH DATA
		if(!empty($this->request->data))
		{
			$cond_search	=	array();
			if(isset($this->request->data[$this->ModelName]['operator'])) {
				$operand		=	$this->request->data[$this->ModelName]['operator'];
			} else {
				$operand		=	null;
			}

			$this->Session->delete('Search.'.$this->ControllerName);

			if(!empty($this->request->data['Search']['profil_jabatan_id']))
			{
				$cond_search["Gap.profil_jabatan_id"] = $this->data['Search']['profil_jabatan_id'];
			}

			if(!empty($this->request->data['Search']['year']))
			{
				$cond_search["{$this->ModelName}.created BETWEEN ? AND ?"] = array($this->request->data['Search']['year']."-01-01 00:00:00",$this->request->data['Search']['year']."-12-31 23:59:59");
			}

			if($this->request->data["Search"]['reset']=="0")
			{
				$this->Session->write("Search.".$this->ControllerName,$cond_search);
				$this->Session->write('Search.'.$this->ControllerName.'Operand',$operand);
			}

			$this->Session->write('Search.'.$this->ModelName.'Viewpage',$viewpage);
			$this->Session->write('Search.'.$this->ModelName.'Sort',(empty($this->params['named']['sort']) or !isset($this->params['named']['sort'])) ? $order : $this->params['named']['sort']." ".$this->params['named']['direction']);
			
			$cond_search		=	array();
			$filter_paginate	=	array();
			$this->paginate		=	array(
										"{$this->ModelName}"	=>	array(
											"order"				=>	$order,
											'limit'				=>	$viewpage,
											'recursive'			=>	3
										)
									);
			$ses_cond			=	$this->Session->read("Search.".$this->ControllerName);
			$cond_search		=	isset($ses_cond) ? $ses_cond : array();
			$ses_operand		=	$this->Session->read("Search.".$this->ControllerName."Operand");
			$operand			=	isset($ses_operand) ? $ses_operand : "AND";
			$merge_cond			=	empty($cond_search) ? $filter_paginate : array_merge($filter_paginate,array($operand => $cond_search) );
			$data				=	$this->paginate("{$this->ModelName}",$merge_cond);
			$datar				=	$this->paginate("{$this->ModelName}",$merge_cond);
			
			if(isset($this->params['named']['page']) && $this->params['named']['page'] > $this->params['paging'][$this->ModelName]['pageCount'])
			{
				$this->params['named']['page']	=	$this->params['paging'][$this->ModelName]['pageCount'];
			}
			$page				=	empty($this->params['named']['page']) ? 1 : $this->params['named']['page'];
			$this->Session->write('Search.'.$this->ModelName.'Page',$page);
			$this->Session->write('Search.'.$this->ModelName.'Conditions',$merge_cond);
			$this->set(compact('data','page','viewpage','bobot', 'hasil', 'orderHasil', 'datar'));
		}
	}

	function Excel()
	{
		if(isset($_GET['debug']) && $_GET['debug'] == "1")
			$this->layout		=	"ajax";
		else
		{
			$this->layout		=	"xls";
			$this->response->type(array('xls' => 'application/vnd.ms-excel'));
			$this->response->type('xls');
		}

		$this->loadModel($this->ModelName);

		$order				=	$this->Session->read("Search.".$this->ModelName."Sort");
		$viewpage			=	$this->Session->read("Search.".$this->ModelName."Viewpage");
		$page				=	$this->Session->read("Search.".$this->ModelName."Page");
		$conditions			=	$this->Session->read("Search.".$this->ModelName."Conditions");

		$this->paginate		=	array(
									"{$this->ModelName}"	=>	array(
										"order"				=>	$order,
										"limit"				=>	$viewpage,
										"conditions"		=>	$conditions,
										"page"				=>	$page,
										"recursive"			=>	3
									)
								);
		$data				=	$this->paginate("{$this->ModelName}",$conditions);
		$datar				=	$this->paginate("{$this->ModelName}",$conditions);
		$title				=	$this->ModelName;
		$filename			=	$this->ModelName."_".date("dMY");
		$this->set(compact("data","title","page","viewpage","filename", "datar"));
	}
}
?>