<?php
	/*
     * Viikon kouluruoka [Backend]
     * (C) Elias Ojala 2017
     */

	namespace ViikonKouluruoka;
	
	class ArkeaAPI extends DataFetcher {
		public function getData($url, $lang = "fi") {
			/*
			 * TODO: Solve issue when's some special day, when's no school. (like "2. pääsiäispäivä")
			 * 		 JSON: {"Date":"2017-04-17T00:00:00+03:00","SetMenus":{"":{"Apple":"0","Components":{"Dish":["2. P\u00c4\u00c4SI\u00c4ISP\u00c4IV\u00c4 ()"]}}}}
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