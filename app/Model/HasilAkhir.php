<?php
class HasilAKhir extends AppModel
{
	var $name = "HasilAkhir";

	var $belongsTo  = array(
		"Gap" => array(
			"className"	=>	"Gap",
			"foreignKey" =>	"gap_id"
			)
		);
}
?>