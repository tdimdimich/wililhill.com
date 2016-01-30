<?php

/**
 * [affected]
 * @see Fork
 */
class m150607_172240_AddF3EventToFork extends CDbMigration{

	public function up(){
		$this->addColumn('fork', 'f3_event_id', 'bigint unsigned after f2_event_id');
	}

	public function down(){
		$this->dropColumn('fork', 'f3_event_id');
	}

}
