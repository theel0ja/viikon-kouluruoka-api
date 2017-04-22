<?php
    require_once("../../Functions/Functions.php");
	require_once("../../Functions/DataFetchers.php");

	$themeName = "plain";

    (new ViikonKouluruoka\PageGenerator)->generate( (new ViikonKouluruoka\ArkeaAPI)->getData("http://arkea.fi/fi/ruokalista/27/lista", "fi"), $themeName );