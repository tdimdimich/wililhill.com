<?php


/**
 * [affected]
 * @see Event
 */
class m150827_090445_AddIntCodeToEvent extends CDbMigration{

	public function up(){
		$this->addColumn('event', 'int_code', 'varchar(128) after int_id');
	}

	public function down(){
		$this->dropColumn('event', 'int_code');
	}

}
