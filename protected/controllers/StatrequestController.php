<?php





class StatrequestController extends Controller{

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
			'stat_total' => StatRequest::statDayTotal(),
			'stat_list' => StatRequest::statDayList(),
		]);
	}
	
	public function actionClear(){
		$table = StatRequest::model()->tableName();
		StatRequest::model()->getDbConnection()->createCommand("truncate table $table")->execute();
		$this->renderJson();
	}
	
}
