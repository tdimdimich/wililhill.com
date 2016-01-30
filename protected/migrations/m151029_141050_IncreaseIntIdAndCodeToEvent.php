<?php

/**
 * [affected]
 * @see Event
 */
class m151029_141050_IncreaseIntIdAndCodeToEvent extends CDbMigration{

	public function up(){
		$this->alterColumn('event', 'int_id', 'varchar(255) not null');
		$this->alterColumn('event', 'int_code', 'varchar(255) not null');
	}

	public function down(){
		$this->alterColumn('event', 'int_id', 'varchar(32) not null');
		$this->alterColumn('event', 'int_code', 'varchar(128) not null');
	}

}
