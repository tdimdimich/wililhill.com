<?php


/**
 * [db]
 * @property int $id
 * @property string $username
 * @property string $password
 * @property boolean $is_admin
 * 
 * [changes]
 * @see m150508_153454_CreateUser
 * 
 */
class User extends CActiveRecord{

	public function tableName(){
		return 'user';
	}

	public static function model($className = __CLASS__){
		return parent::model($className);
	}
	
	private static $_current;
	/** @return User */
	public static function current(){
		if(!Yii::app()->user->isGuest){
			if(!self::$_current){
				self::$_current = User::model()->findByPk(Yii::app()->user->id);
			}
			return self::$_current;
		}else{
			return false;
		}
	}

}
