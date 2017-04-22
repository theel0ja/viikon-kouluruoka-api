<?php
    require_once("../../Functions/Functions.php");
	require_once("../../Functions/DataFetchers.php");

	$themeName = "plain";

    (new ViikonKouluruoka\PageGenerator)->generate( (new ViikonKouluruoka\CGIAromiAPI)->getData("http://ruokalistat.espoocatering.fi", "bab3787c-d019-e711-a7ab-60eb696ec4bb", "fi"), $themeName );