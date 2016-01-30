<?php


/**
 * [affected]
 * @see StatRequest
 */
class m150830_095916_CreateStatRequest extends CDbMigration{

	public function up(){
		$this->createTable('stat_request', [
			'datetime' => 'datetime not null',
			'action' => 'varchar(512) not null',
			'count' => 'int unsigned not null default 0',
			'time_min' => 'bigint unsigned not null default 4294967295',
			'time_max' => 'bigint unsigned not null default 0',
			'time_total' => 'bigint unsigned not null default 0',
			'mem_min' => 'bigint unsigned not null default 4294967295',
			'mem_max' => 'bigint unsigned not null default 0',
			'mem_total' => 'bigint unsigned not null default 0',
			'primary key(datetime, action)',
		], 'engine=memory');
	}

	public function down(){
		$this->dropTable('stat_request');
	}

}
