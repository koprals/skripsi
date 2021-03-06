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
					<?php echo $this->Paginator->sort("$ModelName.id",'ID');?>
				</td>
				<td>
					<?php echo $this->Paginator->sort("$ModelName.nik_karyawan",'NIK');?>
				</td>
				<td>
					<?php echo $this->Paginator->sort("$ModelName.nama",'Nama');?>
				</td>
				<td>
					<?php echo $this->Paginator->sort("$ModelName.SAgama",'Jenis Kelamin');?>
				</td>
				<td style="font-size:12px;">
					Action
				</td>
			</tr>
		</thead>
		<tbody>
			<?php foreach($data as $data): ?>
				<tr>
					<td><?php echo $data[$ModelName]['id'] ?></td>
					<td><?php echo $data[$ModelName]['nik_karyawan'] ?></td>
					<td><?php echo $data[$ModelName]['nama'] ?></td>
					<td><?php echo $data[$ModelName]['SKelamin'] ?></td>
					<td align="middle">
						<?php if($profile['Karyawan']['role'] == 1): ?>
							<?php echo $this->Html->link("Edit", array('action' => 'Edit', $data[$ModelName]['id'])); ?>&nbsp;
							<?php echo $this->Html->link("Delete", array('action' => 'Delete', $data[$ModelName]['id'])); ?>
						<?php else: ?>
							<?php echo $this->Html->link("Edit", array('action' => 'Edit', $data[$ModelName]['id'])); ?>&nbsp;
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