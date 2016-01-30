<?php


/**
 * [affected]
 * @see EtopazEvent
 */
class m150511_211812_AddTeamToEtopazEvent extends CDbMigration{

	public function up(){
		$this->addColumn('etz_event', 'team_home_id', 'bigint unsigned default null after code');
		$this->addColumn('etz_event', 'team_away_id', 'bigint unsigned default null after team_home');
	}

	public function down(){
		$this->dropColumn('etz_event', 'team_home_id');
		$this->dropColumn('etz_event', 'team_away_id');
	}
	
}
