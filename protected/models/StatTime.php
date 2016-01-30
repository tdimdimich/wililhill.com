<?php

/**
 * [db]
 * @property datetime $datetime
 * @property string $action
 * @property int $count
 * @property int $time_min
 * @property int $time_max
 * @property int $time_last
 * @property int $time_total
 * 
 * [changes]
 * @see m151207_094855_CreateStatTime
 * 
 */
class StatTime extends CActiveRecord{
	
	const TIME_INTERVAL = 3600; // 60 * 60;
	
	private $start_time;
	
	public function tableName(){
		return 'stat_time';
	}

	/** @return StatRequest */
	public static function model($className = __CLASS__){
		return parent::model($className);
	}
	
	public function primaryKey(){
		return ['datetime', 'action'];
	}
	
	public static function create($action){
		$stat = new StatTime();
		$stat->action = $action;
		$stat->start_time = microtime(true);
		return $stat;
	}
	
	public function saveTime(){
		$attr = [
			'datetime' => gmdate(DATE_MYSQL, round_time(time(), self::TIME_INTERVAL, PHP_ROUND_DOWN)),
//			'datetime' => gmdate(DATE_MYSQL, time()),
			'action' => $this->action,
		];
		if(!StatTime::model()->findByAttributes($attr)){
			$stat = new StatTime();
			$stat->setAttributes($attr, false);
			$stat->save();
		}
		
		$time = (int)((microtime(true) - $this->start_time) * 1000);
		StatTime::model()->updateByPk($attr, [
			'count' => new CDbExpression('count + 1'),
			'time_min' => new CDbExpression("least(time_min, $time)"),
			'time_max' => new CDbExpression("greatest(time_max, $time)"),
			'time_last' => $time,
			'time_total' => new CDbExpression("time_total + $time"),
		]);
	}
	
	public static function statDayList(){
		return StatTime::model()->findAll([
			'select' => [
				'date(datetime) as datetime',
				'action',
				'sum(count) as count',
				'min(time_min) as time_min',
				'max(time_max) as time_max',
				'sum(time_total) as time_total',
				'time_last as time_last',
			],
			'condition' => implode(' and ', [
				'datetime > date_sub(utc_timestamp(), interval 1 day)',
			]),
			'group' => 'action',
		]);
	}
	
	
}