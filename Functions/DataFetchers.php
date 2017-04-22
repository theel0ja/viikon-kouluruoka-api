<?php
	/*
     * Viikon kouluruoka [Backend]
     * (C) Elias Ojala 2017
     */

	namespace ViikonKouluruoka;
	
	/**
	 * API for Arkea's website
	 */
	class ArkeaAPI extends DataFetcher {
		public function getData($url, $lang = "fi") {
			/*
			 * TODO: Make it compatible with Turku Normaalikoulu
			 */
			
			/*
			 * TODO: Solve issue when's some special day, when's no school. (like "2. pääsiäispäivä")
			 * 		 JSON: {"Date":"2017-04-17T00:00:00+03:00","SetMenus":{"":{"Apple":"0","Components":{"Dish":["2. P\u00c4\u00c4SI\u00c4ISP\u00c4IV\u00c4 ()"]}}}}
			 *		 From normaalikoulu: https://gist.github.com/theel0ja/d8e98a584d56f95df549871a13a70e6e
			 */
			
			// Initialize
			$response = array();

			// Download data
			$data = parent::downloadData($url);
			$data = json_decode($data, TRUE);

			#$response = $data;
			$response["name"] = $data["RestaurantName"];
			$response["url"] = $data["RestaurantUrl"];
			$response["menu"] = array();
				for($day = 0; $day <= count($data["MenusForDays"]) -1; $day++) {
					$response["menu"][$day] = array();

						$response["menu"][$day]["date"] = $data["MenusForDays"][$day]["Date"];

						if(isset($data["MenusForDays"][$day]["SetMenus"]["Lounas"])) {
							$response["menu"][$day]["lunch"] = $data["MenusForDays"][$day]["SetMenus"]["Lounas"]["Components"]["Dish"];
						}
						if(isset($data["MenusForDays"][$day]["SetMenus"]["Kasvislounas"])) {
							$response["menu"][$day]["vegetarian_lunch"] = $data["MenusForDays"][$day]["SetMenus"]["Kasvislounas"]["Components"]["Dish"];
						}
						if(isset($data["MenusForDays"][$day]["SetMenus"]["Ip-toiminnan välipala"])) {
							$response["menu"][$day]["after_school_activity"] = $data["MenusForDays"][$day]["SetMenus"]["Ip-toiminnan välipala"]["Components"]["Dish"];
						}
						# TODO: Add support for Milkless, Eggless, etc.
				}

			#$response["more_info"] = $data["RestaurantFooter"];

			// Return result to application
			if(gettype($response) === "array") {
				return $response;
			}
			else {
				throw new Exception('$response isn\'t array!');
			}
		}
	}

	/**
	 * API for CGI's Aromi system
	 */
	class CGIAromiAPI extends DataFetcher {
		/**
		 * Fetches list of menus.
		 */
		public function getMenus($url) {
			
			# TODO!
			
			$data = parent::downloadData($url);
			$data = json_decode($data, TRUE);
			
			$response = array();
			
			$response["Categories"] = $data["Categories"];
			$response["Restaurants"] = $data["Restaurants"];
			
			return $response;
		}
		
		/**
		 * Fetches the food of specific menu. ($uuid)
		 * 
		 * $menuUrl = URL
		 * $uuid    = UUID of the menu
		 * $lang    = Language (fi, en, sv)
		 */
		public function getData($menuUrl, $uuid, $lang) {
			
			$data = parent::downloadData($menuUrl . "/AromiStorageEspoo/blob/menu/" . $uuid);
			$data = json_decode($data, TRUE);
			
			unset($data["Translations"]);
			$data = $data["Days"];
			
			$response = array();
			$response["name"] = "Koulut, Espoo"; # TODO: fetch them from somewhere
			$response["url"] = $menuUrl . "/" . "#/" . "2856c0d5-d3f7-e511-bc65-60eb696ec4bb"; # TODO: different that $uuid, get it from somewhere
			
			
			$i = 0;
			foreach($data as $day) {
				$response["menu"][$i]["date"] = $day["Date"]; # TODO: make it same format as Arkea's.
				
				if($lang == "fi") {
					$response["menu"][$i]["lunch"][0] = $day["Meals"][0]["Name"]; # TODO: Do not hardcode "0"
				} elseif($lang == "en") {
					# TODO: test en & sv
					$response["menu"][$i]["lunch"][0] = $day["Meals"][0]["Translations"][0]["Name"]; # TODO: Do not hardcode to "0", use "LanguageId" instead
				} elseif($lang == "sv") {
					$response["menu"][$i]["lunch"][0] = $day["Meals"][0]["Translations"][1]["Name"]; # TODO: Do not hardcode to "1", use "LanguageId" instead
				}
				
				if($lang == "fi") {
					$response["menu"][$i]["vegetarian_lunch"][0] = $day["Meals"][1]["Name"]; # TODO: Do not hardcode "1"
				} elseif($lang == "en") {
					# TODO: test en & sv
					$response["menu"][$i]["vegetarian_lunch"][0] = $day["Meals"][1]["Translations"][0]["Name"]; # TODO: Do not hardcode to "0", use "LanguageId" instead
				} elseif($lang == "sv") {
					$response["menu"][$i]["vegetarian_lunch"][0] = $day["Meals"][1]["Translations"][1]["Name"]; # TODO: Do not hardcode to "1", use "LanguageId" instead
				}
				
				#$response["menu"][$i]["etc"] = $day; # Just for debug purposes
				
				$i++;
			}
			unset($i);
			
			return $response;
		}
	}