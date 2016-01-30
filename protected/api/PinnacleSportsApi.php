<?php


class PinnacleSportsApi{
	
	const SPORTID = 29; // only footbal
	
	const PERIOD_MATCH = 0;
	const PERIOD_1 = 1;
	const PERIOD_2 = 2;
	
	public static $BETS_BY_PERIODS = [
		self::PERIOD_MATCH => [
			'1' => Event::FIELD_BET_M_1,
			'x' => Event::FIELD_BET_M_X,
			'2' => Event::FIELD_BET_M_2,
			'tu15' => Event::FIELD_BET_M_TU15,
			'to15' => Event::FIELD_BET_M_TO15,
			'tu25' => Event::FIELD_BET_M_TU25,
			'to25' => Event::FIELD_BET_M_TO25,
			'tu35' => Event::FIELD_BET_M_TU35,
			'to35' => Event::FIELD_BET_M_TO35,
		],
		self::PERIOD_1 => [
			'1' => Event::FIELD_BET_P1_1,
			'x' => Event::FIELD_BET_P1_X,
			'2' => Event::FIELD_BET_P1_2,
			'tu15' => Event::FIELD_BET_P1_TU15,
			'to15' => Event::FIELD_BET_P1_TO15,
			'tu25' => Event::FIELD_BET_P1_TU25,
			'to25' => Event::FIELD_BET_P1_TO25,
			'tu35' => Event::FIELD_BET_P1_TU35,
			'to35' => Event::FIELD_BET_P1_TO35,
		],
		self::PERIOD_2 => [
			'1' => Event::FIELD_BET_P2_1,
			'x' => Event::FIELD_BET_P2_X,
			'2' => Event::FIELD_BET_P2_2,
			'tu15' => Event::FIELD_BET_P2_TU15,
			'to15' => Event::FIELD_BET_P2_TO15,
			'tu25' => Event::FIELD_BET_P2_TU25,
			'to25' => Event::FIELD_BET_P2_TO25,
			'tu35' => Event::FIELD_BET_P2_TU35,
			'to35' => Event::FIELD_BET_P2_TO35,
		],
	];
	
	public function getEvents(){
		$params = [
			'sportid' => self::SPORTID,
			'oddsFormat' => 1, // Decimal odds format
			'last' => Yii::app()->settings->get('pns_last_time'),
		];
		$params = array_filter($params);
		
		$xml = $this->request('feed', $params);
		if(!$xml) return [];
		
		// dump request for debug
//		file_put_contents(DIR_APP.'runtime/'.date('Ymd_His').'_pns.xml', $xml);
		
		$doc = new DOMDocument();
		$doc->loadXML($xml);
		
		$events = [];
		
		$xpath = new DOMXpath($doc);
		
		$last = xpath_get_value($xpath, '/rsp/fd/fdTime');
		Yii::app()->settings->set('pns_last_time', $last);
		
		$leagueNodes = $xpath->query('/rsp/fd/sports/sport/leagues/league');
		foreach($leagueNodes as $leagueNode){
			$eventNodes = $xpath->query('./events/event', $leagueNode);
			foreach($eventNodes as $eventNode){
				$date = xpath_get_value($xpath, "./startDateTime", $eventNode);
				
				$event = [
					'src_type' => Event::SRCTYPE_PINNACLESPORTS,
					'int_id' => xpath_get_value($xpath, "./id", $eventNode),
					'team_home' => xpath_get_value($xpath, "./homeTeam/name", $eventNode),
					'team_away' => xpath_get_value($xpath, "./awayTeam/name", $eventNode),
					'date' => $this->create_date(xpath_get_value($xpath, "./startDateTime", $eventNode)),
					'enabled' => xpath_get_value($xpath, "./status", $eventNode) <> 'H',
					'islive' => xpath_get_value($xpath, "./IsLive", $eventNode) == 'Yes',
				];
				// defaults
				foreach(Event::$FIELD_BET_STRINGS as $field => $string)
					$event[$field] = null;
				
				
				$periodNodes = $xpath->query('./periods/period', $eventNode);
				foreach($periodNodes as $periodNode){
					$period = xpath_get_value($xpath, './number', $periodNode);
					if(!isset(self::$BETS_BY_PERIODS[$period])) continue;
					$betFields = self::$BETS_BY_PERIODS[$period];
					
					$event[$betFields['1']] = xpath_get_value($xpath, './moneyLine/homePrice', $periodNode);
					$event[$betFields['x']] = xpath_get_value($xpath, './moneyLine/drawPrice', $periodNode);
					$event[$betFields['2']] = xpath_get_value($xpath, './moneyLine/awayPrice', $periodNode);

					$totalNodes = $xpath->query('./totals/total', $periodNode);
					foreach($totalNodes as $totalNode){
						$points = xpath_get_value($xpath, './points', $totalNode);
						switch($points){
							case '1.5':
								$event[$betFields['tu15']] = xpath_get_value($xpath, './underPrice', $totalNode);
								$event[$betFields['to15']] = xpath_get_value($xpath, './overPrice', $totalNode);
								break;
							case '2.5':
								$event[$betFields['tu25']] = xpath_get_value($xpath, './underPrice', $totalNode);
								$event[$betFields['to25']] = xpath_get_value($xpath, './overPrice', $totalNode);
								break;
							case '3.5':
								$event[$betFields['tu35']] = xpath_get_value($xpath, './underPrice', $totalNode);
								$event[$betFields['to35']] = xpath_get_value($xpath, './overPrice', $totalNode);
								break;
						}
					}
				}
				
				// add to list
				$events[] = $event;
			}
		}
		
		return $events;
	}
	
	private function request($action, $params = []){
		$url = 'https://api.pinnaclesports.com/v1/'.$action.($params ? '?'.http_build_query($params) : '');

		$client_id = Yii::app()->settings->get('pns_client_id');
		$client_pass = Yii::app()->settings->get('pns_client_pass');
		
		$credentials = base64_encode("$client_id:$client_pass");

		$header[] = 'Content-length: 0';
		$header[] = 'Authorization: Basic ' . $credentials;

		$httpChannel = curl_init();
		curl_setopt($httpChannel, CURLOPT_URL, $url);
		curl_setopt($httpChannel, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($httpChannel, CURLOPT_HTTPHEADER, $header);
		curl_setopt($httpChannel, CURLOPT_SSL_VERIFYPEER, false);

		$initialFeed = curl_exec($httpChannel);
		curl_close($httpChannel);
		
		return $initialFeed;
	}
	
	private function create_date($datestring){
		$datetime = date_create($datestring);
		return gmdate(DATE_MYSQL, round_time($datetime->getTimestamp(), 300));
	}
	
	
}


