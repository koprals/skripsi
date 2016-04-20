<!-- HEADER -->
<div class="titleArea">
    <div class="wrapper">
        <div class="pageTitle">
            <h5><?php echo $ControllerName?></h5>
            <span>View</span>
        </div>
        <div class="middleNav">
	        <ul>
	            <li class="mUser"><a href="<?php echo $settings["cms_url"].$ControllerName?>" title="View List"><span class="list"></span></a></li>
	        </ul>
	    </div>
    </div>
</div>
<div class="line"></div>
<!-- HEADER -->

<!-- CONTENT -->
<div class="wrapper">
	<div class="fluid">
		<div class="users form span8">   
            <div class="widget">
	            <div class="title">
					<img src="<?php echo $this->webroot ?>img/icons/dark/list.png" alt="" class="titleIcon" />
					<h6><?php echo $detail[$ModelName]['nama'] ?></h6>
				</div>
	            <div class="formRow">
	                <label>Username:</label>
	                <div class="formRight">
	                    <?php echo $detail[$ModelName]['username'] ?>
	                </div>
	            </div>
	            <div class="formRow">
	                <label>Alamat:</label>
	                <div class="formRight">
	                    <?php echo $detail[$ModelName]['alamat'] ?>
	                </div>
	            </div>
	            <div class="formRow">
	                <label>Tanggal Lahir:</label>
	                <div class="formRight">
	                    <?php echo $detail[$ModelName]['tgl_lahir'] ?>
	                </div>
	            </div>
	            <div class="formRow">
	                <label>Agama:</label>
	                <div class="formRight">
	                    <?php echo $detail[$ModelName]['SKelamin'] ?>
	                </div>
	            </div>
	            <div class="formRow">
	                <label>Pendidikan:</label>
	                <div class="formRight">
	                    <?php echo $detail[$ModelName]['SPendidikan'] ?>
	                </div>
	            </div>
	        <div class="widget" id="ajaxVenueEvent">
	        </div>
			<div class="widget">
				<div class="body textC">
					<a href="<?php echo $settings["cms_url"].$ControllerName?>/Index" title="Back to List" class="button blueB" style="margin: 5px;"><span>Back to List</span></a>
					<a href="<?php echo $settings["cms_url"].$ControllerName?>/Edit/<?php echo $detail['Karyawan']['id']?>" title="Back to List" class="button redB" style="margin: 5px;"><span>Edit</span></a>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- CONTENT -->
<script>
$(document).ready(function(){
	$("#ajaxVenueEvent").css("opacity","0.5");
	$("#ajaxVenueEvent").load("<?php echo $this->Html->url(array('controller' => $ControllerName, 'action' => 'ajaxListEvent', $ID))?>",function(){
		$("#ajaxVenueEvent").css("opacity","1");
	});
});
</script>