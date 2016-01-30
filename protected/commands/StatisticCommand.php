<?php

class StatisticCommand extends CConsoleCommand {
	
	public function actionIndex(){
	}
	
	public function actionDeleteOld(){
		StatRequest::model()->deleteAll('datetime < date_sub(date_sub(utc_timestamp(), interval 1 day), interval 2 hour)');
	}
	
}

