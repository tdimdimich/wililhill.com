<?php

class EventETZCommand extends EventCommand{
	
	private $api;
	
	public function init(){
		parent::init();
		$this->api = new EtopazApi();
	}
	
	public function actionGrab(){
		$time = StatTime::create(__METHOD__);
		$this->grabEvents();
		$time->saveTime();
	}
	
	public function actionGrabLive(){
		$time = StatTime::create(__METHOD__);
		$this->grabEvents(true);
		$time->saveTime();
	}
	
	public function actionGrabBetCodes(){
		$bet_codes = $this->api->grabBetCodes();
		
		$sql = "replace into d_etzbetcode (name, code) values ";
		$values = '';
		foreach($bet_codes as $name => $code){
			if($values) $values .= ', ';
			$values .= "('$name','$code')";
		}
		$sql .= $values;
		Yii::app()->db->createCommand($sql)->execute();
	}
	
	private function grabEvents($live = false){
		// Загрузка событий
		$events = $live ? $this->api->getEventsLive() : $this->api->getEvents();
		// Сохранение событий
		$ids = $this->saveEvents($events);
		// Убираем события которых нет на сайте
		$this->disableLostEvents(Event::SRCTYPE_ETOPAZ, $ids, $live);
		// Убираем устаревшие события
		$this->disablePastEvents(Event::SRCTYPE_ETOPAZ);
		
		$this->createCombineEvents();
//		
		$this->linkEvents(Event::SRCTYPE_ETOPAZ);
//		
		$this->updateForks(Event::SRCTYPE_ETOPAZ);
		
		$this->saveUpdated();
	}
	
	private function saveEvents($events){
		$ids = [];
		foreach($events as $item){
			// Запрещенные события
			if($this->isTeamDenied($item['team_home']) || $this->isTeamDenied($item['team_away'])) continue;
			
			$event = Event::model()->findByAttributes(['src_type' => Event::SRCTYPE_ETOPAZ, 'int_id' => $item['int_id']]);
			$event = $event ? $event : new Event(); /* @var $event Event */
			$event->dropEventIdIfChanged($item);
			$event->setAttributes($item, false);
			if($event->islive) $event->applyBetsFactor(1.04);
			if($event->teams_reversed) $event->reverseTeams();
			$event->save();
			// Запоминаем id событий
			$ids[] = $event->id;
		}
		return $ids;
	}
	
	private function isTeamDenied($team){
		foreach(['2H', '3H', '4H', '5H'] as $suffix){
			if(preg_match("/\($suffix\)/", $team))
				return true;
		}
		return false;
	}
	
	private function createCombineEvents(){
		// event from etopaz not linked
		$events = Event::model()->with(['team_home_convert','team_away_convert'])->findAll([
			'select' => 'date, team_home, team_away',
			'condition' => 'event_id is null and src_type = '.Event::SRCTYPE_ETOPAZ,
			'group' => 'date, team_home, team_away',
		]);
		
		foreach($events as $event){
			// find combine event
			$cattr = [
				'src_type' => Event::SRCTYPE_COMBINE,
				'date' => $event->date,
				'team_home' => $event->teamHomeConverted,
				'team_away' => $event->teamAwayConverted,
			];
			$cevent = Event::model()->findByAttributes($cattr); /* @var $cevent Event */
			// create if not exists
			if(!$cevent){
				$cevent = new Event();
				$cevent->setAttributes($cattr, false);
				$cevent->save();
			}
		}
	}
	
	
	
}

