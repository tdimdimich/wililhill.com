<?php

/**
 * [affected]
 * @see Fork
 */
class m150531_145521_AddWinToFork extends CDbMigration{

	public function up(){
		$this->addColumn('fork', 'win', 'decimal(12,2) default null');
		$this->createIndex('win', 'fork', 'win');
	}

	public function down(){
		$this->dropColumn('fork', 'win');
	}
	
}
