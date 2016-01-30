<?php





class StattimeController extends Controller{

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
	
	public function actionIndex(){
		$this->render('index', [
			'stat_list' => StatTime::statDayList(),
		]);
	}
	
	public function actionClear(){
		$table = StatTime::model()->tableName();
		StatTime::model()->getDbConnection()->createCommand("truncate table $table")->execute();
		$this->renderJson();
	}
	
}
