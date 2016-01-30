<?php


/**
 * 
 * [affected]
 * @see Event
 * @see Fork
 * 
 */
class m150714_144404_AddVisibleToEventAndFork extends CDbMigration{

	public function up(){
		$this->addColumn('event', 'visible', 'boolean not null default true');
		$this->addColumn('fork', 'visible', 'boolean not null default true');
	}

	public function down(){
		$this->dropColumn('event', 'visible');
		$this->dropColumn('fork', 'visible');
	}

}
