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
 * @see m150830_095916_CreateStatRequest
 * @see m151020_024124_AddTypeToStatRequest
 * @see m151207_083555_RemoveConsoleFromStatRequest
 * 
 */
class StatRequest extends CActiveRecord{
	
	const TYPE_WEB = 1;
	const TYPE_CONSOLE = 2;
	
	public function tableName(){
		return 'stat_request';
	}

	/** @return StatRequest */
	public static function model($className = __CLASS__){
		return parent::model($className);
	}
	
	public function primaryKey(){
		return ['datetime', 'action'];
	}
	
	public static function statDayTotal(){
		return StatRequest::model()->find([
			'select' => [
				'date(datetime) as datetime',
				'"*" as action',
				'sum(count) as count',
				'min(time_min) as time_min',
				'max(time_max) as time_max',
				'sum(time_total) as time_total',
			],
			'condition' => 'datetime > date_sub(utc_timestamp(), interval 1 day)',
		]);
	}
	
	public static function statDayList(){
		return StatRequest::model()->findAll([
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
	
	public function getCssClass(){
		$avg = $this->count!=0 ? (int)($this->time_total / $this->count) : 0;
		return $avg < 500 ? '' : ($avg < 1000 ? 'warning' : 'danger');
	}
	
}