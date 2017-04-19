<?php
    require_once("../../Functions/ArkeaAPI.php");
    require_once("../../Functions/PageGenerator.php");

    pageGenerator( arkeaAPI("http://arkea.fi/fi/ruokalista/27/lista", "fi") );