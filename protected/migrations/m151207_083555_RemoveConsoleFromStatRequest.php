<?php

/**
 * 
 * [affected]
 * @see StatRequest
 */
class m151207_083555_RemoveConsoleFromStatRequest extends CDbMigration{

	public function up(){
		$this->truncateTable('stat_request');
		$this->dropPrimaryKey('', 'stat_request');
		
		$this->dropColumn('stat_request', 'type');
		$this->addColumn('stat_request', 'time_last', 'bigint unsigned not null default 0 after time_max');
		
		$this->addPrimaryKey('', 'stat_request', 'datetime, action');
	}

	public function down(){
		$this->truncateTable('stat_request');
		$this->dropPrimaryKey('', 'stat_request');
		
		$this->addColumn('stat_request', 'type', 'tinyint unsigned not null default 0 after action');
		$this->dropColumn('stat_request', 'time_last');
		
		$this->addPrimaryKey('', 'stat_request', 'datetime, action, type');
	}

}
