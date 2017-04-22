<?php
	// TODO
	header("Content-Type: application/json; charset=utf-8");
    require_once("../../Functions/Functions.php");
    require_once("../../Functions/DataFetchers.php");

	$API = new ViikonKouluruoka\CGIAromiAPI;

	//print_r($ API->getMenus("http://ruokalistat.espoocatering.fi/AromiStorageEspoo/blob/main/AromiMenusJsonData", "fi"));

	print_r($API->getMenus("http://ruokalistat.espoocatering.fi/AromiStorageEspoo/blob/main/AromiMenusJsonData", "fi"));

    //json_encode( $API->getMenus("http://ruokalistat.espoocatering.fi/AromiStorageEspoo/blob/main/AromiMenusJsonData", "fi") );