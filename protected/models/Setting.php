<?php


/**
 * [db]
 * @property string $name
 * @property string $value
 * 
 * [changes]
 * @see m150514_155045_CreateSetting
 */
class Setting extends CActiveRecord{
	
	public function tableName(){
		return 'setting';
	}

	public static function model($className = __CLASS__){
		return parent::model($className);
	}
	
}
