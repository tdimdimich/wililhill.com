<?php





class TeamController extends Controller{

	public function filters(){
        return [
            'accessControl',
        ];
    }
	
	public function accessRules(){
		return [
			['allow',
				'roles' => ['admin'],
			],
			['deny'],
		];
	}
	
	public function actionIndex($q = ''){
		$where = '';
		$params = [];
		
		if($q){
			$where .= ($where?' and ':'') . '(orig like :q or name like :q)';
			$params['q'] = "%$q%";
		}
		
		$teams = TeamConvert::model()->findAll([
			'condition' => $where,
			'params' => $params,
			'order' => 'orig',
			'limit' => 1000,
		]);
		
		$this->render('index', ['teams'=>$teams, 'q' => $q]);
	}
	
	public function actionAdd(){
		$orig = Yii::app()->request->getParam('orig');
		$name = Yii::app()->request->getParam('name');
		
		if(!$orig)
			$this->renderJsonError(400, 'Orig is empty', ['msg' => 'Введите оригинальное название!']);
		
		$team = TeamConvert::model()->findByAttributes(['orig' => $orig]);
		if($team)
			$this->renderJsonError(400, 'Already exists', ['msg' => 'Замена на такую команду уже существует!']);
		
		$team = new TeamConvert();
		$team->orig = $orig;
		$team->name = $name;
		$team->type = TeamConvert::TYPE_MANUAL;
		$team->save();
		
		$this->renderJson(['team' => $team, 'get' => $_GET, 'post' => $_POST]);
	}
	
	public function actionEdit(){
		$orig = Yii::app()->request->getParam('orig');
		$name = Yii::app()->request->getParam('name');
		
		$team = TeamConvert::model()->findByAttributes(['orig' => $orig]);
		if($team){
			$team->name = $name;
			$team->type = TeamConvert::TYPE_MANUAL;
			$team->save();		
		}
		$this->renderJson();
	}
	
	public function actionDelete($orig){
		TeamConvert::model()->deleteAllByAttributes(['orig' => $orig]);
		$this->renderJson();
	}
	
	
}
