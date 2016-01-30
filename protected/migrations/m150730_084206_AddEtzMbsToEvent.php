<?php

/**
 * [affected]
 * @see Event
 */
class m150730_084206_AddEtzMbsToEvent extends CDbMigration{

	public function up(){
		$this->addColumn('event', 'etz_mbs', 'tinyint unsigned');
	}

	public function down(){
		$this->dropColumn('event', 'etz_mbs');
	}

}
