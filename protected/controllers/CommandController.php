<?php

class CommandController extends Controller{
	
	public $COMMANDS_ALLOWED = [
		'grabber' => [
			'grabetz',
			'grabetzlive',
			'grabpns',
			'grabwlh',
		],
		'event' => [
			'link',
			'unlink',
			'updateforks',
			'clear',
		],
	];
	

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
		$this->render('index');
	}
	
	public function actionRun($ctrl, $action){
		if(isset($this->COMMANDS_ALLOWED[$ctrl]) && in_array($action, $this->COMMANDS_ALLOWED[$ctrl])){
			exec(YIIC." $ctrl $action");
			$this->renderJson();
		}else{
			$this->renderJsonError(403);
		}
	}
	
}
