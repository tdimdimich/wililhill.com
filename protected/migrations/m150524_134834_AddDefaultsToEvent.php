<?php

/**
 * [affected]
 * @see Event
 */
class m150524_134834_AddDefaultsToEvent extends CDbMigration{

	public function up(){
		$this->alterColumn('event', 'int_id', 'varchar(32) not null default ""');
	}

	public function down(){
	}

}
