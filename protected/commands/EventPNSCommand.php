<?php

class EventPNSCommand extends EventCommand{
	
	private $api;
	
	public function init(){
		parent::init();
		$this->api = new PinnacleSportsApi();
	}
	
	public function actionGrab(){
		$time = StatTime::create(__METHOD__);
		
		// Загрузка событий
		$events = $this->api->getEvents();
		// Сохранение событий
		$this->saveEvents($events);
		// Убираем устаревшие события
		$this->disablePastEvents(Event::SRCTYPE_PINNACLESPORTS);
		
		$this->linkEvents(Event::SRCTYPE_PINNACLESPORTS);
		
		$this->updateForks(Event::SRCTYPE_PINNACLESPORTS);
		
		$this->saveUpdated();
		
		$time->saveTime();
	}
	
	private function saveEvents($events){
		foreach($events as $item){
			$event = Event::model()->findByAttributes(['src_type' => Event::SRCTYPE_PINNACLESPORTS, 'int_id' => $item['int_id']]);
			$event = $event ? $event : new Event(); /* @var $event Event */
			$event->dropEventIdIfChanged($item);
			$event->setAttributes($item, false);
			$event->save();
		}
	}
	
}

