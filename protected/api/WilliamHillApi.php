<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class WilliamHillApi{
	
	private static $CLASSES = [
		46,			// European Major Leagues
		1,			// UK Football
		275,		// UEFA Club Competitions
		36,			// International Football
		274,		// Other League Football
	];
	
	private static $MARKETS = [
		'--',		// All
		'MR',		// Match result
		'DC',		// Double chance
		'HL',		// Higher/lower
	];
	
	private static $MARKET_BETS = [
		// Match result
		'Match Betting' => [
			'${home}'				=> Event::FIELD_BET_M_1,
			'${away}'				=> Event::FIELD_BET_M_2,
			'Draw'					=> Event::FIELD_BET_M_X,
		],
		'Double Chance' => [
			'${home} Or Draw'		=> Event::FIELD_BET_M_1X,
			'${away} Or Draw'		=> Event::FIELD_BET_M_X2,
			'${home} Or ${away}'	=> Event::FIELD_BET_M_12,
		],
		'Total Match Goals Over/Under 1.5 Goals' => [
			'Over 1.5'				=> Event::FIELD_BET_M_TO15,
			'Under 1.5'				=> Event::FIELD_BET_M_TU15,
		],
		'Total Match Goals Over/Under 2.5 Goals' => [
			'Over 2.5'				=> Event::FIELD_BET_M_TO25,
			'Under 2.5'				=> Event::FIELD_BET_M_TU25,
		],
		'Total Match Goals Over/Under 3.5 Goals' => [
			'Over 3.5'				=> Event::FIELD_BET_M_TO35,
			'Under 3.5'				=> Event::FIELD_BET_M_TU35,
		],
		'${home} Under/Over 0.5 Goals' => [
			'Under'					=> Event::FIELD_BET_M_1TU05,
			'Over'					=> Event::FIELD_BET_M_1TO05,
		],
		'${home} Under/Over 1.5 Goals' => [
			'Under'					=> Event::FIELD_BET_M_1TU15,
			'Over'					=> Event::FIELD_BET_M_1TO15,
		],
		'${home} Under/Over 2.5 Goals' => [
			'Under'					=> Event::FIELD_BET_M_1TU25,
			'Over'					=> Event::FIELD_BET_M_1TO25,
		],
		'${away} Under/Over 0.5 Goals' => [
			'Under'					=> Event::FIELD_BET_M_2TU05,
			'Over'					=> Event::FIELD_BET_M_2TO05,
		],
		'${away} Under/Over 1.5 Goals' => [
			'Under'					=> Event::FIELD_BET_M_2TU15,
			'Over'					=> Event::FIELD_BET_M_2TO15,
		],
		'${away} Under/Over 2.5 Goals' => [
			'Under'					=> Event::FIELD_BET_M_2TU25,
			'Over'					=> Event::FIELD_BET_M_2TO25,
		],
		'Both Teams To Score' => [
			'Yes'					=> Event::FIELD_BET_M_GH,
			'No'					=> Event::FIELD_BET_M_GN,
		],
		
		// Period 1
		'1st Half Betting' => [
			'${home}'				=> Event::FIELD_BET_P1_1,
			'${away}'				=> Event::FIELD_BET_P1_2,
			'Draw'					=> Event::FIELD_BET_P1_X,
		],
//		'First Half Double Chance' => [
//			'${home} Or Draw'		=> Event::FIELD_BET_P1_1X,
//			'${away} Or Draw'		=> Event::FIELD_BET_P1_X2,
//			'${home} Or ${away}'	=> Event::FIELD_BET_P1_12,
//		],
		'1st Half Over/Under 0.5 Goals' => [
			'Over 0.5'				=> Event::FIELD_BET_P1_TO05,
			'Under 0.5'				=> Event::FIELD_BET_P1_TU05,
		],
		'1st Half Over/Under 1.5 Goals' => [
			'Over 1.5'				=> Event::FIELD_BET_P1_TO15,
			'Under 1.5'				=> Event::FIELD_BET_P1_TU15,
		],
		'1st Half Over/Under 2.5 Goals' => [
			'Over 2.5'				=> Event::FIELD_BET_P1_TO25,
			'Under 2.5'				=> Event::FIELD_BET_P1_TU25,
		],
		'1st Half Over/Under 3.5 Goals' => [
			'Over 3.5'				=> Event::FIELD_BET_P1_TO35,
			'Under 3.5'				=> Event::FIELD_BET_P1_TU35,
		],
		'1st Half Both Teams To Score' => [
			'Yes'					=> Event::FIELD_BET_P1_GH,
			'No'					=> Event::FIELD_BET_P1_GN,
		],
		
		// Period 2
		'2nd Half Betting' => [
			'${home}'				=> Event::FIELD_BET_P2_1,
			'${away}'				=> Event::FIELD_BET_P2_2,
			'Draw'					=> Event::FIELD_BET_P2_X,
		],
//		'Second Half Double Chance' => [
//			'${home} Or Draw'		=> Event::FIELD_BET_P2_1X,
//			'${away} Or Draw'		=> Event::FIELD_BET_P2_X2,
//			'${home} Or ${away}'	=> Event::FIELD_BET_P2_12,
//		],
		'2nd Half Over/Under 0.5 Goals' => [
			'Over 0.5'				=> Event::FIELD_BET_P2_TO05,
			'Under 0.5'				=> Event::FIELD_BET_P2_TU05,
		],
		'2nd Half Over/Under 1.5 Goals' => [
			'Over 1.5'				=> Event::FIELD_BET_P2_TO15,
			'Under 1.5'				=> Event::FIELD_BET_P2_TU15,
		],
		'2nd Half Over/Under 2.5 Goals' => [
			'Over 2.5'				=> Event::FIELD_BET_P2_TO25,
			'Under 2.5'				=> Event::FIELD_BET_P2_TU25,
		],
		'2nd Half Over/Under 3.5 Goals' => [
			'Over 3.5'				=> Event::FIELD_BET_P2_TO35,
			'Under 3.5'				=> Event::FIELD_BET_P2_TU35,
		],
		'2nd Half Both Teams To Score' => [
			'Yes'					=> Event::FIELD_BET_P2_GH,
			'No'					=> Event::FIELD_BET_P2_GN,
		],
		
	];
	
	public function getEvents(){
		$curls = [];
		foreach(self::$CLASSES as $class){
			foreach(self::$MARKETS as $market){
				$curls[] = $this->createCurl([
					'action' => 'template',
					'template' => 'getHierarchyByMarketType',
					'classId' => $class,
					'marketSort' => $market,
					'filterBIR' => 'N',
				]);
			}
		}
		
		$events = [];
		multicurl($curls, function($xml) use(&$events){
			$events = $this->convertXmlToEvents($events, $xml);
		});
		
		return $events;
	}
	
	private function convertXmlToEvents($events, $xml){
		// dump request for debug
//		file_put_contents(DIR_APP.'runtime/'.date('Ymd_His')."_wlh_$classId-$market.xml", $xml);
		
		$doc = new DOMDocument();
		$doc->loadXML($xml);
		
		$xpath = new DOMXpath($doc);
		
		$marketNodes = $xpath->query('/oxip/response/williamhill/class/type/market');
		
		foreach($marketNodes as $marketNode){
			$market_name = xpath_get_attr($xpath, '.', 'name', $marketNode);
			$market_date = xpath_get_attr($xpath, '.', 'date', $marketNode);
			$market_time = xpath_get_attr($xpath, '.', 'time', $marketNode);

			// Проверка есть ли разделители
			if (strpos($market_name,' - ') == false || strpos($market_name,' v ') == false) continue;
			
			list($market_teams, $market) = explode(' - ', xpath_get_attr($xpath, '.', 'name', $marketNode));
			list($event_home, $event_away) = explode(' v ', $market_teams);
			
			// Название ставок
			$event_vars = ['home' => $event_home, 'away' => $event_away];
			$market = $this->markMarketVars($market, $event_vars);
			// Пропускаем если не будем обрабатывать
			if(!isset(self::$MARKET_BETS[$market])) continue;
			$MARKET_BETS = [];
			foreach(self::$MARKET_BETS[$market] as $key => $value){
				$key = $this->extractMarketKeyVars($key, $event_vars);
				$MARKET_BETS[$key] = $value;
			}
			
			// Параметры события
			$event_key = $market_date.' '.$market_time.' '.$market_teams;
			if(isset($events[$event_key])){
				$event = $events[$event_key];
			}else{
				$event = [
					'src_type' => Event::SRCTYPE_WILLIAMHILL,
					'int_id' => $event_key,
					'team_home' => $event_home,
					'team_away' => $event_away,
					'date' => $market_date.' '.$market_time,
					'enabled' => true,
					'islive' => false,
				];
				foreach(Event::$FIELD_BET_STRINGS as $field => $string)
					$event[$field] = null;
			}
			
			// Ставки
			$partNodes = $xpath->query('./participant ', $marketNode);
			foreach($partNodes as $partNode){
				$part_name = xpath_get_attr($xpath, '.', 'name', $partNode);
				$part_value = xpath_get_attr($xpath, '.', 'oddsDecimal', $partNode);
				if(!isset($MARKET_BETS[$part_name])) continue;
				$bet_key = $MARKET_BETS[$part_name];
				$event[$bet_key] = $part_value;
			}
			
			$events[$event_key] = $event;
		}
		return $events;
	}
	
	private function request($params = []){
		$url = "http://cachepricefeeds.williamhill.com/openbet_cdn?".http_build_query($params);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, [
			'Accept: application/json, text/plain, */*',
			'Accept-Encoding: gzip,deflate',
			'Accept-Language:en',
		]);
		curl_setopt($ch, CURLOPT_ENCODING, 'gzip,deflate');
		curl_setopt($ch, CURLOPT_URL, $url);
		$response = curl_exec($ch);
		curl_close($ch);
		return $response;
	}
	
	private function createCurl($get = []){
		$url = "http://cachepricefeeds.williamhill.com/openbet_cdn?".http_build_query($get);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, [
			'Accept: application/json, text/plain, */*',
			'Accept-Encoding: gzip,deflate',
			'Accept-Language:en',
		]);
		curl_setopt($ch, CURLOPT_ENCODING, 'gzip,deflate');
		curl_setopt($ch, CURLOPT_URL, $url);
		return $ch;
	}
	
	private function markMarketVars($market, $vars = []){
		foreach($vars as $key => $value)
			$market = str_replace($value, '${'.$key.'}', $market);
		return $market;
	}
	
	private function extractMarketKeyVars($market_key, $vars = []){
		foreach($vars as $key => $value)
			$market_key = str_replace('${'.$key.'}', $value, $market_key);
		return $market_key;
	}
	
}
