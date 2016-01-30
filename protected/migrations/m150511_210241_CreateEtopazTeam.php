<?php

/**
 * [affected]
 * @see EtopazTeam
 */
class m150511_210241_CreateEtopazTeam extends CDbMigration{

	public function up(){
		$this->createTable('etz_team', [
			'id' => 'serial',
			'team_id' => 'bigint unsigned default null',
			'name' => 'varchar(255) not null',
			'primary key(id)',
		]);
		$this->createIndex('team', 'etz_team', 'team_id');
		$this->createIndex('name', 'etz_team', 'name', true);
	}

	public function down(){
		$this->dropTable('etz_team');
	}

}
