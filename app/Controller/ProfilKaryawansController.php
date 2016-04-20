<?php
class ProfilKaryawansController extends AppController
{
	var $uses			= "ProfilKaryawan";
	var $ControllerName	= "ProfilKaryawans";
	var $ModelName		= "ProfilKaryawan";
	var $helpers		= array("Text");

	function beforeFilter()
	{
		parent::beforeFilter();
		$this->set("ControllerName",$this->ControllerName);
		$this->set("ModelName",$this->ModelName);
		$this->set('lft_menu_category_id',"3");

		$this->loadModel('ProfilJabatan');
		$jabatannames = $this->ProfilJabatan->find('list', array(
			'fields' => array(
				'ProfilJabatan.nama_jabatan'),
			'conditions' => array(
				'ProfilJabatan.status' => 1
				)
			));

		$this->loadModel('Karyawan');
		$karyawans = $this->Karyawan->find('list', array(
			'fields' => array(
				'Karyawan.nama'),
			'conditions' => array(
				'Karyawan.status' => 1
				)
			));

		$this->set(compact('jabatannames', 'karyawans'));		
	}
	
	function Index()
	{
		$this->Session->delete("Search.".$this->ControllerName);
		$this->Session->delete('Search.'.$this->ControllerName.'Operand');
	}
	
	function ListItem()
	{
		$this->layout	=	"ajax";
		$this->loadModel('Gap');
		$bobot = $this->Gap->find('all', array(
			'recursive' => 2
			)
		);
		$orderBobot	= array("Gap.id" => "DESC");

		$this->loadModel('HasilAkhir');
		$hasil = $this->HasilAkhir->find('all', array(
			'recursive' => 3
			)
		);
		$orderHasil	= array("HasilAkhir.id" => "DESC");

		$this->loadModel($this->ModelName);
		//$this->{$this->ModelName}->BindDefault(false);
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

			if(!empty($this->request->data['Search']['nama']))
			{
				$cond_search["ProfilKaryawan.profil_karyawan_id LIKE "]			=	"%".$this->data['Search']['nama']."%";
			}
			
			if(!empty($this->request->data['Search']['start']) && !empty($this->request->data['Search']['end']))
			{
				$tmp				=	$this->data['Search']['start'];
				$START				=	(strtotime($this->data['Search']['end']) < strtotime($this->data['Search']['start'])) ? $this->data['Search']['end'] : $this->data['Search']['start'];
				$END				=	($this->data['Search']['end'] < $tmp) ? $tmp : $this->data['Search']['end'];
				$cond_search["{$this->ModelName}.created BETWEEN ? AND ? "]			=	array($START." 00:00:00",$END." 23:59:59");
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
		
		$ses_cond			=	$this->Session->read("Search.".$this->ControllerName);
		$cond_search		=	isset($ses_cond) ? $ses_cond : array();
		$ses_operand		=	$this->Session->read("Search.".$this->ControllerName."Operand");
		$operand			=	isset($ses_operand) ? $ses_operand : "AND";
		$merge_cond			=	empty($cond_search) ? $filter_paginate : array_merge($filter_paginate,array($operand => $cond_search) );
		$data				=	$this->paginate("{$this->ModelName}",$merge_cond);
		
		if(isset($this->params['named']['page']) && $this->params['named']['page'] > $this->params['paging'][$this->ModelName]['pageCount'])
		{
			$this->params['named']['page']	=	$this->params['paging'][$this->ModelName]['pageCount'];
		}
		$page				=	empty($this->params['named']['page']) ? 1 : $this->params['named']['page'];
		$this->Session->write('Search.'.$this->ModelName.'Page',$page);
		$this->set(compact('data','page','viewpage','bobot', 'hasil', 'orderHasil'));
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
				//save ke table bobot
				$this->HitungBobot($this->request->data['ProfilKaryawan']['profil_jabatan_id'], $ID);
				$this->redirect(array("action"=>"Index"));
			}//END IF VALIDATE
		}//END IF NOT EMPTY
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
				$this->HitungBobot($detail['ProfilKaryawan']['profil_jabatan_id'], $ID);
				
				if($save) {
					$this->redirect(array('action' => 'Index'));	
				} else {
					$this->Session->setFlash('Unable to save, please try again');
				}
			} else {
				$this->Session->setFlash('Please try again.');
			}
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
			$this->{$this->ModelName}->delete($ID, true);
			if(!empty($detail['Image'])) {
				$this->{$this->ModelName}->Image->delete($detail['Image']['id']);
			}
			
			$message	=	"Data has deleted.";
		}
		
		$this->redirect(array('action' => 'index'));
		$this->autoRender	=	false;
	}

	function HitungBobot($profil_jabatan_id = NULL, $profil_karyawan_id = NULL)
	{
		$this->loadModel('ProfilJabatan');
		$profilJabatans = $this->ProfilJabatan->find('first', array(
			'conditions' => array(
				'ProfilJabatan.id' => $profil_jabatan_id
				)
			));
		
		$profilKaryawans = $this->ProfilKaryawan->find('first', array(
			'conditions' => array(
				'ProfilKaryawan.id' => $profil_karyawan_id
				)
			));

		$arrayKeysPJ = array_keys($profilJabatans['ProfilJabatan']);
		$saveData['Gap'] = array();

		foreach($arrayKeysPJ as $pj) {
			//lakukan if else untuk field2 yang tidak penting, spertin id, status, created dll
		if($pj != 'id' && $pj != 'nama_jabatan' && $pj != 'presentase_bobot_pengetahuan' && $pj != 'presentase_bobot_sikap_kerja' && 
			$pj != 'presentase_bobot_sikap_kerja' && $pj != 'presentase_bobot_prilaku' && $pj != 'status' && $pj != 'created' && $pj != 'modified')
			{
				$nilaiSelisih = $profilKaryawans['ProfilKaryawan'][$pj] - $profilJabatans['ProfilJabatan'][$pj];
				//var_dump($nilaiSelisih);

				if($nilaiSelisih == 0){
					$saveData['Gap'][$pj] = 5;
				}
				elseif ($nilaiSelisih == 1) {
					$saveData['Gap'][$pj] = 4.5;
				}
				elseif ($nilaiSelisih == -1) {
					$saveData['Gap'][$pj] = 4;
				}
				elseif ($nilaiSelisih == 2) {
					$saveData['Gap'][$pj] = 3.5;
				}
				elseif ($nilaiSelisih == -2) {
					$saveData['Gap'][$pj] = 3;
				}
				elseif ($nilaiSelisih == 3) {
					$saveData['Gap'][$pj] = 2.5;
				}
				elseif ($nilaiSelisih == -3) {
					$saveData['Gap'][$pj] = 2;
				}
				elseif ($nilaiSelisih == 4) {
					$saveData['Gap'][$pj] = 1.5;
				}
				elseif ($nilaiSelisih == -4) {
					$saveData['Gap'][$pj] = 1;
				}
			}	
		}

		if(count($saveData) > 0) {
			$this->loadModel('Gap');
			$cekID = $this->Gap->find('first', array(
				'conditions' => array(
					'Gap.profil_jabatan_id' => $profil_karyawan_id,
					'Gap.profil_karyawan_id' => $profil_karyawan_id
					)
				));
			if($cekID != false){
				$this->Gap->id = $cekID['Gap']['id'];
				$saveData['Gap']['id'] = $cekID['Gap']['id'];
			}
			else {
				$this->Gap->create();
			}
			$saveData['Gap']['profil_jabatan_id'] = $profil_jabatan_id;
			$saveData['Gap']['profil_karyawan_id'] = $profil_karyawan_id;
			$this->Gap->save($saveData);
			$this->HitungHasil($this->Gap->id);
		}
		else {
				$message = "Gap Not saved";
		}
	}

	function HitungHasil($gap_id = NULL)
	{
		$this->loadModel('Gap');
		$gaps = $this->Gap->find('first', array(
			'conditions' => array(
				'Gap.id' => $gap_id
				)
			));

		if($gaps != false){
				//Pengetahuan
			$totalCFP = ($gaps['Gap']['konsentrasi'] + $gaps['Gap']['logika_praktis'] + $gaps['Gap']['imajinasi'] + $gaps['Gap']['iq']) / 5;
			$totalSFP = ($gaps['Gap']['common_sense'] + $gaps['Gap']['verbalisasi_ide'] + $gaps['Gap']['sistematika_berpikir'] + 
				$gaps['Gap']['penalaran'] + $gaps['Gap']['fleksibilitas_berpikir'] + $gaps['Gap']['antisipasi']) / 6;

			//Sikap Kerja
			$totalCFS = ($gaps['Gap']['ketelitian'] + $gaps['Gap']['kehatian'] + $gaps['Gap']['pengendalian_perasaan'] + $gaps['Gap']['dorongan_prestasi']) / 4;
			$totalSFS = ($gaps['Gap']['energi_sikis'] + $gaps['Gap']['perencanaan']) / 2;

			//Prilaku
			$totalCFPR = $gaps['Gap']['keteguhan_hati'] / 1;
			$totalSFPR = ($gaps['Gap']['kekuasaan'] + $gaps['Gap']['pengaruh'] + $gaps['Gap']['pemenuhan']) / 3;

			//Total Kriteria
			$totalPengetahuan 	= ((80/100) * $totalCFP) + ((20/100) * $totalSFP);
			$totalSikapKerja 	= ((75/100) * $totalCFS) + ((25/100) * $totalSFS);
			$totalPrilaku 		= ((80/100) * $totalCFPR) + ((20/100) * $totalSFPR);

			$this->loadModel('ProfilJabatan');
			$persens = $this->ProfilJabatan->find('first');

			$nilaiTotal =	(($persens['ProfilJabatan']['presentase_bobot_pengetahuan']/100) * $totalPengetahuan) + 
						 	(($persens['ProfilJabatan']['presentase_bobot_sikap_kerja']/100) * $totalSikapKerja) + 
							(($persens['ProfilJabatan']['presentase_bobot_prilaku']/100) * $totalPrilaku);

			$this->loadModel('HasilAkhir');
			$hasilAkhirs = $this->HasilAkhir->find('first', array(
				'conditions' => array(
					'HasilAkhir.gap_id' => $gap_id
				)
			));

			$saveData['HasilAkhir'] = array();
			if($hasilAkhirs != false){
				$this->HasilAkhir->id = $hasilAkhirs['HasilAkhir']['id'];
				$saveData['HasilAkhir']['id'] = $hasilAkhirs['HasilAkhir']['id'];
			}
			else{
				$this->HasilAkhir->create();
			}
			
			$saveData['HasilAkhir']['gap_id'] 				= $gap_id;
			$saveData['HasilAkhir']['total_pengetahuan'] 	= $totalPengetahuan;
			$saveData['HasilAkhir']['total_sikap_kerja'] 	= $totalSikapKerja;
			$saveData['HasilAkhir']['total_prilaku'] 		= $totalPrilaku;
			$saveData['HasilAkhir']['total_akhir']			= $nilaiTotal;
			$this->HasilAkhir->save($saveData);
		}
	}
}
?>