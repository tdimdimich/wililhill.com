<?php

/**
 * [affected]
 * @see Event
 */
class m150714_173854_AddTeamsReversedToEvent extends CDbMigration{

	public function up(){
		$this->addColumn('event', 'teams_reversed', 'boolean not null default false after team_away');
	}

	public function down(){
		$this->dropColumn('event', 'teams_reversed');
	}

}
