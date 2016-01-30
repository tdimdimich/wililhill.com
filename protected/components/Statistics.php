<?php



class Statistics{
	
	const TIME_INTERVAL = 3600; // 60 * 60;
	
	function beforeRequest(){
	}
	
	function afterRequest(){
		$attr = [
			'datetime' => gmdate(DATE_MYSQL, round_time(time(), self::TIME_INTERVAL, PHP_ROUND_DOWN)),
			'action' => Yii::app()->request->requestUri,
		];
		if(!StatRequest::model()->findByAttributes($attr)){
			$stat = new StatRequest();
			$stat->setAttributes($attr, false);
			$stat->save();
		}
		
		$time = (int)(Yii::getLogger()->getExecutionTime()*1000);
		StatRequest::model()->updateByPk($attr, [
			'count' => new CDbExpression('count + 1'),
			'time_min' => new CDbExpression("least(time_min, $time)"),
			'time_max' => new CDbExpression("greatest(time_max, $time)"),
			'time_last' => $time,
			'time_total' => new CDbExpression("time_total + $time"),
		]);
	}
	
	

	
}