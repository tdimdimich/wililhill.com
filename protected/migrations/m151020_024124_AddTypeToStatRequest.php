<?php


/**
 * [affected]
 * @see StatRequest
 */
class m151020_024124_AddTypeToStatRequest extends CDbMigration{

	public function up(){
		$this->truncateTable('stat_request');
		$this->addColumn('stat_request', 'type', 'tinyint unsigned not null default 0 after action');
		$this->dropPrimaryKey('', 'stat_request');
		$this->addPrimaryKey('', 'stat_request', 'datetime, action, type');
	}

	public function down(){
		$this->truncateTable('stat_request');
		$this->dropColumn('stat_request', 'type');
		$this->dropPrimaryKey('', 'stat_request');
		$this->addPrimaryKey('', 'stat_request', 'datetime, action');
	}

}
