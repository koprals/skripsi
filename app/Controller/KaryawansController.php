<?php
class KaryawansController extends AppController
{
	var $uses			=	"Karyawan";
	var $ControllerName	=	"Karyawans";
	var $ModelName		=	"Karyawan";
	var $helpers		=	array("Text");

	function beforeFilter()
	{
		parent::beforeFilter();
		$this->set("ControllerName",$this->ControllerName);
		$this->set("ModelName",$this->ModelName);
		$this->set('lft_menu_category_id',"2");
	}
	
	function Index()
	{
		$this->Session->delete("Search.".$this->ControllerName);
		$this->Session->delete('Search.'.$this->ControllerName.'Operand');
	}
	
	function ListItem()
	{
		$this->layout	=	"ajax";
		$this->loadModel($this->ModelName);
		$this->{$this->ModelName}->VirtualFieldActivated();
		
		//DEFINE LAYOUT, LIMIT AND OPERAND
		$viewpage			=	empty($this->params['named']['limit']) ? 10 : $this->params['named']['limit'];
		$order				=	array("{$this->ModelName}.id" => "DESC");
		$operand			=	"AND";
		
		//DEFINE SEARCH DATA
		if(!empty($this->request->data))
		{
			$cond_search	=	array();
			$operand		=	$this->request->data[$this->ModelName]['operator'];
			$this->Session->delete('Search.'.$this->ModelName);
			
			if(!empty($this->request->data['Search']['nik_karyawan']))
			{
				$cond_search["{$this->ModelName}.nik_karyawan"]			=	$this->data['Search']['nik_karyawan'];
			}

			if(!empty($this->request->data['Search']['nama']))
			{
				var_dump($this->request->data['Search']['nama']);
				$cond_search["{$this->ModelName}.nama LIKE "]			=	"%".$this->data['Search']['nama']."%";
			}
			
			if($this->request->data["Search"]['reset']=="0")
			{
				$this->Session->write("Search.".$this->ModelName,$cond_search);
				$this->Session->write('Search.'.$this->ModelName.'Operand',$operand);
			}
		}
		
		$this->Session->write('Search.'.$this->ModelName.'Viewpage',$viewpage);
		$this->Session->write('Search.'.$this->ModelName.'Sort',(empty($this->params['named']['sort']) or !isset($this->params['named']['sort'])) ? $order : $this->params['named']['sort']." ".$this->params['named']['direction']);
		
		$cond_search		=	array();
		$filter_paginate	=	array();
		$this->paginate		=	array(
									"{$this->ModelName}"	=>	array(
										"order"				=>	$order,
										'limit'				=>	$viewpage
									)
								);
		
		$ses_cond			=	$this->Session->read("Search.".$this->ModelName);
		$cond_search		=	isset($ses_cond) ? $ses_cond : array();
		$ses_operand		=	$this->Session->read("Search.".$this->ModelName."Operand");
		$operand			=	isset($ses_operand) ? $ses_operand : "AND";
		$merge_cond			=	empty($cond_search) ? $filter_paginate : array_merge($filter_paginate,array($operand => $cond_search) );
		$data				=	$this->paginate("{$this->ModelName}",$merge_cond);
		//pr($data);
		
		if(isset($this->params['named']['page']) && $this->params['named']['page'] > $this->params['paging'][$this->ModelName]['pageCount'])
		{
			$this->params['named']['page']	=	$this->params['paging'][$this->ModelName]['pageCount'];
		}
		$page				=	empty($this->params['named']['page']) ? 1 : $this->params['named']['page'];
		$this->Session->write('Search.'.$this->ModelName.'Page',$page);
		$this->set(compact('data','page','viewpage'));
	}

	function Add()
	{
		if(!empty($this->request->data))
		{
			$this->{$this->ModelName}->set($this->request->data);
			$this->{$this->ModelName}->ValidateAdd();
			
			if($this->{$this->ModelName}->validates())
			{
				$save	=	$this->{$this->ModelName}->save($this->request->data);
				$ID		=	$this->{$this->ModelName}->getLastInsertId();
				$this->redirect(array("action"=>"Index"));
			}//END IF VALIDATE
		}//END IF NOT EMPTY
		$this->set("time",time());
	}

	function Edit($ID=NULL)
	{
		$this->loadModel($this->ModelName);
		$this->{$this->ModelName}->VirtualFieldActivated();
		
		$detail = $this->{$this->ModelName}->find('first', array(
			'conditions' => array(
				"{$this->ModelName}.id"		=>	$ID
			)
		));
	
		if(empty($detail))
		{
			$this->layout	=	"ajax";
			$this->render("/errors/error404");
			return;
		}		
				
		if (empty($this->data))
		{
			$this->data = $detail;
		}
		else
		{
			$this->{$this->ModelName}->set($this->request->data);
			$this->{$this->ModelName}->ValidateEdit();
			
			if($this->{$this->ModelName}->validates())
			{
				$save =	$this->{$this->ModelName}->save($this->request->data,false);
				
				if($save) {
					$this->redirect(array('action' => 'Index'));	
				} else {
					$this->Session->setFlash('Unable to save, please try again');
				}
			} else {
				$this->Session->setFlash('Please try again.');
			}
		}
		$this->set("time",time());
		$this->set(compact("ID","detail"));
	}

	function View($ID=NULL)
	{
		$this->loadModel($this->ModelName);
		$this->{$this->ModelName}->VirtualFieldActivated();
		
		$detail = $this->Karyawan->find('first', array(
			'conditions' => array(
				"Karyawan.id"		=>	$ID
			)
		));

		debug($detail);
		if(empty($detail))
		{
			$this->layout	=	"ajax";
			$this->set(compact("ID","data"));
			$this->render("/errors/error404");
			return;
		}
		$this->set(compact("ID","detail"));
	}

	
	function Delete($ID=NULL,$status)
	{
		$detail = $this->{$this->ModelName}->find('first', array(
			'conditions' => array(
				"{$this->ModelName}.id"		=>	$ID
			)
		));
		
		if(empty($detail))
		{
			$message	=	"Item not found.";
		}
		else
		{
			$this->{$this->ModelName}->delete($ID);
		}
		$this->Session->setFlash('<p>Data Has deleted</p>', 'default', array('class' => 'nNote nSuccess hideit',));
		$this->redirect(array('action' => 'index'));
		$this->autoRender	=	false;
	}
}
?>