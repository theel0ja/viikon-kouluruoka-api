<?php
	header("Content-Type: application/json");
    require("../../Functions/ArkeaAPI.php"); 
    echo json_encode( arkeaAPI("http://arkea.fi/fi/ruokalista/27/lista", "fi"));