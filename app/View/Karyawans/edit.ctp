<!-- Title area -->
<div class="titleArea">
    <div class="wrapper">
        <div class="pageTitle">
            <h5>Edit Identitas Karyawan</h5>
            <span><?php echo $this->Html->link('Index', array('action' => 'index')); ?></span>
        </div>
        <div class="middleNav">
	        <ul>
	        </ul>
	    </div>
    </div>
</div>

<div class="line"></div>

<div class="wrapper">
	<div class="fluid">
		<div class="users form span8">
			<?php echo $this->Form->create($ModelName, array("type"=>"file",'url' => array("controller"=>$ControllerName,"action"=>"Add","?"=>"debug=1"),'class' => 'form')); ?>
				<fieldset>
					<div class="widget">
						<div class="title">
							<img src="<?php echo $this->webroot ?>img/icons/dark/list.png" alt="" class="titleIcon" />
							<h6>Edit <?php echo ($detail['Karyawan']['nama'])?></h6>
						</div>
						<?php
							echo $this->Form->input('id', array('type' => 'hidden'));
						?>
						<?php
							echo $this->Form->input('nik_karyawan', array(
								'label'			=> 'NIK (*)',
								'type'			=> 'text',
								'div' 			=> 'formRow',
								'between'		=> '<div class="formRight">',
								'after' 		=> '</div>',
								'error' 		=> array('attributes' => array('wrap' => 'label', 'class' => 'formRight error')),
								'placeholder' 	=> ''
							));
						?>
						<?php
							echo $this->Form->input('nama', array(
								'label'			=> 'Nama (*)',
								'div' 			=> 'formRow',
								'between'		=> '<div class="formRight">',
								'after' 		=> '</div>',
								'error' 		=> array('attributes' => array('wrap' => 'label', 'class' => 'formRight error')),
								'placeholder' 	=> ''
							));
						?>
						<?php
							echo $this->Form->input('username', array(
								'label'			=> 'Username (*)',
								'div' 			=> 'formRow',
								'between'		=> '<div class="formRight">',
								'after' 		=> '</div>',
								'error' 		=> array('attributes' => array('wrap' => 'label', 'class' => 'formRight error')),
								'placeholder' 	=> ''
							));
						?>
						<?php
							echo $this->Form->input('password', array(
								'label'			=> 'Password (*)',
								'div' 			=> 'formRow',
								'between'		=> '<div class="formRight">',
								'after' 		=> '</div>',
								'error' 		=> array('attributes' => array('wrap' => 'label', 'class' => 'formRight error')),
								'placeholder' 	=> ''
							));
						?>
						<?php
							echo $this->Form->input('no_ktp', array(
								'label'			=> 'No. Identitas KTP (*)',
								'div' 			=> 'formRow',
								'between'		=> '<div class="formRight">',
								'after' 		=> '</div>',
								'error' 		=> array('attributes' => array('wrap' => 'label', 'class' => 'formRight error')),
								'placeholder' 	=> ''
							));
						?>
						<?php
							echo $this->Form->input('alamat', array(
								'label'			=> 'Alamat (*)',
								'div' 			=> 'formRow',
								'between'		=> '<div class="formRight">',
								'after' 		=> '</div>',
								'error' 		=> array('attributes' => array('wrap' => 'label', 'class' => 'formRight error')),
								'placeholder' 	=> ''
							));
						?>
						<?php
							echo $this->Form->input('jenis_kelamin', array(
								'label'			=> 'Jenis Kelamin (*)',
								'options'		=>	array('0' => 'Laki-Laki', '1' => 'Perempuan'),
								'div' 			=> 'formRow',
								'between'		=> '<div class="formRight">',
								'after' 		=> '</div>',
								'error' 		=> array('attributes' => array('wrap' => 'label', 'class' => 'formRight error')),
								'empty' 		=> ''
							));
						?>
						<?php
							echo $this->Form->input('tempat_lahir', array(
								'label'			=> 'Tempat Lahir(*)',
								'div' 			=> 'formRow',
								'between'		=> '<div class="formRight">',
								'after' 		=> '</div>',
								'error' 		=> array('attributes' => array('wrap' => 'label', 'class' => 'formRight error')),
								'placeholder' 	=> ''
							));
						?>
						<?php
							echo $this->Form->input('tgl_lahir', array(
								'id'			=> $time,
								'label'			=> 'Tanggal Lahir(*)',
								'type'			=> 'text',
								'div' 			=> 'formRow',
								'between'		=> '<div class="formRight">',
								'after' 		=> '</div>',
								'error' 		=> array('attributes' => array('wrap' => 'label', 'class' => 'formRight error')),
							));
						?>
						<?php
							echo $this->Form->input('agama', array(
								'label'			=>  'Agama (*)',
								'options'		=>	array('0' => 'Budha', '1' => 'Hindu', '2' => 'Kristen Katolik', '3' => 'Kristen Protestan', '4' => 'Islam'),
								'div' 			=> 'formRow',
								'between'		=> '<div class="formRight">',
								'after' 		=> '</div>',
								'error' 		=> array('attributes' => array('wrap' => 'label', 'class' => 'formRight error')),
								'empty' 		=> 'Pilih'
							));
						?>
						<?php
							echo $this->Form->input('telepon', array(
								'type'			=> 'text',
								'label'			=> 'Telepon',
								'div' 			=> 'formRow',
								'between'		=> '<div class="formRight">',
								'after' 		=> '</div>',
								'error' 		=> array('attributes' => array('wrap' => 'label', 'class' => 'formRight error')),
								'placeholder' 	=> ''
							));
						?>
						<?php
							echo $this->Form->input('pendidikan', array(
								'label'			=> 'Pendidikan Terakhir (*)',
								'options'		=> array('0' => 'SMA', '1' => 'S1', '2' => 'S2', '3' => 'S3'),
								'div' 			=> 'formRow',
								'between'		=> '<div class="formRight">',
								'after' 		=> '</div>',
								'error' 		=> array('attributes' => array('wrap' => 'label', 'class' => 'formRight error')),
								'empty' 		=> 'Pilih'
							));
						?>
						<?php if($profile['Karyawan']['role'] == 1): ?>
							<?php
								echo $this->Form->input('role', array(
									'label'			=> 'Hak Akses (*)',
									'options'		=>	array('1' => 'Semua', '2' => 'Terbatas'),
									'value'			=>	'2',
									'div' 			=> 'formRow',
									'between'		=> '<div class="formRight">',
									'after' 		=> '</div>',
									'error' 		=> array('attributes' => array('wrap' => 'label', 'class' => 'formRight error')),
								));
							?>
						<?php else: ?>
							<?php
								echo $this->Form->input('role', array(
									'type'			=> 'hidden',
									'label'			=> 'Hak Akses (*)',
									'options'		=>	array('1' => 'Semua', '2' => 'Terbatas'),
									'value'			=>	'2',
									'div' 			=> 'formRow',
									'between'		=> '<div class="formRight">',
									'after' 		=> '</div>',
									'error' 		=> array('attributes' => array('wrap' => 'label', 'class' => 'formRight error')),
								));
							?>
						<?php endif; ?>
						<?php
							echo $this->Form->input('status', array(
								'type'			=> 'hidden',
								'label'			=> 'Status (*)',
								'options'		=>	array('0' => 'Not Active', '1' => 'Active'),
								'value'			=>	'1',
								'div' 			=> 'formRow',
								'between'		=> '<div class="formRight">',
								'after' 		=> '</div>',
								'error' 		=> array('attributes' => array('wrap' => 'label', 'class' => 'formRight error')),
								'empty' 		=> 'Please Choose'
							));
						?>
						
						<div class="formSubmit">
							<input type="submit" value="Ubah" class="redB" />
							<input type="reset" value="Batal" class="blueB"/>
						</div>
					</div>
				</fieldset>
			</form>
		</div>
	</div>
</div>
<script>
$(document).ready(function(){
	$( "#<?php echo $time?>" ).datepicker({ 
		dateFormat: 'yy-mm-dd',
		changeYear: true,
		yearRange: "1960:2014"
	});

	$("#<?php echo $time?>-select-status").chosen(); 
	$("#<?php echo $time?>-select-hub").chosen(); 
});
</script>