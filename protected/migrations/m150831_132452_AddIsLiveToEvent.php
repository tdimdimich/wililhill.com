<?php



/**
 * [affected]
 * @see Event
 */
class m150831_132452_AddIsLiveToEvent extends CDbMigration{

	public function up(){
		$this->addColumn('event', 'islive', 'boolean not null default false after enabled');
	}

	public function down(){
		$this->dropColumn('event', 'islive');
	}

}
