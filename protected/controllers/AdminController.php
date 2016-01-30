<?php





class AdminController extends Controller{
	
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
	}
	
	
	public function actionSettings(){
		if(Yii::app()->request->isPostRequest){
			foreach(Settings::$DEFAULTS as $name => $value){
				Yii::app()->settings->set($name, Yii::app()->request->getParam($name));
			}
		}
		$this->render('settings');
	}
	

}
