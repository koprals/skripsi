<?php
class Gap extends AppModel
{
	var $name = "Gap";

	var $belongsTo  = array(
		"ProfilKaryawan" => array(
			"className"	=>	"ProfilKaryawan",
			"foreignKey" =>	"profil_karyawan_id"
			)
		); 
}
?>