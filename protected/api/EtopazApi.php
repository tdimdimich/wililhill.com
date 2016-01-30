<?php

class EtopazApi {
	
	const CURL_MAX_STREAMS = 20;
	
	// Match result
	const BETCODE_FINAL				= 285;		// 'FINAL FOOTBALL'
	const BETCODE_FINAL_1			= 400;		// 'FINAL FOOTBALL : 1'
	const BETCODE_FINAL_X			= 401;		// 'FINAL FOOTBALL : X'
	const BETCODE_FINAL_2			= 402;	    // 'FINAL FOOTBALL : 2'
	const BETCODE_FINAL_1X			= 403;	    // 'FINAL FOOTBALL : 1X'
	const BETCODE_FINAL_12			= 404;	    // 'FINAL FOOTBALL : 12'
	const BETCODE_FINAL_X2			= 405;	    // 'FINAL FOOTBALL : X2'
	// Total 1,5
	const BETCODE_FINAL_T15			= 304;	    // 'FINAL UNDER/OVER 1,5 FOOTBALL'
    const BETCODE_FINAL_TU15		= 469;	    // 'FINAL UNDER/OVER 1,5 FOOTBALL : U 1,5'
    const BETCODE_FINAL_TO15		= 470;	    // 'FINAL UNDER/OVER 1,5 FOOTBALL : O 1,5'
	// Total 2,5
	const BETCODE_FINAL_T25			= 681;	    // 'FINAL UNDER/OVER 2,5 FOOTBALL'
	const BETCODE_FINAL_TU25		= 471;	    // 'FINAL UNDER/OVER 2,5 FOOTBALL : U 2.5'
    const BETCODE_FINAL_TO25		= 472;	    // 'FINAL UNDER/OVER 2,5 FOOTBALL : O 2.5'
	// Total 3,5
	const BETCODE_FINAL_T35			= 306;	    // 'FINAL UNDER/OVER 3,5 FOOTBALL'
    const BETCODE_FINAL_TU35		= 473;	    // 'FINAL UNDER/OVER 3,5 FOOTBALL : U 3,5'
    const BETCODE_FINAL_TO35		= 474;	    // 'FINAL UNDER/OVER 3,5 FOOTBALL : O 3,5'
	// Total Home 0,5
	const BETCODE_FINAL_1_T05		= 325;		// FINAL HOME UNDER/OVER 0,5 FOOTBALL
	const BETCODE_FINAL_1_TU05		= 511;		// FINAL HOME UNDER/OVER 0,5 FOOTBALL : U 0,5
	const BETCODE_FINAL_1_TO05		= 512;		// FINAL HOME UNDER/OVER 0,5 FOOTBALL : O 0,5
	// Total Home 1,5
	const BETCODE_FINAL_1_T15		= 326;		// FINAL HOME UNDER/OVER 1,5 FOOTBALL
	const BETCODE_FINAL_1_TU15		= 513;		// FINAL HOME UNDER/OVER 1,5 FOOTBALL : U 1,5
	const BETCODE_FINAL_1_TO15		= 514;		// FINAL HOME UNDER/OVER 1,5 FOOTBALL : O 1,5
	// Total Home 2,5
	const BETCODE_FINAL_1_T25		= 327;		// FINAL HOME UNDER/OVER 2,5 FOOTBALL
	const BETCODE_FINAL_1_TU25		= 515;		// FINAL HOME UNDER/OVER 2,5 FOOTBALL : U 2,5
	const BETCODE_FINAL_1_TO25		= 516;		// FINAL HOME UNDER/OVER 2,5 FOOTBALL : O 2,5
	// Total Away 0,5
	const BETCODE_FINAL_2_T05		= 331;		// FINAL AWAY UNDER/OVER 0,5 FOOTBALL
	const BETCODE_FINAL_2_TU05		= 523;		// FINAL AWAY UNDER/OVER 0,5 FOOTBALL : U 0,5
	const BETCODE_FINAL_2_TO05		= 524;		// FINAL AWAY UNDER/OVER 0,5 FOOTBALL : O 0,5
	// Total Away 1,5
	const BETCODE_FINAL_2_T15		= 332;		// FINAL AWAY UNDER/OVER 1,5 FOOTBALL
	const BETCODE_FINAL_2_TU15		= 525;		// FINAL AWAY UNDER/OVER 1,5 FOOTBALL : U 1,5
	const BETCODE_FINAL_2_TO15		= 526;		// FINAL AWAY UNDER/OVER 1,5 FOOTBALL : O 1,5
	// Total Away 2,5
	const BETCODE_FINAL_2_T25		= 333;		// FINAL AWAY UNDER/OVER 2,5 FOOTBALL
	const BETCODE_FINAL_2_TU25		= 527;		// FINAL AWAY UNDER/OVER 2,5 FOOTBALL : U 2,5
	const BETCODE_FINAL_2_TO25		= 528;		// FINAL AWAY UNDER/OVER 2,5 FOOTBALL : O 2,5
	// Goal/No
	const BETCODE_FINAL_GHN			= 354;		// 'FINAL NO GOAL/GOAL FOOTBALL'
	const BETCODE_FINAL_GH			= 592;		// 'FINAL NO GOAL/GOAL FOOTBALL : G'
	const BETCODE_FINAL_GN			= 591;		// 'FINAL NO GOAL/GOAL FOOTBALL : NG'
	
	// Period 1
	const BETCODE_P1			= 286;		// '1st HALF'
	const BETCODE_P1_1			= 406;		// '1st HALF : 1'
    const BETCODE_P1_X			= 407;		// '1st HALF : X'
    const BETCODE_P1_2			= 408;		// '1st HALF : 2'
	// Period 1 Total 0,5
	const BETCODE_P1_T05		= 313;		// 1st HALF UNDER/OVER 0,5 FOOTBALL
	const BETCODE_P1_TU05		= 487;		// 1st HALF UNDER/OVER 0,5 FOOTBALL : Under 0,5
	const BETCODE_P1_TO05		= 488;		// 1st HALF UNDER/OVER 0,5 FOOTBALL : Over 0,5
	// Period 1 Total 1,5
	const BETCODE_P1_T15		= 314;		// '1st HALF UNDER/OVER 1,5 FOOTBALL'
	const BETCODE_P1_TU15		= 489;		// '1st HALF UNDER/OVER 1,5 FOOTBALL : U 1,5'
	const BETCODE_P1_TO15		= 490;		// '1st HALF UNDER/OVER 1,5 FOOTBALL : O 1,5'
	// Period 1 Total 2,5
	const BETCODE_P1_T25		= 315;		// '1st HALF UNDER/OVER 2,5 FOOTBALL'
	const BETCODE_P1_TU25		= 491;		// '1st HALF UNDER/OVER 2,5 FOOTBALL : U 2,5'
	const BETCODE_P1_TO25		= 492;		// '1st HALF UNDER/OVER 2,5 FOOTBALL : O 2,5'
	// Period 1 Goal/No
	const BETCODE_P1_GHN		= 355;		// '1st HALF NO GOAL/GOAL FOOTBALL'
	const BETCODE_P1_GH			= 594;		// '1st HALF NO GOAL/GOAL FOOTBALL : G'
	const BETCODE_P1_GN			= 593;		// '1st HALF NO GOAL/GOAL FOOTBALL : NG'
	
	// Period 2
	const BETCODE_P2			= 287;		// '2nd HALF'
    const BETCODE_P2_1			= 412;		// '2nd HALF : 1'
    const BETCODE_P2_X			= 413;		// '2nd HALF : X'
    const BETCODE_P2_2			= 414;		// '2nd HALF : 2'
	// Period 2 Total 0,5
	const BETCODE_P2_T05		= 319;		// 2nd HALF UNDER/OVER 0,5 FOOTBALL
	const BETCODE_P2_TU05		= 499;		// 2nd HALF UNDER/OVER 0,5 FOOTBALL : Under 0,5
	const BETCODE_P2_TO05		= 500;		// 2nd HALF UNDER/OVER 0,5 FOOTBALL : Over 0,5
	// Period 2 Total 1,5
	const BETCODE_P2_T15		= 320;		// '2nd HALF UNDER/OVER 1,5 FOOTBALL'
    const BETCODE_P2_TU15		= 501;		// '2nd HALF UNDER/OVER 1,5 FOOTBALL : U 1,5'
    const BETCODE_P2_TO15		= 502;		// '2nd HALF UNDER/OVER 1,5 FOOTBALL : O 1,5'
	// Period 2 Total 2,5
	const BETCODE_P2_T25		= 321;		// '2nd HALF UNDER/OVER 2,5 FOOTBALL'
	const BETCODE_P2_TU25		= 503;		// '2nd HALF UNDER/OVER 2,5 FOOTBALL : U 2,5'
	const BETCODE_P2_TO25		= 504;		// '2nd HALF UNDER/OVER 2,5 FOOTBALL : O 2,5'
	// Period 2 Goal/No
	const BETCODE_P2_GHN		= 356;		// '2nd HALF NO GOAL/GOAL FOOTBALL'
	const BETCODE_P2_GH			= 596;		// '2nd HALF NO GOAL/GOAL FOOTBALL : G'
	const BETCODE_P2_GN			= 595;		// '2nd HALF NO GOAL/GOAL FOOTBALL : NG'
	
	
	private static $BETCODE_FIELDS = [
		// Match result
		self::BETCODE_FINAL_1				=> Event::FIELD_BET_M_1,
		self::BETCODE_FINAL_X				=> Event::FIELD_BET_M_X,
		self::BETCODE_FINAL_2				=> Event::FIELD_BET_M_2,
		self::BETCODE_FINAL_1X				=> Event::FIELD_BET_M_1X,
		self::BETCODE_FINAL_12				=> Event::FIELD_BET_M_12,
		self::BETCODE_FINAL_X2				=> Event::FIELD_BET_M_X2,
		
		self::BETCODE_FINAL_TU15			=> Event::FIELD_BET_M_TU15,
		self::BETCODE_FINAL_TO15			=> Event::FIELD_BET_M_TO15,
		self::BETCODE_FINAL_TU25			=> Event::FIELD_BET_M_TU25,
		self::BETCODE_FINAL_TO25			=> Event::FIELD_BET_M_TO25,
		self::BETCODE_FINAL_TU35			=> Event::FIELD_BET_M_TU35,
		self::BETCODE_FINAL_TO35			=> Event::FIELD_BET_M_TO35,
		
		self::BETCODE_FINAL_1_TU05			=> Event::FIELD_BET_M_1TU05,
		self::BETCODE_FINAL_1_TO05			=> Event::FIELD_BET_M_1TO05,
		self::BETCODE_FINAL_1_TU15			=> Event::FIELD_BET_M_1TU15,
		self::BETCODE_FINAL_1_TO15			=> Event::FIELD_BET_M_1TO15,
		self::BETCODE_FINAL_1_TU25			=> Event::FIELD_BET_M_1TU25,
		self::BETCODE_FINAL_1_TO25			=> Event::FIELD_BET_M_1TO25,
		
		self::BETCODE_FINAL_2_TU05			=> Event::FIELD_BET_M_2TU05,
		self::BETCODE_FINAL_2_TO05			=> Event::FIELD_BET_M_2TO05,
		self::BETCODE_FINAL_2_TU15			=> Event::FIELD_BET_M_2TU15,
		self::BETCODE_FINAL_2_TO15			=> Event::FIELD_BET_M_2TO15,
		self::BETCODE_FINAL_2_TU25			=> Event::FIELD_BET_M_2TU25,
		self::BETCODE_FINAL_2_TO25			=> Event::FIELD_BET_M_2TO25,
		
		self::BETCODE_FINAL_GH				=> Event::FIELD_BET_M_GH,
		self::BETCODE_FINAL_GN				=> Event::FIELD_BET_M_GN,
		
		// Period 1
		self::BETCODE_P1_1					=> Event::FIELD_BET_P1_1,
		self::BETCODE_P1_X					=> Event::FIELD_BET_P1_X,
		self::BETCODE_P1_2					=> Event::FIELD_BET_P1_2,
		
		self::BETCODE_P1_TU05				=> Event::FIELD_BET_P1_TU05,
		self::BETCODE_P1_TO05				=> Event::FIELD_BET_P1_TO05,
		self::BETCODE_P1_TU15				=> Event::FIELD_BET_P1_TU15,
		self::BETCODE_P1_TO15				=> Event::FIELD_BET_P1_TO15,
		self::BETCODE_P1_TU25				=> Event::FIELD_BET_P1_TU25,
		self::BETCODE_P1_TO25				=> Event::FIELD_BET_P1_TO25,
//		self::BETCODE_P1_TU35				=> Event::FIELD_BET_P1_TU35,
//		self::BETCODE_P1_TO35				=> Event::FIELD_BET_P1_TO35,
		self::BETCODE_P1_GH					=> Event::FIELD_BET_P1_GH,
		self::BETCODE_P1_GN					=> Event::FIELD_BET_P1_GN,
		
		// Period 2
		self::BETCODE_P2_1					=> Event::FIELD_BET_P2_1,
		self::BETCODE_P2_X					=> Event::FIELD_BET_P2_X,
		self::BETCODE_P2_2					=> Event::FIELD_BET_P2_2,
		
		self::BETCODE_P2_TU05				=> Event::FIELD_BET_P2_TU05,
		self::BETCODE_P2_TO05				=> Event::FIELD_BET_P2_TO05,
		self::BETCODE_P2_TU15				=> Event::FIELD_BET_P2_TU15,
		self::BETCODE_P2_TO15				=> Event::FIELD_BET_P2_TO15,
		self::BETCODE_P2_TU25				=> Event::FIELD_BET_P2_TU25,
		self::BETCODE_P2_TO25				=> Event::FIELD_BET_P2_TO25,
//		self::BETCODE_P2_TU35				=> Event::FIELD_BET_P2_TU35,
//		self::BETCODE_P2_TO35				=> Event::FIELD_BET_P2_TO35,
		self::BETCODE_P2_GH					=> Event::FIELD_BET_P2_GH,
		self::BETCODE_P2_GN					=> Event::FIELD_BET_P2_GN,
	];
	
	private static $REQUEST_BETCODES = [
		// Match result
		self::BETCODE_FINAL,
		self::BETCODE_FINAL_T15,
		self::BETCODE_FINAL_T25,
		self::BETCODE_FINAL_T35,
		self::BETCODE_FINAL_1_T05,
		self::BETCODE_FINAL_1_T15,
		self::BETCODE_FINAL_1_T25,
		self::BETCODE_FINAL_2_T05,
		self::BETCODE_FINAL_2_T15,
		self::BETCODE_FINAL_2_T25,
		self::BETCODE_FINAL_GHN,
		// Period 1
		self::BETCODE_P1,
		self::BETCODE_P1_T05,
		self::BETCODE_P1_T15,
		self::BETCODE_P1_T25,
		self::BETCODE_P1_GHN,
		// Period 2
		self::BETCODE_P2,
		self::BETCODE_P2_T05,
		self::BETCODE_P2_T15,
		self::BETCODE_P2_T25,
		self::BETCODE_P2_GHN,
	];
	
	public function getEvents(){
		$times = $this->getFilterTimes();
		$curls = [];
		foreach($times as $time){
			$curls[] = $this->createCurl('mvc/iflex-mvc/api/events', [
				'gameType' => 'football',
				'live' => false,
				'date' => $time,
			]);
		}
		
		$events = [];
		multicurl($curls, function($json) use(&$events){
			$json_events = CJSON::decode($json);
			foreach($json_events as $json_event){
				$event = $this->convertEvent($json_event);
				if($event) $events[] = $event;
			}
		});
		
		return $events;
	}
	
	public function getEventsLive(){
		$json = $this->request('mvc/iflex-mvc/api/events', [
			'gameType' => 'football',
			'live' => true,
		]);
		$this->log($json, true);
		$json_events = CJSON::decode($json);
		$events = [];
		foreach($json_events as $json_event){
			$event = $this->convertEvent($json_event, true);
			if($event) $events[] = $event;
		}
		return $events;
	}
	
	private function convertEvent($item, $live = false){
		$teams = explode(' - ', trim($item['name']));
		if(count($teams) != 2) return null;
		$event = [
			'src_type' => Event::SRCTYPE_ETOPAZ,
			'int_id' => $item['id'],
			'int_code' => $item['code'],
			'team_home' => trim($teams[0]),
			'team_away' => trim($teams[1]),
			'enabled' => $live ? $item['status'] == 'STARTED' : $item['status'] == 'ACTIVE',
			'islive' => $live,
			'date' => gmdate(DATE_MYSQL, $item['kickOffDate'] / 1000),
		];
		// bets
		foreach(Event::$FIELD_BET_STRINGS as $field => $string) $event[$field] = null;
		foreach($item['betTypes'] as $betgroup){
			if($betgroup['code'] == self::BETCODE_FINAL)
				$event['etz_mbs'] = $betgroup['mbs'];
			foreach($betgroup['selections'] as $bet){
				if($bet['status'] != 'ACTIVE' || $bet['disabled']) continue;
				if(isset(self::$BETCODE_FIELDS[$bet['code']])){
					$field = self::$BETCODE_FIELDS[$bet['code']];
					$event[$field] = $bet['odd'];
				}
			}
		}
		return $event;
	}
	
	public function getFilterTimes(){
		$json = $this->request('mvc/iflex-mvc/api/filterGroups');
		$json_events = CJSON::decode($json);
		$times = [];
		foreach($json_events['Date']['subFilters'] as $date_filter){
			$times[] = $date_filter['query']['value'];
		}
		return $times;
	}
	
	private function request($action, $get = []){
		$ch = $this->createCurl($action, $get);
		$response = curl_exec($ch);
		curl_close($ch);
		return $response;
	}
	
	private function createCurl($action, $get = []){
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, [
			'Accept: application/json, text/plain, */*',
			'Accept-Encoding: gzip,deflate',
			'Accept-Language:en',
			'Referer: https://www.etopaz.az/ru/sportsbook',
		]);
		curl_setopt($ch, CURLOPT_ENCODING, 'gzip,deflate');
		curl_setopt($ch, CURLOPT_URL, 'https://www.etopaz.az/'.$action.($get ? '?'.http_build_query($get) : ''));
		return $ch;
	}
	
	private function log($json, $live = false, $time = null){
		// dump request for debug
//		file_put_contents(DIR_APP.'runtime/'.date('Ymd_His').'_etz'.
//				($live?'_live':'').($time?'_'.date('m-d', $time/1000):'').'.json', json_human($json));
	}
	
	public function grabBetCodes(){
		$json = $this->request('mvc/iflex-mvc/api/events', ['gameType' => 'football']);
		$events = CJSON::decode($json);
		
		$bet_codes = [];
		foreach($events as $event){
			foreach($event['betTypes'] as $betgroup){
				$gname = $betgroup['name'];
				$bet_codes[$gname] = $betgroup['code'];
				foreach($betgroup['selections'] as $bet){
					$code = (int)trim($bet['code']);
					$name = trim($bet['name']);
					$bet_codes[$gname.' : '.$name] = $code;
				}
			}
		}
		
		return $bet_codes;
	}
	
}


