<?php



class EventController extends Controller{
	
	public function filters(){
        return [
            'accessControl',
        ];
    }
	
	public function accessRules(){
		return [
			['deny',
				'users' => array('?'),
			],
		];
	}
	
	public function actionCombine($page = 1, $limit = 10, $q = ''){
		$teams = explode(' - ', $q);
		$team1 = isset($teams[0]) ? $teams[0] : null;
		$team2 = isset($teams[1]) ? $teams[1] : null;
		
		$list = $this->createPaginatorList(Event::model(), [
			'with' => ['events', 'forks', 'forks.f1_event', 'forks.f2_event', 'forks.f3_event'],
			'condition' => array_and([
				't.src_type = :src_type',
				array_or([
					$team1 ? '(t.team_home like :team1 or t.team_away like :team1)' : null,
					$team2 ? '(t.team_home like :team2 or t.team_away like :team2)' : null,
				]),
			]),
			'params' => array_filter([
				'src_type' => Event::SRCTYPE_COMBINE,
				'team1' => $team1 ? "%$team1%" : null,
				'team2' => $team2 ? "%$team2%" : null,
			]),
			'order' => 't.date',
			'limit' => $limit,
		], $page);
		$this->render('combine', ['list' => $list, 'q' => $q]);
	}
	
	public function actionNotCombine($page = 1, $limit = 10, $q = ''){
		$teams = explode(' - ', $q);
		$team1 = isset($teams[0]) ? $teams[0] : null;
		$team2 = isset($teams[1]) ? $teams[1] : null;
		
		$list = $this->createPaginatorList(Event::model(), [
			'with' => ['events', 'forks', 'forks.f1_event', 'forks.f2_event', 'forks.f3_event'],
			'condition' => array_and([
				't.src_type = :src_type',
				'(select count(id) from event where event_id = t.id) < :srctypes_count',
				array_or([
					$team1 ? '(t.team_home like :team1 or t.team_away like :team1)' : null,
					$team2 ? '(t.team_home like :team2 or t.team_away like :team2)' : null,
				]),
			]),
			'params' => array_filter([
				'src_type' => Event::SRCTYPE_COMBINE,
				'srctypes_count' => count(Event::$SRCTYPE_STRINGS) - 1,
				'team1' => $team1 ? "%$team1%" : null,
				'team2' => $team2 ? "%$team2%" : null,
			]),
			'order' => 't.date',
			'limit' => $limit,
		], $page);
		$this->render('combine', ['list' => $list, 'q' => $q]);
	}
	
	public function actionHide($id){
		$event = Event::model()->findByPk($id);
		if($event){
			$event->visible = false;
			$event->save();
		}
	}
	
	public function actionShow($id){
		$event = Event::model()->findByPk($id);
		if($event){
			$event->visible = true;
			$event->save();
		}
	}
	
	public function actionSearchCombine($q = '', $event_id = null){
		$q = trim($q);
		
		$event = $event_id ? Event::model()->findByPk($event_id) : null;
		
		$list = Event::model()->findAll([
			'condition' => implode(' and ', array_filter([
				'src_type = :src_type',
				$q ? 
					strpos($q, ' - ') ?
						'(concat(team_home," - ", team_away) like :q or concat(team_away," - ", team_home) like :q)' :
						'(team_home like :q or team_away like :q)' :
					null,
				$event ?
					'id <> :not_id' :
					null,
			])),
			'params' => array_filter([
				'src_type' => Event::SRCTYPE_COMBINE,
				'q' => $q ? "%$q%" : null,
				'not_id' => $event ? $event->id : null,
			]),
			'limit' => $event ? 9 : 10,
			'order' => 'date',
		]);
		
		$list = $event ? array_merge([$event], $list) : $list;
		
		$this->renderJson(['list' => $list]);
	}
	
	public function actionSearch($event_id, $q = ''){
		$teams = explode(' - ', $q);
		$team1 = isset($teams[0]) ? $teams[0] : null;
		$team2 = isset($teams[1]) ? $teams[1] : null;
		
		$event = Event::model()->with(['events'])->findByPk($event_id);
		if(!$event) return;
		
		$list = Event::model()->findAll([
			'condition' => array_and([
				'src_type <> :src_type',
				'event_id is null',
				array_or([
					$team1 ? '(team_home like :team1 or team_away like :team1)' : null,
					$team2 ? '(team_home like :team2 or team_away like :team2)' : null,
				]),
			]),
			'params' => array_filter([
				'src_type' => Event::SRCTYPE_COMBINE,
				'team1' => $team1 ? "%$team1%" : null,
				'team2' => $team2 ? "%$team2%" : null,
			]),
			'limit' => 10 - count($event->events),
			'order' => 'date',
		]);
		
		$list = array_merge($event->events, $list);
		
		$this->renderJson(['list' => $list]);
	}
	
	public function actionLink($id, $event_id = null){
		$event = Event::model()->findByPk($id);
		if(!$event) return;
		$event->event_id = $event_id;
		$event->save();
		if($event_id){
			$event->updateHomeTeamConvert($event->cevent->team_home, TeamConvert::TYPE_MANUAL);
			$event->updateAwayTeamConvert($event->cevent->team_away, TeamConvert::TYPE_MANUAL);
		}else{
			$event->updateHomeTeamConvert('', TeamConvert::TYPE_MANUAL);
			$event->updateAwayTeamConvert('', TeamConvert::TYPE_MANUAL);
		}
	}
	
	public function actionReverse($id){
		$event = Event::model()->findByPk($id);
		$event->teams_reversed = $event->teams_reversed ? false : true;
		$event->reverseTeams();
		$event->save();
		$this->renderJson(['event' => $event]);
	}
	
	public function actionETZ($page = 1, $limit = 10, $q = ''){
		$this->actionList(Event::SRCTYPE_ETOPAZ, $page, $limit, $q);
	}
	
	public function actionPNS($page = 1, $limit = 10, $q = ''){
		$this->actionList(Event::SRCTYPE_PINNACLESPORTS, $page, $limit, $q);
	}
		
	public function actionWLH($page = 1, $limit = 10, $q = ''){
		$this->actionList(Event::SRCTYPE_WILLIAMHILL, $page, $limit, $q);
	}
	
	private function actionList($src_type, $page = 1, $limit = 10, $q = ''){
		$teams = explode(' - ', $q);
		$team1 = isset($teams[0]) ? $teams[0] : null;
		$team2 = isset($teams[1]) ? $teams[1] : null;
		
		$list = $this->createPaginatorList(Event::model(), [
			'condition' => array_and([
				't.src_type = :src_type',
				array_or([
					$team1 ? '(t.team_home like :team1 or t.team_away like :team1)' : null,
					$team2 ? '(t.team_home like :team2 or t.team_away like :team2)' : null,
				]),
			]),
			'params' => array_filter([
				'src_type' => $src_type,
				'team1' => $team1 ? "%$team1%" : null,
				'team2' => $team2 ? "%$team2%" : null,
			]),
			'order' => 't.date',
			'limit' => $limit,
		], $page);
		$this->render('list', ['src_type' => $src_type, 'list' => $list, 'q' => $q]);
	}
	
	
}
