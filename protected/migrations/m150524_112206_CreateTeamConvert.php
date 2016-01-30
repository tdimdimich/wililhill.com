<?php

/**
 * [affected]
 * @see TeamConvert
 */
class m150524_112206_CreateTeamConvert extends CDbMigration{

	public function up(){
		$this->createTable('team_convert', [
			'orig' => 'varchar(255) not null',
			'name' => 'varchar(255)',
			'type' => 'tinyint unsigned not null default 0',
			'primary key(orig)',
		]);
		$this->createIndex('name', 'team_convert', 'name');
	}

	public function down(){
		$this->dropTable('team_convert');
	}

}
