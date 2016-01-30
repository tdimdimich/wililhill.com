<?php



class UserController extends Controller{
	
	const COOKIE_LOGIN_DURATION = 1209600; // 14*24*3600

//	public function actionIndex(){
//		
//		var_dump(User::model()->findAll());
//		
//		//$this->render('index');
//	}
	
	public function actionLogin(){
		$username = '';
		if(Yii::app()->request->isPostRequest){
			$user = Yii::app()->request->getParam('user');
			$username = $user['username'];
			$password = $user['password'];
			$rememberme = Yii::app()->request->getParam('rememberme', false);
			$identity = new PasswordIdentity($username, $password);
			if($identity->authenticate()){
				Yii::app()->user->login($identity, ($rememberme ? self::COOKIE_LOGIN_DURATION : 0));
				if(Yii::app()->user->returnUrl)
					$this->redirect(Yii::app()->user->returnUrl);
				else
					$this->redirect('/');
			}
		}

		$this->render('login', ['username' => $username]);
	}
	
	public function actionLogout(){
		Yii::app()->user->logout(false);
		$this->redirect('/');
	}

}
