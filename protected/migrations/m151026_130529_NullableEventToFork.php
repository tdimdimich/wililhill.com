<?php

/**
 * [affected]
 * @see Fork
 */
class m151026_130529_NullableEventToFork extends CDbMigration{

	public function up(){
		$this->alterColumn('fork', 'f1_event_id', 'bigint unsigned');
		$this->alterColumn('fork', 'f2_event_id', 'bigint unsigned');
	}

	public function down(){
		$this->alterColumn('fork', 'f1_event_id', 'bigint unsigned not null');
		$this->alterColumn('fork', 'f2_event_id', 'bigint unsigned not null');
	}

}
