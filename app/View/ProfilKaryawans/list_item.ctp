<?php if(!empty($data)):?>
<?php pr($this->params['paging'][$ModelName]);?>
<?php
	$orderHasil		=	array_keys($this->params['paging'][$ModelName]['order']);
	$direction		=	$this->params['paging'][$ModelName]["order"][$order[0]];
	$ordered		=	($order[0]!==0) ? "/sort:".$order[0]."/direction:".$direction: "";
?>
<?php $this->Paginator->options(array(
				'url'	=> array(
					'controller'	=> $ControllerName,
					'action'		=> 'ListItem/limit:'.$viewpage,
				),
				'onclick'=>"return onClickPage(this,'#contents_area');")
			);
?>

<script>
function ChangeStatus(msg,id,status)
{
	var a	=	confirm(msg);
	if(a)
	{
		$.getJSON("<?php echo $settings["cms_url"].$ControllerName?>/ChangeStatus/"+id+"/"+status,function(){
			$("#contents_area").load("<?php echo $settings["cms_url"].$ControllerName?>/ListItem/page:<?php echo $page?>/limit:<?php echo $viewpage.$ordered?>");
		});
	}
	return false;
}

function Delete(msg,id)
{
	var a	=	confirm(msg);
	if(a)
	{
		$.getJSON("<?php echo $settings["cms_url"].$ControllerName?>/Delete/"+id,function(){
			$("#contents_area").load("<?php echo $settings["cms_url"].$ControllerName?>/ListItem/page:<?php echo $page?>/limit:<?php echo $viewpage.$ordered?>");
		});
	}
	return false;
}
</script>

<div class="widget">
	<div class="title">
		<img src="<?php echo $this->webroot ?>img/icons/dark/frames.png" alt="" class="titleIcon">
		<h6>
			Profil Karyawan - Page <?php echo $this->Paginator->counter(); ?>
		</h6>
	</div>
	<div class="title">
		<div class="itemsPerPage">
			<div id="DataTables_Table_0_length" class="dataTables_length">
				<label>
					<span>Show entries:</span>
					<?PHP echo $this->Form->select("view",array(1=>1,5=>5,10=>10,20=>20,100=>100,200=>200,1000=>1000),array("onchange"=>"onClickPage('".$settings["cms_url"].$ControllerName."/ListItem/limit:'+this.value+'".$ordered."','#contents_area')","empty"=>false,"default"=>$viewpage))?>
				</label>
			</div>
		</div>
	</div>
	<table cellpadding="0" cellspacing="0" width="100%" class="sTable mTable">
		<thead>
			<tr>
				<td>
					<?php echo $this->Paginator->sort("Karyawan.nama",'Nama Karyawan');?>
				</td>
				<td width="100">
					<?php echo $this->Paginator->sort("$ModelName.iq",'IQ');?>
				</td>
				<td width="100">
					<?php echo $this->Paginator->sort("$ModelName.ketelitian",'Ketelitian');?>
				</td>
				<td width="100">
					<?php echo $this->Paginator->sort("$ModelName.kekuasaan",'Kepemimpinan');?>
				</td>
				<td width="150">
					Action
				</td>
			</tr>
		</thead>
		<tbody>
			<?php foreach($data as $data): ?>
				<?php $class	=	($data[$ModelName]['status'] == "0") ? "style='background-color:#FFDDDE'" : "";?>
				<tr <?php echo $class?>>
					<td><?php echo $data['Karyawan']['nama'] ?></td>
					<td><?php echo $data[$ModelName]['iq'] ?></td>
					<td><?php echo $data[$ModelName]['ketelitian'] ?></td>
					<td><?php echo $data[$ModelName]['kekuasaan'] ?></td>
					<td align="middle">
						<?php if($profile['Karyawan']['role'] == 1): ?>
							<?php echo $this->Html->link("Edit", array('action' => 'Edit', $data[$ModelName]['id'])); ?>&nbsp;
							<?php echo $this->Html->link("Delete", array('action' => 'Delete', $data[$ModelName]['id'])); ?>&nbsp;
						<?php else: ?>
							<?php echo "No Akses" ?>
						<?php endif; ?>
					</td>
				</tr>
			<?php endforeach; ?>
		</tbody>
		<tfoot>
			<tr>
				<td colspan="7">
					<div class="itemActions">
						<label><?php echo $this->Paginator->counter(array('format' => 'Showing %start% to %end% of %count% entries'));?></label>
					</div>
					<?php if($this->Paginator->hasPrev() or $this->Paginator->hasNext()):?>
					<div class="tPagination">
						<ul class="pages">
							<?php echo $this->Paginator->prev("",
									array(
										"escape"	=>	false,
										'tag'		=>	"li",
										"class"		=>	"prev"
									),
									"<a href='javascript:void(0)'></a>",
									array(
										'tag'		=>	"li",
										"escape"	=>	false,
										"class"		=>	"prev"
									)
								);
							?>
							
							<?php
								echo $this->Paginator->numbers(array(
									'separator'		=>	null,
									'tag'			=>	"li",
									'currentclass'	=>	'active',
									'modulus'		=>	4
								));
							?>
							<?php echo $this->Paginator->next("",
									array(
										"escape"	=>	false,
										'tag'		=>	"li",
										"class"		=>	"next"
									),
									"<a href='javascript:void(0)'></a>",
									array(
										'tag'		=>"li",
										"escape"	=>	false,
										"class"		=>	"next"
									)
								);
							?>
						</ul>
					</div>
					<?php endif;?>
				</td>
			</tr>
		</tfoot>
	</table>
</div>
<?php else:?>
<div class="nNote nFailure">
	<p><strong>DATA IS EMPTY!</strong></p>
</div>
<?php endif;?>

<div class="widget">
	<div class="title">
		<img src="<?php echo $this->webroot ?>img/icons/dark/frames.png" alt="" class="titleIcon">
		<h6>
			Hasil Akhir - Page <?php echo $this->Paginator->counter(); ?>
		</h6>
	</div>
	<div class="title">
		<div class="itemsPerPage">
			<div id="DataTables_Table_0_length" class="dataTables_length">
				<label>
				</label>
			</div>
		</div>
	</div>
	<table cellpadding="0" cellspacing="0" width="100%" class="sTable mTable">
		<thead>
			<tr>
				<td>
					<?php echo $this->Paginator->sort("Gap.ProfilKaryawan.Karyawan.nama",'Nama Karyawan');?>
				</td>
				<td>
					<?php echo $this->Paginator->sort("HasilAkhir.total_pengetahuan",'Total Pengetahuan');?>
				</td>
				<td>
					<?php echo $this->Paginator->sort("HasilAkhir.total_sikap_kerja",'Total Sikap Kerja');?>
				</td>
				<td>
					<?php echo $this->Paginator->sort("HasilAkhir.total_prilaku",'Total Prilaku');?>
				</td>
				<td>
					<?php echo $this->Paginator->sort("HasilAkhir.total_akhir",'Hasil Akhir');?>
				</td>
				<!--td width="150">
					Action
				</td-->
			</tr>
		</thead>
		<tbody>
			<?php foreach($hasil as $hasil): ?>
				<tr <?php echo $class?>>
					<td><?php echo $hasil['Gap']['ProfilKaryawan']['Karyawan']['nama'] ?></td>
					<td><?php echo $hasil['HasilAkhir']['total_pengetahuan'] ?></td>
					<td><?php echo $hasil['HasilAkhir']['total_sikap_kerja'] ?></td>
					<td><?php echo $hasil['HasilAkhir']['total_prilaku'] ?></td>
					<td><?php echo $hasil['HasilAkhir']['total_akhir'] ?></td>
				</tr>
			<?php endforeach; ?>
		</tbody>
		<tfoot>
			<tr>
				<td colspan="7">
					<div class="itemActions">
						<label><?php echo $this->Paginator->counter(array('format' => 'Showing %start% to %end% of %count% entries'));?></label>
					</div>
					<?php if($this->Paginator->hasPrev() or $this->Paginator->hasNext()):?>
					<div class="tPagination">
						<ul class="pages">
							<?php echo $this->Paginator->prev("",
									array(
										"escape"	=>	false,
										'tag'		=>	"li",
										"class"		=>	"prev"
									),
									"<a href='javascript:void(0)'></a>",
									array(
										'tag'		=>	"li",
										"escape"	=>	false,
										"class"		=>	"prev"
									)
								);
							?>
							
							<?php
								echo $this->Paginator->numbers(array(
									'separator'		=>	null,
									'tag'			=>	"li",
									'currentclass'	=>	'active',
									'modulus'		=>	4
								));
							?>
							<?php echo $this->Paginator->next("",
									array(
										"escape"	=>	false,
										'tag'		=>	"li",
										"class"		=>	"next"
									),
									"<a href='javascript:void(0)'></a>",
									array(
										'tag'		=>"li",
										"escape"	=>	false,
										"class"		=>	"next"
									)
								);
							?>
						</ul>
					</div>
					<?php endif;?>
				</td>
			</tr>
		</tfoot>
	</table>
</div>