<?php
	header("Content-Type: application/json; charset=utf-8");
    require_once("../../Functions/Functions.php");
    require_once("../../Functions/DataFetchers.php");

    echo json_encode( (new ViikonKouluruoka\ArkeaAPI)->getData("http://arkea.fi/fi/ruokalista/43/lista", "fi") );