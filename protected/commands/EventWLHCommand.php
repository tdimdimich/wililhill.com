<?php

class EventWLHCommand extends EventCommand{
	
	private $api;
	
	public function init(){
		parent::init();
		$this->api = new WilliamHillApi();
	}
	
	public function actionGrab(){
		$time = StatTime::create(__METHOD__);
		
		// Загрузка событий
		$events = $this->api->getEvents();
		// Сохранение событий
		$ids = $this->saveEvents($events);
		// Убираем события которых нет на сайте
		$this->disableLostEvents(Event::SRCTYPE_WILLIAMHILL, $ids);
		// Убираем устаревшие события
		$this->disablePastEvents(Event::SRCTYPE_WILLIAMHILL);
		
		$this->linkEvents(Event::SRCTYPE_WILLIAMHILL);
		
		$this->updateForks(Event::SRCTYPE_WILLIAMHILL);
		
		$this->saveUpdated();
		
		$time->saveTime();
	}
	
	private function saveEvents($events){
		$ids = [];
		foreach($events as $item){
			$event = Event::model()->findByAttributes(['src_type' => Event::SRCTYPE_WILLIAMHILL, 'int_id' => $item['int_id']]);
			$event = $event ? $event : new Event(); /* @var $event Event */
			$event->dropEventIdIfChanged($item);
			$event->setAttributes($item, false);
			$event->save();
			// Запоминаем id событий
			$ids[] = $event->id;
		}
		return $ids;
	}
	
}

