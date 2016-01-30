<?php

class m150523_111645_DropEtzTables extends CDbMigration{

	public function up(){
		$this->dropTable('etz_event');
		$this->dropTable('etz_team');
	}

	public function down(){
		return false;
	}

}
