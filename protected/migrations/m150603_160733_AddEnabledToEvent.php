<?php

/**
 * [affected]
 * @see Event
 */
class m150603_160733_AddEnabledToEvent extends CDbMigration{

	public function up(){
		$this->addColumn('event', 'enabled', 'boolean not null default false after date');
	}

	public function down(){
		$this->dropColumn('event', 'enabled');
	}
}
