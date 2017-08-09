<?php
	namespace ViikonKouluruoka;

	if(!function_exists("gettext")) {
		throw new Exception("gettext isn't installed to the server!");

		// TODO: BUG
		// 		Fatal error: Uncaught Error: Class 'ViikonKouluruoka\Exception' not found in /var/www/html/Functions/Functions.php:5
		//		Stack trace: #0 /var/www/html/Public/html/turku_alakoulut.php(2): require_once() #1 {main} thrown in /var/www/html/Functions/Functions.php on line 5
	}

	putenv('LC_ALL=fi_FI.utf8');
	setlocale(LC_ALL, 'fi_FI.utf8');

	bindtextdomain("viikon-kouluruoka", __DIR__ . "/../Translations/");
	textdomain("viikon-kouluruoka");

	class DataFetcher {
		public function downloadData($url) {
			$data = file_get_contents($url);
			return $data;
		}
	}

	class PageGenerator {
		public function generate($data, $theme = "plain") {
			$themeFile = __DIR__ . "/../Themes/" . $theme . ".php"; # TODO: regex $theme

            if(file_exists($themeFile)) {
                require_once($themeFile);
            }
            else {
                require_once(__DIR__ . "/../Themes/plain.php");
            }
		}
	}