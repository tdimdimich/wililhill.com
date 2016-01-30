<?php

class m151112_083747_DropNotUsedTables extends CDbMigration{

	public function up(){
		$this->dropTable('team');
	}

	public function down(){
	}

}
