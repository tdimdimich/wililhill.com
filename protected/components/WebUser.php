<?php

class WebUser extends CWebUser {
	
	public function checkAccess($operation, $params=array(), $allowCaching=true){
		return User::current() && User::current()->is_admin ? true : false;
	}
	
}