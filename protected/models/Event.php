<?php

/**
 * [db]
 * @property int $id
 * @property int $event_id
 * @property int $src_type
 * @property string $int_id
 * @property string $int_code
 * @property string $team_home
 * @property string $team_away
 * @property boolean $teams_reversed
 * @property datetime $date
 * @property boolean $enabled
 * @property datetime $updated
 * @property boolean $visible
 * @property boolean $islive
 * @property int $etz_mbs
 * // bets
 * @property int $bet_m_1
 * @property int $bet_m_x
 * @property int $bet_m_2
 * @property int $bet_m_1x
 * @property int $bet_m_12
 * @property int $bet_m_x2
 * @property int $bet_m_tu15
 * @property int $bet_m_to15
 * @property int $bet_m_tu25
 * @property int $bet_m_to25
 * @property int $bet_m_tu35
 * @property int $bet_m_to35
 * @property int $bet_m_1tu05
 * @property int $bet_m_1to05
 * @property int $bet_m_1tu15
 * @property int $bet_m_1to15
 * @property int $bet_m_1tu25
 * @property int $bet_m_1to25
 * @property int $bet_m_2tu05
 * @property int $bet_m_2to05
 * @property int $bet_m_2tu15
 * @property int $bet_m_2to15
 * @property int $bet_m_2tu25
 * @property int $bet_m_2to25
 * @property int $bet_m_gh
 * @property int $bet_m_gn
 * // bets p1
 * @property int $bet_p1_1
 * @property int $bet_p1_x
 * @property int $bet_p1_2
 * @property int $bet_p1_tu05
 * @property int $bet_p1_to05
 * @property int $bet_p1_tu15
 * @property int $bet_p1_to15
 * @property int $bet_p1_tu25
 * @property int $bet_p1_to25
 * @property int $bet_p1_tu35
 * @property int $bet_p1_to35
 * @property int $bet_p1_gh
 * @property int $bet_p1_gn
 * // bets p2
 * @property int $bet_p2_1
 * @property int $bet_p2_x
 * @property int $bet_p2_2
 * @property int $bet_p2_tu05
 * @property int $bet_p2_to05
 * @property int $bet_p2_tu15
 * @property int $bet_p2_to15
 * @property int $bet_p2_tu25
 * @property int $bet_p2_to25
 * @property int $bet_p2_tu35
 * @property int $bet_p2_to35
 * @property int $bet_p2_gh
 * @property int $bet_p2_gn
 * 
 * 
 * [relations]
 * @property Event $cevent
 * @property array $events
 * @property TeamConvert $team_home_convert
 * @property TeamConvert $team_away_convert
 * @property array $forks
 * 
 * [dynamic]
 * @property string $teamHomeConverted
 * @property string $teamAwayConverted
 * 
 * [changes]
 * @see m150518_212724_CreateEvent
 * @see m150524_120627_AddEventIdToEvent
 * @see m150524_134834_AddDefaultsToEvent
 * @see m150531_102232_AddIndexsToEvent
 * @see m150603_160733_AddEnabledToEvent
 * @see m150714_144404_AddVisibleToEventAndFork
 * @see m150714_173854_AddTeamsReversedToEvent
 * @see m150730_084206_AddEtzMbsToEvent
 * @see m150827_090445_AddIntCodeToEvent
 * @see m150831_132452_AddIsLiveToEvent
 * @see m150929_115816_AddPeriodsBetToEvent
 * @see m151029_141050_IncreaseIntIdAndCodeToEvent
 * @see m151112_080103_MigrateFromMemoryTable
 * @see m151112_085316_AddMToMatchBetToEvent
 * @see m151112_092351_AddNewBetsToEvent
 * 
 */
class Event extends CActiveRecord{
	
	const SRCTYPE_COMBINE = 1;
	const SRCTYPE_ETOPAZ = 2;
	const SRCTYPE_PINNACLESPORTS = 3;
	const SRCTYPE_WILLIAMHILL = 4;
	
	
	public static $SRCTYPE_STRINGS = [
		self::SRCTYPE_COMBINE				=> 'Объединенный',
		self::SRCTYPE_ETOPAZ				=> 'Etopaz',
		self::SRCTYPE_PINNACLESPORTS		=> 'Pinnacle',
		self::SRCTYPE_WILLIAMHILL			=> 'WilliamH',
	];
	
	public static $SRCTYPE_FULLSTRINGS = [
		self::SRCTYPE_COMBINE				=> 'Объединенный',
		self::SRCTYPE_ETOPAZ				=> 'Etopaz',
		self::SRCTYPE_PINNACLESPORTS		=> 'Pinnacle Sports',
		self::SRCTYPE_WILLIAMHILL			=> 'William Hill',
	];
	
	// match
	const FIELD_BET_M_1			= 'bet_m_1';
	const FIELD_BET_M_X			= 'bet_m_x';
	const FIELD_BET_M_2			= 'bet_m_2';
	const FIELD_BET_M_1X		= 'bet_m_1x';
	const FIELD_BET_M_12		= 'bet_m_12';
	const FIELD_BET_M_X2		= 'bet_m_x2';
	
	const FIELD_BET_M_TO15		= 'bet_m_to15';
	const FIELD_BET_M_TU15		= 'bet_m_tu15';
	const FIELD_BET_M_TO25		= 'bet_m_to25';
	const FIELD_BET_M_TU25		= 'bet_m_tu25';
	const FIELD_BET_M_TO35		= 'bet_m_to35';
	const FIELD_BET_M_TU35		= 'bet_m_tu35';
	
	const FIELD_BET_M_1TU05		= 'bet_m_1tu05';
	const FIELD_BET_M_1TO05		= 'bet_m_1to05';
	const FIELD_BET_M_1TU15		= 'bet_m_1tu15';
	const FIELD_BET_M_1TO15		= 'bet_m_1to15';
	const FIELD_BET_M_1TU25		= 'bet_m_1tu25';
	const FIELD_BET_M_1TO25		= 'bet_m_1to25';
	
	const FIELD_BET_M_2TU05		= 'bet_m_2tu05';
	const FIELD_BET_M_2TO05		= 'bet_m_2to05';
	const FIELD_BET_M_2TU15		= 'bet_m_2tu15';
	const FIELD_BET_M_2TO15		= 'bet_m_2to15';
	const FIELD_BET_M_2TU25		= 'bet_m_2tu25';
	const FIELD_BET_M_2TO25		= 'bet_m_2to25';
	
	const FIELD_BET_M_GH		= 'bet_m_gh';
	const FIELD_BET_M_GN		= 'bet_m_gn';
	// period 1
	const FIELD_BET_P1_1		= 'bet_p1_1';
	const FIELD_BET_P1_X		= 'bet_p1_x';
	const FIELD_BET_P1_2		= 'bet_p1_2';
//	const FIELD_BET_P1_1X		= 'bet_p1_1x';
//	const FIELD_BET_P1_12		= 'bet_p1_12';
//	const FIELD_BET_P1_X2		= 'bet_p1_x2';
	
	const FIELD_BET_P1_TO05		= 'bet_p1_to05';
	const FIELD_BET_P1_TU05		= 'bet_p1_tu05';
	const FIELD_BET_P1_TO15		= 'bet_p1_to15';
	const FIELD_BET_P1_TU15		= 'bet_p1_tu15';
	const FIELD_BET_P1_TO25		= 'bet_p1_to25';
	const FIELD_BET_P1_TU25		= 'bet_p1_tu25';
	const FIELD_BET_P1_TO35		= 'bet_p1_to35';
	const FIELD_BET_P1_TU35		= 'bet_p1_tu35';
	
	const FIELD_BET_P1_GH		= 'bet_p1_gh';
	const FIELD_BET_P1_GN		= 'bet_p1_gn';
	// period 2
	const FIELD_BET_P2_1		= 'bet_p2_1';
	const FIELD_BET_P2_X		= 'bet_p2_x';
	const FIELD_BET_P2_2		= 'bet_p2_2';
//	const FIELD_BET_P2_1X		= 'bet_p2_1x';
//	const FIELD_BET_P2_12		= 'bet_p2_12';
//	const FIELD_BET_P2_X2		= 'bet_p2_x2';
	
	const FIELD_BET_P2_TO05		= 'bet_p2_to05';
	const FIELD_BET_P2_TU05		= 'bet_p2_tu05';
	const FIELD_BET_P2_TO15		= 'bet_p2_to15';
	const FIELD_BET_P2_TU15		= 'bet_p2_tu15';
	const FIELD_BET_P2_TO25		= 'bet_p2_to25';
	const FIELD_BET_P2_TU25		= 'bet_p2_tu25';
	const FIELD_BET_P2_TO35		= 'bet_p2_to35';
	const FIELD_BET_P2_TU35		= 'bet_p2_tu35';
	
	const FIELD_BET_P2_GH		= 'bet_p2_gh';
	const FIELD_BET_P2_GN		= 'bet_p2_gn';
	
	public static $FIELD_BET_STRINGS = [
		// match
		self::FIELD_BET_M_1			=> 'Матч 1',
		self::FIELD_BET_M_X			=> 'Матч X',
		self::FIELD_BET_M_2			=> 'Матч 2',
		self::FIELD_BET_M_1X		=> 'Матч 1X',
		self::FIELD_BET_M_12		=> 'Матч 12',
		self::FIELD_BET_M_X2		=> 'Матч X2',
		self::FIELD_BET_M_TO15		=> 'Матч ТБ 1,5',
		self::FIELD_BET_M_TU15		=> 'Матч ТМ 1,5',
		self::FIELD_BET_M_TO25		=> 'Матч ТБ 2,5',
		self::FIELD_BET_M_TU25		=> 'Матч ТМ 2,5',
		self::FIELD_BET_M_TO35		=> 'Матч ТБ 3,5',
		self::FIELD_BET_M_TU35		=> 'Матч ТМ 3,5',
		self::FIELD_BET_M_1TU05		=> 'Матч Home ТМ 0,5',
		self::FIELD_BET_M_1TO05		=> 'Матч Home ТБ 0,5',
		self::FIELD_BET_M_1TU15		=> 'Матч Home ТМ 1,5',
		self::FIELD_BET_M_1TO15		=> 'Матч Home ТБ 1,5',
		self::FIELD_BET_M_1TU25		=> 'Матч Home ТМ 2,5',
		self::FIELD_BET_M_1TO25		=> 'Матч Home ТБ 2,5',
		self::FIELD_BET_M_2TU05		=> 'Матч Away ТМ 0,5',
		self::FIELD_BET_M_2TO05		=> 'Матч Away ТБ 0,5',
		self::FIELD_BET_M_2TU15		=> 'Матч Away ТМ 1,5',
		self::FIELD_BET_M_2TO15		=> 'Матч Away ТБ 1,5',
		self::FIELD_BET_M_2TU25		=> 'Матч Away ТМ 2,5',
		self::FIELD_BET_M_2TO25		=> 'Матч Away ТБ 2,5',
		self::FIELD_BET_M_GH		=> 'Матч гол есть',
		self::FIELD_BET_M_GN		=> 'Матч гола нет',
		// period 1
		self::FIELD_BET_P1_1		=> 'Тайм1 1',
		self::FIELD_BET_P1_X		=> 'Тайм1 X',
		self::FIELD_BET_P1_2		=> 'Тайм1 2',
//		self::FIELD_BET_P1_1X		=> 'Тайм1 1X',
//		self::FIELD_BET_P1_X2		=> 'Тайм1 X2',
//		self::FIELD_BET_P1_12		=> 'Тайм1 12',
		self::FIELD_BET_P1_TO05		=> 'Тайм1 ТБ 0,5',
		self::FIELD_BET_P1_TU05		=> 'Тайм1 ТМ 0,5',
		self::FIELD_BET_P1_TO15		=> 'Тайм1 ТБ 1,5',
		self::FIELD_BET_P1_TU15		=> 'Тайм1 ТМ 1,5',
		self::FIELD_BET_P1_TO25		=> 'Тайм1 ТБ 2,5',
		self::FIELD_BET_P1_TU25		=> 'Тайм1 ТМ 2,5',
		self::FIELD_BET_P1_TO35		=> 'Тайм1 ТБ 3,5',
		self::FIELD_BET_P1_TU35		=> 'Тайм1 ТМ 3,5',
		self::FIELD_BET_P1_GH		=> 'Тайм1 гол есть',
		self::FIELD_BET_P1_GN		=> 'Тайм1 гола нет',
		// period 2
		self::FIELD_BET_P2_1		=> 'Тайм2 1',
		self::FIELD_BET_P2_X		=> 'Тайм2 X',
		self::FIELD_BET_P2_2		=> 'Тайм2 2',
//		self::FIELD_BET_P2_1X		=> 'Тайм2 1X',
//		self::FIELD_BET_P2_X2		=> 'Тайм2 X2',
//		self::FIELD_BET_P2_12		=> 'Тайм2 12',
		self::FIELD_BET_P2_TO05		=> 'Тайм2 ТБ 0,5',
		self::FIELD_BET_P2_TU05		=> 'Тайм2 ТМ 0,5',
		self::FIELD_BET_P2_TO15		=> 'Тайм2 ТБ 1,5',
		self::FIELD_BET_P2_TU15		=> 'Тайм2 ТМ 1,5',
		self::FIELD_BET_P2_TO25		=> 'Тайм2 ТБ 2,5',
		self::FIELD_BET_P2_TU25		=> 'Тайм2 ТМ 2,5',
		self::FIELD_BET_P2_TO35		=> 'Тайм2 ТБ 3,5',
		self::FIELD_BET_P2_TU35		=> 'Тайм2 ТМ 3,5',
		self::FIELD_BET_P2_GH		=> 'Тайм2 гол есть',
		self::FIELD_BET_P2_GN		=> 'Тайм2 гола нет',
	];
	
	public function tableName(){
		return 'event';
	}

	/** @return Event */
	public static function model($className = __CLASS__){
		return parent::model($className);
	}
	
	public function relations(){
		return [
			'cevent' => [self::BELONGS_TO, 'Event', 'event_id'],
			'events' => [self::HAS_MANY, 'Event', 'event_id'],
			'team_home_convert' => [self::BELONGS_TO, 'TeamConvert', 'team_home'],
			'team_away_convert' => [self::BELONGS_TO, 'TeamConvert', 'team_away'],
			'forks' => [self::HAS_MANY, 'Fork', 'event_id'],
		];
	}
	
	protected function beforeSave(){
		// Установка времени последнего изменения
		$this->updated = gmdate(DATE_MYSQL);
		
		return parent::beforeSave();
	}
	
	public function getTeamHomeConverted(){
		return $this->team_home_convert && $this->team_home_convert->name ? $this->team_home_convert->name : $this->team_home;
	}
	
	public function getTeamAwayConverted(){
		return $this->team_away_convert && $this->team_away_convert->name ? $this->team_away_convert->name : $this->team_away;
	}
	
	private $_forksByType;
	public function getForkByType($fork_type){
		if($this->_forksByType === null){
			$this->_forksByType = [];
			foreach($this->forks as $fork){
				$fork->event = $this;
				$this->_forksByType[$fork->type] = $fork;
			}
				
		}
		if(isset($this->_forksByType[$fork_type])){
			return $this->_forksByType[$fork_type];
		}else{
			$fork = new Fork();
			$fork->event_id = $this->id;
			$fork->event = $this;
			$fork->type = $fork_type;
			return $fork;
		}
	}
	
	public function updateForks(){
		$maxbet_events = [];
		foreach(self::$FIELD_BET_STRINGS as $bet_field => $string){
			$maxbet_events[$bet_field] = null;
		}
		
		// Ищем события с максимальной ставкой
		foreach($this->events as $sevent){ /* @var $sevent Event */
			if(!$sevent->enabled) continue;
			foreach($maxbet_events as $bet_field => $max_event){
				$maxbet = $max_event ? $max_event->$bet_field : null;
				if($sevent->$bet_field && $sevent->$bet_field > $maxbet){
					$maxbet_events[$bet_field] = $sevent;
				}
			}
		}
		
		// Обновляем объединенное событий, если изменения нет выходим
		$modified = false;
		foreach(self::$FIELD_BET_STRINGS as $bet_field => $string){
			$maxbet = $maxbet_events[$bet_field] ? $maxbet_events[$bet_field]->$bet_field : null;
			if($this->$bet_field != $maxbet){
				$this->$bet_field = $maxbet;
				$modified = true;
			}
		}
		if(!$modified) return;
		$this->save();
		
		// Вычисление вилок
		foreach(Fork::$TYPES_ENABLED as $fork_type){
			$fork = $this->getForkByType($fork_type);
			$fork_fields = Fork::$FORK_FIELDS[$fork_type];
			
			$f1 = $fork_fields[0];
			$f2 = $fork_fields[1];
			$f3 = isset($fork_fields[2]) ? $fork_fields[2] : null;
			
			$f1_event = $maxbet_events[$f1];
			$f2_event = $maxbet_events[$f2];
			$f3_event = $f3 ? $maxbet_events[$f3] : null;
			
			if(
				/* f2 */($f3 == null && ($f1_event && $f2_event && $f1_event->src_type != $f2_event->src_type)) ||
				/* f3 */($f3 != null && ($f1_event && $f2_event && $f3_event && 
							count(array_unique([$f1_event->src_type, $f2_event->src_type, $f3_event->src_type])) >= 2))
			){
				$fork->f1_event_id = $f1_event->id;
				$fork->f1_event = $f1_event;
				$fork->f2_event_id = $f2_event->id;
				$fork->f2_event = $f2_event;
				$fork->f3_event_id = $f3_event ? $f3_event->id : null;
				$fork->f3_event = $f3_event;
				$fork->calcRate();
				$fork->calcWin();
				$fork->save();
			}else if(!$fork->isNewRecord){
				$fork->rate = null;
				$fork->win = null;
				$fork->save();
			}
		}
		
	}
	
	public static $CSS_CLASSES = [
		self::SRCTYPE_COMBINE => '',
		self::SRCTYPE_ETOPAZ => 'etz',
		self::SRCTYPE_PINNACLESPORTS => 'pns',
		self::SRCTYPE_WILLIAMHILL => 'wlh',
	];
	public function getCssClass(){
		return self::$CSS_CLASSES[$this->src_type];
	}
	
	public static function getSingleCombineCounts(){
		return Event::model()->count([
			'condition' => implode(' and ', [
				'src_type = '.Event::SRCTYPE_COMBINE,
				'(select count(id) from event where event_id = t.id) < :srctypes_count',
			]),
			'params' => [
				'srctypes_count' => count(Event::$SRCTYPE_STRINGS) - 1,
			]
		]);
	}
	
	public static function getCountsByType($type){
		static $counts;
		if(!$counts){
			$list = Yii::app()->db->createCommand([
				'select' => 'src_type, count(*) as count',
				'from' => Event::model()->tableName(),
				'group' => 'src_type',
			])->queryAll();
			foreach($list as $item){
				$counts[$item['src_type']] = $item['count'];
			}
		}
		return isset($counts[$type]) ? $counts[$type] : 0;
	}
	
	
	public function reverseTeams(){
		// Не работает после добавления кэфов по таймам
		
//		// team_home <-> team_away
//		$buf = $this->team_home;
//		$this->team_home = $this->team_away;
//		$this->team_away = $buf;
//		
//		// bet_1 <-> bet_2
//		$buf = $this->bet_1;
//		$this->bet_1 = $this->bet_2;
//		$this->bet_2 = $buf;
//		
//		// bet_1x <-> bet_x2
//		$buf = $this->bet_1x;
//		$this->bet_1x = $this->bet_x2;
//		$this->bet_x2 = $buf;
		
	}
	
	public function dropEventIdIfChanged($item){
		if(!$this->id || !$this->event_id) return;
		if(
			(!$this->teams_reversed && (
				$this->team_home != $item['team_home'] ||
				$this->team_away != $item['team_away'])
			) || 
			($this->teams_reversed && (
					$this->team_home != $item['team_away'] ||
					$this->team_away != $item['team_home'])
			) 
			|| $this->date != $item['date'] 
			|| $this->islive != $item['islive']
		)
		{
			$this->event_id = null;
		}
	}
	
	public function applyBetsFactor($factor){
		foreach(Event::$FIELD_BET_STRINGS as $field => $string){
			if($this->$field !== null) $this->$field *= $factor;
		}
	}
	
	public function updateHomeTeamConvert($name, $type = TeamConvert::TYPE_AUTO){
		$this->updateTeamConvert0($this->team_home_convert, $this->team_home, $name, $type);
	}
	
	public function updateAwayTeamConvert($name, $type = TeamConvert::TYPE_AUTO){
		$this->updateTeamConvert0($this->team_away_convert, $this->team_away, $name, $type);
	}
	
	private function updateTeamConvert0($convert, $orig, $name, $type = TeamConvert::TYPE_AUTO){
		if(!$convert){
			$convert = TeamConvert::model()->findByPk($orig);
			if(!$convert){
				$convert = new TeamConvert();
				$convert->orig = $orig;
			}
		}
		if($convert->name == $name) return;
		if($name){
			$convert->name = $name;
			$convert->type = $type;
			$convert->save();
		}else{
			$convert->delete();
		}
	}
	
}


