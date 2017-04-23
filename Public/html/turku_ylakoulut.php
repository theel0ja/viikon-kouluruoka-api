<?php
    require_once("../../Functions/Functions.php");
    require_once("../../Functions/DataFetchers.php");

    if(isset($_GET["theme"])) {
        $themeName = htmlspecialchars($_GET["theme"]);
    }
    else {
        $themeName = "plain"; # Fetch the default theme
    }

    (new ViikonKouluruoka\PageGenerator)->generate( (new ViikonKouluruoka\ArkeaAPI)->getData("http://arkea.fi/fi/ruokalista/43/lista", "fi"), $themeName );
