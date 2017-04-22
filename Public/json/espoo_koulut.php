<?php
	header("Content-Type: application/json; charset=utf-8");
    require_once("../../Functions/Functions.php");
    require_once("../../Functions/DataFetchers.php");

	echo json_encode((new ViikonKouluruoka\CGIAromiAPI)->getData("http://ruokalistat.espoocatering.fi", "bab3787c-d019-e711-a7ab-60eb696ec4bb", "fi"));