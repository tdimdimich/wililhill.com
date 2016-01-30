<?php

class EventCommand extends CConsoleCommand {
	
	public function actionDeleteOld(){
		Event::model()->deleteAll('date < date_sub(utc_timestamp(), interval 4 hour)');
		Fork::model()->deleteAll('(select id from event where event.id = fork.event_id) is null');
	}
	
	public function actionClear(){
		Yii::app()->db->createCommand('truncate table event')->execute();
		Yii::app()->db->createCommand('truncate table fork')->execute();
		Yii::app()->settings->set('pns_last_time', '');
		Yii::app()->settings->set('events_updated', null);
	}
	
	protected function saveUpdated(){
		Yii::app()->settings->set('events_updated', gmdate(DATE_MYSQL));
	}
	
	protected function disableLostEvents($srctype, $ids, $live = null){
		Event::model()->updateAll(['enabled' => false],
			array_and([
				'src_type = :src_type',
				'enabled = true',
				$live != null ? 'islive = :islive' : null,
				"id not in ('".implode("','", $ids)."')",
			]), array_filter([
				'src_type' => $srctype,
				'islive' => $live,
			])
		);
	}
	
	protected function disablePastEvents($src_type){
		Event::model()->updateAll(['enabled' => false],
			array_and([
				'src_type = :src_type',
				'enabled = true',
				'date < utc_timestamp()',
				'islive = false',
			]),
			['src_type' => $src_type]
		);
	}
	
	protected function linkEvents($src_type){
		$time = StatTime::create(__METHOD__);
		
		$events = Event::model()->with(['team_home_convert','team_away_convert'])->findAllByAttributes([
			'event_id' => null,
			'src_type' => $src_type,
		]);
		foreach($events as $event){ /* @var $event Event */
			$cevent = Event::model()->find(
				array_and([
					'src_type = :src_type',
					'date = :date',
					'team_home = :team_home',
					'team_away = :team_away',
				]),[
					'src_type' => Event::SRCTYPE_COMBINE,
					'date' => $event->date,
					'team_home' => $event->teamHomeConverted,
					'team_away' => $event->teamAwayConverted,
				]
			);
			if($cevent){
				$event->event_id = $cevent->id;
				$event->save();
			}
		}
		
		$time->saveTime();
	}
	
	public function updateForks($src_type){
		$time = StatTime::create(__METHOD__);
		
		$events = Event::model()->with(['events', 'forks'])->findAllByAttributes([
			'src_type' => Event::SRCTYPE_COMBINE,
		]);
		
		foreach($events as $event){ /* @var $event Event */
			$event->updateForks();
		}
		
		$time->saveTime();
	}
	
	
}

