<!-- Title area -->
<div class="titleArea">
    <div class="wrapper">
        <div class="pageTitle">
            <h5>Edit Data Profil Jabatan</h5>
            <span><?php echo $this->Html->link('Index', array('action' => 'index')); ?></span>
        </div>
        <div class="middleNav">
	        <ul>
				<li class="mUser"><a href="<?php echo $settings["cms_url"].$ControllerName ?>" title="View List"><span class="list"></span></a></li>
	        </ul>
	    </div>
    </div>
</div>

<div class="line"></div>

<div class="wrapper">
	<div class="fluid">
		<div class="users form span8">
			<?php echo $this->Form->create($ModelName, array("type"=>"file",'url' => array("controller"=>$ControllerName,"action"=>"Edit","?"=>"debug=1"),'class' => 'form')); ?>
				<fieldset>
					<div class="widget">
						<div class="title">
							<img src="<?php echo $this->webroot ?>img/icons/dark/list.png" alt="" class="titleIcon" />
							<h6>Edit <?php echo $detail['ProfilJabatan']['nama_jabatan']?></h6>
						</div>
						<div class="title">
							<img src="<?php echo $this->webroot ?>img/icons/dark/list.png" alt="" class="titleIcon" />
							<h6>Pengetahuan</h6>
						</div>
						<?php
							echo $this->Form->input('id', array('type' => 'hidden'));
						?>
						<?php
							echo $this->Form->input('common_sense', array(
								'label'			=> 'Common Sense (*)',
								'type'			=> 'text',
								'div' 			=> 'formRow',
								'between'		=> '<div class="rightPart"><div class="formRight">',
								'after' 		=> '</div></div>',
								'error' 		=> array('attributes' => array('wrap' => 'label', 'class' => 'formRight error')),
								'placeholder' 	=> ''
							));
						?>
						<?php
							echo $this->Form->input('verbalisasi_ide', array(
								'label'			=> 'Verbalisasi Ide (*)',
								'type'			=> 'text',
								'div' 			=> 'formRow',
								'between'		=> '<div class="rightPart"><div class="formRight">',
								'after' 		=> '</div></div>',
								'error' 		=> array('attributes' => array('wrap' => 'label', 'class' => 'formRight error')),
								'placeholder' 	=> ''
							));
						?>
						<?php
							echo $this->Form->input('sistematika_berpikir', array(
								'label'			=> 'Sistematika Berpikir (*)',
								'type'			=> 'text',
								'div' 			=> 'formRow',
								'between'		=> '<div class="rightPart"><div class="formRight">',
								'after' 		=> '</div></div>',
								'error' 		=> array('attributes' => array('wrap' => 'label', 'class' => 'formRight error')),
								'placeholder' 	=> ''
							));
						?>
						<?php
							echo $this->Form->input('penalaran', array(
								'label'			=> 'Penalaran (*)',
								'type'			=> 'text',
								'div' 			=> 'formRow',
								'between'		=> '<div class="rightPart"><div class="formRight">',
								'after' 		=> '</div></div>',
								'error' 		=> array('attributes' => array('wrap' => 'label', 'class' => 'formRight error')),
								'placeholder' 	=> ''
							));
						?>
						<?php
							echo $this->Form->input('konsentrasi', array(
								'label'			=> 'Konsentrasi (*)',
								'type'			=> 'text',
								'div' 			=> 'formRow',
								'between'		=> '<div class="rightPart"><div class="formRight">',
								'after' 		=> '</div></div>',
								'error' 		=> array('attributes' => array('wrap' => 'label', 'class' => 'formRight error')),
								'placeholder' 	=> ''
							));
						?>
						<?php
							echo $this->Form->input('logika_praktis', array(
								'label'			=> 'Logika Praktis (*)',
								'type'			=> 'text',
								'div' 			=> 'formRow',
								'between'		=> '<div class="rightPart"><div class="formRight">',
								'after' 		=> '</div></div>',
								'error' 		=> array('attributes' => array('wrap' => 'label', 'class' => 'formRight error')),
								'placeholder' 	=> ''
							));
						?>
						<?php
							echo $this->Form->input('fleksibilitas_berpikir', array(
								'label'			=> 'Fleksibilitas Berpikir (*)',
								'type'			=> 'text',
								'div' 			=> 'formRow',
								'between'		=> '<div class="rightPart"><div class="formRight">',
								'after' 		=> '</div></div>',
								'error' 		=> array('attributes' => array('wrap' => 'label', 'class' => 'formRight error')),
								'placeholder' 	=> ''
							));
						?>
						<?php
							echo $this->Form->input('imajinasi', array(
								'label'			=> 'Imajinasi (*)',
								'type'			=> 'text',
								'div' 			=> 'formRow',
								'between'		=> '<div class="rightPart"><div class="formRight">',
								'after' 		=> '</div></div>',
								'error' 		=> array('attributes' => array('wrap' => 'label', 'class' => 'formRight error')),
								'placeholder' 	=> ''
							));
						?>
						<?php
							echo $this->Form->input('antisipasi', array(
								'label'			=> 'Antisipasi (*)',
								'type'			=> 'text',
								'div' 			=> 'formRow',
								'between'		=> '<div class="rightPart"><div class="formRight">',
								'after' 		=> '</div></div>',
								'error' 		=> array('attributes' => array('wrap' => 'label', 'class' => 'formRight error')),
								'placeholder' 	=> ''
							));
						?>
						<?php
							echo $this->Form->input('iq', array(
								'label'			=> 'IQ (*)',
								'type'			=> 'text',
								'div' 			=> 'formRow',
								'between'		=> '<div class="rightPart"><div class="formRight">',
								'after' 		=> '</div></div>',
								'error' 		=> array('attributes' => array('wrap' => 'label', 'class' => 'formRight error')),
								'placeholder' 	=> ''
							));
						?>
						<div class="title">
							<img src="<?php echo $this->webroot ?>img/icons/dark/list.png" alt="" class="titleIcon" />
							<h6>Sikap Kerja</h6>
						</div>
						<?php
							echo $this->Form->input('energi_sikis', array(
								'label'			=> 'Energi Psikis (*)',
								'type'			=> 'text',
								'div' 			=> 'formRow',
								'between'		=> '<div class="rightPart"><div class="formRight">',
								'after' 		=> '</div></div>',
								'error' 		=> array('attributes' => array('wrap' => 'label', 'class' => 'formRight error')),
								'placeholder' 	=> ''
							));
						?>
						<?php
							echo $this->Form->input('ketelitian', array(
								'label'			=> 'Ketelitian (*)',
								'type'			=> 'text',
								'div' 			=> 'formRow',
								'between'		=> '<div class="rightPart"><div class="formRight">',
								'after' 		=> '</div></div>',
								'error' 		=> array('attributes' => array('wrap' => 'label', 'class' => 'formRight error')),
								'placeholder' 	=> ''
							));
						?>
						<?php
							echo $this->Form->input('kehatian', array(
								'label'			=> 'Kehati-hatian (*)',
								'type'			=> 'text',
								'div' 			=> 'formRow',
								'between'		=> '<div class="rightPart"><div class="formRight">',
								'after' 		=> '</div></div>',
								'error' 		=> array('attributes' => array('wrap' => 'label', 'class' => 'formRight error')),
								'placeholder' 	=> ''
							));
						?>
						<?php
							echo $this->Form->input('pengendalian_perasaan', array(
								'label'			=> 'Pengendalian Perasaan (*)',
								'type'			=> 'text',
								'div' 			=> 'formRow',
								'between'		=> '<div class="rightPart"><div class="formRight">',
								'after' 		=> '</div></div>',
								'error' 		=> array('attributes' => array('wrap' => 'label', 'class' => 'formRight error')),
								'placeholder' 	=> ''
							));
						?>
						<?php
							echo $this->Form->input('dorongan_prestasi', array(
								'label'			=> 'Dorongan Prestasi (*)',
								'type'			=> 'text',
								'div' 			=> 'formRow',
								'between'		=> '<div class="rightPart"><div class="formRight">',
								'after' 		=> '</div></div>',
								'error' 		=> array('attributes' => array('wrap' => 'label', 'class' => 'formRight error')),
								'placeholder' 	=> ''
							));
						?>
						<?php
							echo $this->Form->input('perencanaan', array(
								'label'			=> 'Perencanaan (*)',
								'type'			=> 'text',
								'div' 			=> 'formRow',
								'between'		=> '<div class="rightPart"><div class="formRight">',
								'after' 		=> '</div></div>',
								'error' 		=> array('attributes' => array('wrap' => 'label', 'class' => 'formRight error')),
								'placeholder' 	=> ''
							));
						?>
						<div class="title">
							<img src="<?php echo $this->webroot ?>img/icons/dark/list.png" alt="" class="titleIcon" />
							<h6>Prilaku</h6>
						</div>
						<?php
							echo $this->Form->input('kekuasaan', array(
								'label'			=> 'Kepimimpinan (*)',
								'type'			=> 'text',
								'div' 			=> 'formRow',
								'between'		=> '<div class="rightPart"><div class="formRight">',
								'after' 		=> '</div></div>',
								'error' 		=> array('attributes' => array('wrap' => 'label', 'class' => 'formRight error')),
								'placeholder' 	=> ''
							));
						?>
						<?php
							echo $this->Form->input('pengaruh', array(
								'label'			=> 'Pengaruh (*)',
								'type'			=> 'text',
								'div' 			=> 'formRow',
								'between'		=> '<div class="rightPart"><div class="formRight">',
								'after' 		=> '</div></div>',
								'error' 		=> array('attributes' => array('wrap' => 'label', 'class' => 'formRight error')),
								'placeholder' 	=> ''
							));
						?>
						<?php
							echo $this->Form->input('keteguhan_hati', array(
								'label'			=> 'Keteguhan Hati (*)',
								'type'			=> 'text',
								'div' 			=> 'formRow',
								'between'		=> '<div class="rightPart"><div class="formRight">',
								'after' 		=> '</div></div>',
								'error' 		=> array('attributes' => array('wrap' => 'label', 'class' => 'formRight error')),
								'placeholder' 	=> ''
							));
						?>
						<?php
							echo $this->Form->input('pemenuhan', array(
								'label'			=> 'Pemenuhan (*)',
								'type'			=> 'text',
								'div' 			=> 'formRow',
								'between'		=> '<div class="rightPart"><div class="formRight">',
								'after' 		=> '</div></div>',
								'error' 		=> array('attributes' => array('wrap' => 'label', 'class' => 'formRight error')),
								'placeholder' 	=> ''
							));
						?>
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
						<div class="title">
							<img src="<?php echo $this->webroot ?>img/icons/dark/list.png" alt="" class="titleIcon" />
							<h6>Presentase Bobot Kriteria</h6>
						</div>
						<?php
							echo $this->Form->input('presentase_bobot_pengetahuan', array(
								'label'			=> 'Presentase Pengetahuan (*)',
								'type'			=> 'text',
								'div' 			=> 'formRow',
								'between'		=> '<div class="rightPart"><div class="formRight">',
								'after' 		=> '</div></div>',
								'error' 		=> array('attributes' => array('wrap' => 'label', 'class' => 'formRight error')),
								'placeholder' 	=> ''
							));
						?>
						<?php
							echo $this->Form->input('presentase_bobot_sikap_kerja', array(
								'label'			=> 'Presentase Sikap Kerja (*)',
								'type'			=> 'text',
								'div' 			=> 'formRow',
								'between'		=> '<div class="rightPart"><div class="formRight">',
								'after' 		=> '</div></div>',
								'error' 		=> array('attributes' => array('wrap' => 'label', 'class' => 'formRight error')),
								'placeholder' 	=> ''
							));
						?>
						<?php
							echo $this->Form->input('presentase_bobot_prilaku', array(
								'label'			=> 'Presentase Prilaku (*)',
								'type'			=> 'text',
								'div' 			=> 'formRow',
								'between'		=> '<div class="rightPart"><div class="formRight">',
								'after' 		=> '</div></div>',
								'error' 		=> array('attributes' => array('wrap' => 'label', 'class' => 'formRight error')),
								'placeholder' 	=> ''
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