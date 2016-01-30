<?php

/**
 * [affected]
 * @see Fork
 */
class m150531_102815_AddIndexsToFork extends CDbMigration{

	public function up(){
		$this->createIndex('event_id', 'fork', 'event_id');
		$this->createIndex('event_type', 'fork', 'event_id, type');
		$this->createIndex('rate', 'fork', 'rate');
	}

	public function down(){
		$this->dropIndex('event_id', 'fork');
		$this->dropIndex('event_type', 'fork');
		$this->dropIndex('rate', 'fork');
	}

}
