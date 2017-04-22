<?php
	header("Content-Type: application/json");
    require_once("../../Functions/Functions.php");
    require_once("../../Functions/DataFetchers.php");
    echo json_encode( (new ViikonKouluruoka\ArkeaAPI)->getData("http://arkea.fi/fi/ruokalista/27/lista", "fi") );