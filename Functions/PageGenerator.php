<?php
    require_once(__DIR__ . "/Functions.php");

    function pageGenerator($data, $theme = "plain") {
        if(!function_exists("gettext")) {
            error500("gettextiä ei ole asennettu palvelimeen!");
        }

        putenv('LC_ALL=fi_FI.utf8');
        setlocale(LC_ALL, 'fi_FI.utf8');
        
        bindtextdomain("viikon-kouluruoka", __DIR__ . "/../Translations/");
        textdomain("viikon-kouluruoka");
        
        $themeFile = __DIR__ . "/../Themes/" . $theme . ".php"; # TODO: regex $theme
        
        require($themeFile);
    }
