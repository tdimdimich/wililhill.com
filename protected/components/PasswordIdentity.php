<?php

class PasswordIdentity extends CUserIdentity{

	private $_id;
	public function getId(){
		return $this->_id;
	}

	public function authenticate(){
		$record = User::model()->findByAttributes(['username' => $this->username]);
		if($record === null){
			$this->errorCode = self::ERROR_USERNAME_INVALID;
		}else if(!CPasswordHelper::verifyPassword($this->password, $record->password)){
			$this->errorCode = self::ERROR_PASSWORD_INVALID;
		}else{
			$this->_id = $record->id;
			$this->errorCode = self::ERROR_NONE;
		}
		return !$this->errorCode;
	}

}
