<?php

/**
 * [affected]
 * @see Event
 */
class m150524_120627_AddEventIdToEvent extends CDbMigration{

	public function up(){
		$this->addColumn('event', 'event_id', 'bigint unsigned default null after id');
	}

	public function down(){
		$this->dropColumn('event', 'event_id');
	}

}
