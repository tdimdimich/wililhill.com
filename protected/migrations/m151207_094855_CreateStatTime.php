<?php


/**
 * [affected]
 * @see StatTime
 */
class m151207_094855_CreateStatTime extends CDbMigration{

	public function up(){
		$this->createTable('stat_time', [
			'datetime' => 'datetime not null',
			'action' => 'varchar(512) not null',
			'count' => 'int unsigned not null default 0',
			'time_min' => 'bigint unsigned not null default 4294967295',
			'time_max' => 'bigint unsigned not null default 0',
			'time_last' => 'bigint unsigned not null default 0',
			'time_total' => 'bigint unsigned not null default 0',
			'primary key(datetime, action)',
		], 'engine=memory');
	}

	public function down(){
		$this->dropTable('stat_time');
	}
	
}
