<?php if(!empty($data)):?>
<?php pr($this->params['paging'][$ModelName]);?>
<?php
	$order		=	array_keys($this->params['paging'][$ModelName]['order']);
	$direction	=	$this->params['paging'][$ModelName]["order"][$order[0]];
	$ordered	=	($order[0]!==0) ? "/sort:".$order[0]."/direction:".$direction: "";
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
			<?php echo $ControllerName?> - Page <?php echo $this->Paginator->counter(); ?>
		</h6>
	</div>
	<div class="title">
		<div class="itemsPerPage">
		</div>
	</div>
	<table cellpadding="0" cellspacing="0" width="100%" class="sTable mTable">
		<thead>
			<tr>
				<td style="font-size:13px">
					<?php echo $this->Paginator->sort("$ModelName.nama",'Jabatan');?>
				</td>
				<td style="font-size:13px">
					<?php echo $this->Paginator->sort("$ModelName.alamat",'Nama Karyawan');?>
				</td>
				<td style="font-size:13px">
					<?php echo $this->Paginator->sort("$ModelName.total_pengetahuan",'Total Pengetahuan');?>
				</td>
				<td style="font-size:13px">
					<?php echo $this->Paginator->sort("$ModelName.total_sikap_kerja",'Total Sikap Kerja');?>
				</td>
				<td style="font-size:13px">
					<?php echo $this->Paginator->sort("$ModelName.total_prilaku",'Total Prilaku');?>
				</td>
				<td style="font-size:13px">
					<?php echo $this->Paginator->sort("$ModelName.total_akhir",'Hasil Akhir');?>
				</td>
			</tr>
		</thead>
		<tbody>
			<?php foreach($data as $data):?>
				<tr style="font-size:13px">
					<td><?php echo $data['Gap']['ProfilKaryawan']['ProfilJabatan']['nama_jabatan']?></td>
					<td><?php echo $data['Gap']['ProfilKaryawan']['Karyawan']['nama']?></td>
					<td><?php echo $data[$ModelName]['total_pengetahuan'] ?></td>
					<td><?php echo $data[$ModelName]['total_sikap_kerja'] ?></td>
					<td><?php echo $data[$ModelName]['total_prilaku'] ?></td>
					<td><?php echo $data[$ModelName]['total_akhir'] ?></td>
				</tr>
			<?php endforeach; ?>
		</tbody>
		<tfoot>
			<tr>
				<td colspan="7">
					<div class="itemActions">
					</div>
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
<a href="<?php echo $settings["cms_url"].$ControllerName?>/Excel" title="export to excel" class="wButton bluewB ml15 m10"><span>Export</span></a>