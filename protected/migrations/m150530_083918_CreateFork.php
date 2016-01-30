<?php

/**
 * [affected]
 * @see Fork
 */
class m150530_083918_CreateFork extends CDbMigration{

	public function up(){
		$this->createTable('fork', [
			'id' => 'serial',
			'event_id' => 'bigint unsigned not null',
			'type' => 'tinyint unsigned not null',
			'rate' => 'decimal(8,4) default null',
			'primary key(id)',
		], 'engine=memory');
	}

	public function down(){
		$this->dropTable('fork');
	}

}
