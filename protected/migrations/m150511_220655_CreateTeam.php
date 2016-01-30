<?php

/**
 * [affected]
 * @see Team
 */
class m150511_220655_CreateTeam extends CDbMigration{

	public function up(){
		$this->createTable('team', [
			'id' => 'serial',
			'team_id' => 'bigint unsigned default null',
			'name' => 'varchar(255) not null',
			'primary key(id)',
		]);
		$this->createIndex('team', 'team', 'team_id');
		$this->createIndex('name', 'team', 'name', true);
	}

	public function down(){
		$this->dropTable('team');
	}

}
