<?php


/**
 * [db]
 * @property int $id
 * @property int $event_id
 * @property int $type
 * @property datetime $updated
 * @property int $f1_event_id
 * @property int $f2_event_id
 * @property int $f3_event_id
 * @property int $rate
 * @property int $win
 * @property boolean $visible
 * 
 * [relations]
 * @property Event $event
 * @property Event $f1_event
 * @property Event $f2_event
 * @property Event $f3_event
 * 
 * [changes]
 * @see m150530_083918_CreateFork
 * @see m150531_102815_AddIndexsToFork
 * @see m150531_145521_AddWinToFork
 * @see m150602_183915_AddEventsToFork
 * @see m150607_172240_AddF3EventToFork
 * @see m150714_144404_AddVisibleToEventAndFork
 */
class Fork extends CActiveRecord{
	
	// Match
	const TYPE_M_1_X_2					= 1;	// 1 - X - 2
	const TYPE_M_1_X2					= 2;	// 1 - X2
	const TYPE_M_1X_2					= 3;	// 1X - 2
	const TYPE_M_T15					= 4;	// Тб(1,5) - Тм(1,5)
	const TYPE_M_T25					= 5;	// Тб(2,5) - Тм(2,5)
	const TYPE_M_T35					= 6;	// Тб(3,5) - Тм(3,5)
	
	const TYPE_M_1T05					= 30;	// Home Total 0,5
	const TYPE_M_1T15					= 31;	// Home Total 1,5
	const TYPE_M_1T25					= 32;	// Home Total 2,5
	
	const TYPE_M_2T05					= 40;	// Away Total 0,5
	const TYPE_M_2T15					= 41;	// Away Total 1,5
	const TYPE_M_2T25					= 42;	// Away Total 2,5
	
	const TYPE_M_GHN					= 7;	// Обе забьют или обе не забьют
	
	// Period 1		
	const TYPE_P1_1_X_2					= 10;	// 1 - X - 2
	const TYPE_P1_T05					= 13;	// Тб(0,5) - Тм(0,5)
	const TYPE_P1_T15					= 14;	// Тб(1,5) - Тм(1,5)
	const TYPE_P1_T25					= 15;	// Тб(2,5) - Тм(2,5)
	const TYPE_P1_T35					= 16;	// Тб(3,5) - Тм(3,5)
	const TYPE_P1_GHN					= 17;	// Обе забьют или обе не забьют
	// Period 2		
	const TYPE_P2_1_X_2					= 20;	// 1 - X - 2
	const TYPE_P2_T05					= 23;	// Тб(0,5) - Тм(0,5)
	const TYPE_P2_T15					= 24;	// Тб(1,5) - Тм(1,5)
	const TYPE_P2_T25					= 25;	// Тб(2,5) - Тм(2,5)
	const TYPE_P2_T35					= 26;	// Тб(3,5) - Тм(3,5)
	const TYPE_P2_GHN					= 27;	// Обе забьют или обе не забьют
	
	
	public static $TYPES_ENABLED = [
		// Match
		self::TYPE_M_1_X_2,
		self::TYPE_M_1_X2,
		self::TYPE_M_1X_2,
		self::TYPE_M_T15,
		self::TYPE_M_T25,
		self::TYPE_M_T35,
		
		self::TYPE_M_1T05,
		self::TYPE_M_1T15,
		self::TYPE_M_1T25,
		self::TYPE_M_2T05,
		self::TYPE_M_2T15,
		self::TYPE_M_2T25,
		
		self::TYPE_M_GHN,
		// Period 1
		self::TYPE_P1_1_X_2,
		self::TYPE_P1_T05,
		self::TYPE_P1_T15,
		self::TYPE_P1_T25,
		self::TYPE_P1_T35,
		self::TYPE_P1_GHN,
		// Period 2
		self::TYPE_P2_1_X_2,
		self::TYPE_P2_T05,
		self::TYPE_P2_T15,
		self::TYPE_P2_T25,
		self::TYPE_P2_T35,
		self::TYPE_P2_GHN,
	];
	
	public static $TYPE_STRINGS = [
		// Match
		self::TYPE_M_1_X_2				=> 'Матч 1-X-2',
		self::TYPE_M_1_X2				=> 'Матч 1-X2',
		self::TYPE_M_1X_2				=> 'Матч 1X-2',
		self::TYPE_M_T15				=> 'Матч Тотал 1,5',
		self::TYPE_M_T25				=> 'Матч Тотал 2,5',
		self::TYPE_M_T35				=> 'Матч Тотал 3,5',
		
		self::TYPE_M_1T05				=> 'Матч Home Тотал 0,5',
		self::TYPE_M_1T15				=> 'Матч Home Тотал 1,5',
		self::TYPE_M_1T25				=> 'Матч Home Тотал 2,5',
		
		self::TYPE_M_2T05				=> 'Матч Away Тотал 0,5',
		self::TYPE_M_2T15				=> 'Матч Away Тотал 1,5',
		self::TYPE_M_2T25				=> 'Матч Away Тотал 2,5',
		
		self::TYPE_M_GHN				=> 'Матч Гол есть/нет',
		// Period 1		
		self::TYPE_P1_1_X_2				=> 'Тайм1 1-X-2',
		self::TYPE_P1_T05				=> 'Тайм1 Тотал 0,5',
		self::TYPE_P1_T15				=> 'Тайм1 Тотал 1,5',
		self::TYPE_P1_T25				=> 'Тайм1 Тотал 2,5',
		self::TYPE_P1_T35				=> 'Тайм1 Тотал 3,5',
		self::TYPE_P1_GHN				=> 'Тайм1 Гол есть/нет',
		// Period 1		
		self::TYPE_P2_1_X_2				=> 'Тайм2 1-X-2',
		self::TYPE_P2_T05				=> 'Тайм2 Тотал 0,5',
		self::TYPE_P2_T15				=> 'Тайм2 Тотал 1,5',
		self::TYPE_P2_T25				=> 'Тайм2 Тотал 2,5',
		self::TYPE_P2_T35				=> 'Тайм2 Тотал 3,5',
		self::TYPE_P2_GHN				=> 'Тайм2 Гол есть/нет',
	];
	
	public static $FORK_FIELDS = [
		// Match
		self::TYPE_M_1_X_2				=> [Event::FIELD_BET_M_1, Event::FIELD_BET_M_X, Event::FIELD_BET_M_2],
		self::TYPE_M_1_X2				=> [Event::FIELD_BET_M_1, Event::FIELD_BET_M_X2],
		self::TYPE_M_1X_2				=> [Event::FIELD_BET_M_1X, Event::FIELD_BET_M_2],
		self::TYPE_M_T15				=> [Event::FIELD_BET_M_TU15, Event::FIELD_BET_M_TO15],
		self::TYPE_M_T25				=> [Event::FIELD_BET_M_TU25, Event::FIELD_BET_M_TO25],
		self::TYPE_M_T35				=> [Event::FIELD_BET_M_TU35, Event::FIELD_BET_M_TO35],
		
		self::TYPE_M_1T05				=> [Event::FIELD_BET_M_1TU05, Event::FIELD_BET_M_1TO05],
		self::TYPE_M_1T15				=> [Event::FIELD_BET_M_1TU15, Event::FIELD_BET_M_1TO15],
		self::TYPE_M_1T25				=> [Event::FIELD_BET_M_1TU25, Event::FIELD_BET_M_1TO25],
		
		self::TYPE_M_2T05				=> [Event::FIELD_BET_M_2TU05, Event::FIELD_BET_M_2TO05],
		self::TYPE_M_2T15				=> [Event::FIELD_BET_M_2TU15, Event::FIELD_BET_M_2TO15],
		self::TYPE_M_2T25				=> [Event::FIELD_BET_M_2TU25, Event::FIELD_BET_M_2TO25],
		
		self::TYPE_M_GHN				=> [Event::FIELD_BET_M_GH, Event::FIELD_BET_M_GN],
		// Period 1		
		self::TYPE_P1_1_X_2				=> [Event::FIELD_BET_P1_1, Event::FIELD_BET_P1_X, Event::FIELD_BET_P1_2],
		self::TYPE_P1_T05				=> [Event::FIELD_BET_P1_TU05, Event::FIELD_BET_P1_TO05],
		self::TYPE_P1_T15				=> [Event::FIELD_BET_P1_TU15, Event::FIELD_BET_P1_TO15],
		self::TYPE_P1_T25				=> [Event::FIELD_BET_P1_TU25, Event::FIELD_BET_P1_TO25],
		self::TYPE_P1_T35				=> [Event::FIELD_BET_P1_TU35, Event::FIELD_BET_P1_TO35],
		self::TYPE_P1_GHN				=> [Event::FIELD_BET_P1_GH, Event::FIELD_BET_P1_GN],
		// Period 1		
		self::TYPE_P2_1_X_2				=> [Event::FIELD_BET_P2_1, Event::FIELD_BET_P2_X, Event::FIELD_BET_P2_2],
		self::TYPE_P2_T05				=> [Event::FIELD_BET_P2_TU05, Event::FIELD_BET_P2_TO05],
		self::TYPE_P2_T15				=> [Event::FIELD_BET_P2_TU15, Event::FIELD_BET_P2_TO15],
		self::TYPE_P2_T25				=> [Event::FIELD_BET_P2_TU25, Event::FIELD_BET_P2_TO25],
		self::TYPE_P2_T35				=> [Event::FIELD_BET_P2_TU35, Event::FIELD_BET_P2_TO35],
		self::TYPE_P2_GHN				=> [Event::FIELD_BET_P2_GH, Event::FIELD_BET_P2_GN],
	];
	
	public function tableName(){
		return 'fork';
	}

	/** @return Fork */
	public static function model($className = __CLASS__){
		return parent::model($className);
	}
	
	public function relations(){
		return [
			'event' => [self::BELONGS_TO, 'Event', 'event_id'],
			'f1_event' => [self::BELONGS_TO, 'Event', 'f1_event_id'],
			'f2_event' => [self::BELONGS_TO, 'Event', 'f2_event_id'],
			'f3_event' => [self::BELONGS_TO, 'Event', 'f3_event_id'],
		];
	}
	
	protected function beforeSave(){
		// Установка времени последнего изменения
		$this->updated = gmdate(DATE_MYSQL);
		
		return parent::beforeSave();
	}
	
	public function calcRate(){
		$fork_fields = self::$FORK_FIELDS[$this->type];
		if(count($fork_fields) == 2){
			list($f1, $f2) = $fork_fields;
			$this->rate = 1 / (1 / $this->event->$f1 + 1 / $this->event->$f2);
			return;
		}
		if(count($fork_fields) == 3){
			list($f1, $f2, $f3) = $fork_fields;
			$this->rate = 1 / (1 / $this->event->$f1 + 1 / $this->event->$f2 + 1 / $this->event->$f3);
			return;
		}
		$this->rate = null;
	}
	
	public function calcWin(){
		$fork_fields = self::$FORK_FIELDS[$this->type];
		if(count($fork_fields) == 2){
			list($f1, $f2) = $fork_fields;
			if($this->f1_event->src_type == Event::SRCTYPE_ETOPAZ){
				$etz_k = $this->event->$f1;
				$other_k = $this->event->$f2;
			}else if($this->f2_event->src_type == Event::SRCTYPE_ETOPAZ){
				$etz_k = $this->event->$f2;
				$other_k = $this->event->$f1;
			}else{
				$this->win = null;
				return;
			}
			$win_sum = 1000 * $etz_k;
			$this->win = $win_sum - (1000 + ($win_sum / $other_k));
			return;
		}
		if(count($fork_fields) == 3){
			$events = [$this->f1_event, $this->f2_event, $this->f3_event];
			
			$etz_ks = [];
			$oth_ks = [];
			for($i = 0; $i < 3; $i++){
				$fx = $fork_fields[$i];
				$e = $events[$i];
				if($e->src_type == Event::SRCTYPE_ETOPAZ)
					$etz_ks[] = $e->$fx;
				else
					$oth_ks[] = $e->$fx;
			}
			
			if(count($etz_ks) == 1){
				$win_sum = 1000 * $etz_ks[0];
				$this->win = $win_sum - (1000 + ($win_sum / $oth_ks[0]) + ($win_sum / $oth_ks[1]));
				return;
			}
			if(count($etz_ks) == 2){
				$win_sum = 1000 * $etz_ks[0] * $etz_ks[1] / ($etz_ks[0] + $etz_ks[1]);
				$this->win = $win_sum - (1000 + ($win_sum / $oth_ks[0]));
				return;
			}
		}
		$this->win = null;
	}
	
	/** @deprecated */
	public function getEventsByField(){
		$eventsByField = [];
		$events = [$this->f1_event, $this->f2_event, $this->f3_event];
		foreach(Fork::$FORK_FIELDS[$this->type] as $i => $field)
			$eventsByField[$field] = $events[$i];
		return $eventsByField;
	}
	
}
