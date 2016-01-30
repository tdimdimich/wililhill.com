<?php

/**
 * [affected]
 * @see Setting
 */
class m150514_155045_CreateSetting extends CDbMigration{

	public function up(){
		$this->createTable('setting', [
			'name' => 'varchar(255) not null',
			'value' => 'varchar(255) not null default ""',
			'primary key(name)',
		]);
	}

	public function down(){
		$this->dropTable('setting');
	}

}
