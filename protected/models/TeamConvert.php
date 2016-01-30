<?php

/**
 * [db]
 * @property string $orig
 * @property string $name
 * @property int $type
 * 
 * [changes]
 * @see m150524_112206_CreateTeamConvert
 */
class TeamConvert extends CActiveRecord{
	
	const TYPE_AUTO = 1;
	const TYPE_MANUAL = 2;
	
	
	public function tableName(){
		return 'team_convert';
	}

	/** @return TeamConvert */
	public static function model($className = __CLASS__){
		return parent::model($className);
	}
	
	public function getTypeString(){
		return $this->type == self::TYPE_AUTO ? 'a' : 'm';
	}
	
}

