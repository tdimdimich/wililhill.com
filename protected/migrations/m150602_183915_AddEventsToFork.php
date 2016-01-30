<?php

/**
 * [affected]
 * @see Fork
 */
class m150602_183915_AddEventsToFork extends CDbMigration{

	public function up(){
		$this->addColumn('fork', 'f1_event_id', 'bigint unsigned not null after type');
		$this->addColumn('fork', 'f2_event_id', 'bigint unsigned not null after f1_event_id');
	}

	public function down(){
		$this->dropColumn('fork', 'f1_event_id');
		$this->dropColumn('fork', 'f2_event_id');
	}
	
}
