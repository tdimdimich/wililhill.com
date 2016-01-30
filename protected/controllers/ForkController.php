<?php





class ForkController extends Controller{
	
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
	
	public function actionAll(){
		$this->render('index');
	}
	
	public function actionCompact(){
		$params = [];
		if(Yii::app()->settings->get('fork_win_min') !== '')
			$params['win_min'] = (int)Yii::app()->settings->get('fork_win_min');
		if(Yii::app()->settings->get('fork_limit') !== '')
			$params['limit'] = (int)Yii::app()->settings->get('fork_limit');
		$this->render('index', ['params' => $params]);
	}
	
	public function actionlive(){
		$this->render('index', ['params' => ['live' => true]]);
	}
	
	
	public function actionGetList($limit = 1000, $win_min = null, $live = false){
		$forks = Fork::model()->with(['event', 'f1_event', 'f2_event', 'f3_event'])->findAll([
			'condition' => implode(' and ', array_filter([
				'win is not null',
				'event.visible = true',
				$win_min !== null ? 'win > '.$win_min : null,
				$live ? '(event.islive = true)' : null,
			])),
			'order' => 'win desc',
			'limit' => $limit,
		]);
		
		$list = [];
		foreach($forks as $fork){
			$item = $fork->attributes;
			$item['event'] = $fork->event;
			$item['events'] = $fork->eventsByField;
			$list[]  = $item;
		}
		
		$this->renderJson(['list' => $list, 'events_updated' => Yii::app()->settings->get('events_updated')]);
	}
	
}
