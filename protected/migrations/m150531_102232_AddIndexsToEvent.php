<?php

/**
 * [affected]
 * @see Event
 */
class m150531_102232_AddIndexsToEvent extends CDbMigration{

	public function up(){
		// int_id
		$this->createIndex('int_id', 'event', 'int_id');
		$this->createIndex('int_src', 'event', 'int_id, src_type');
		
		// event_id
		$this->createIndex('event_id', 'event', 'event_id');
		$this->createIndex('event_src', 'event', 'event_id, src_type');
		
		// src_type
		$this->createIndex('src_type', 'event', 'src_type');
		$this->createIndex('src_date', 'event', 'src_type, date');
		
		// date
		$this->createIndex('date', 'event', 'date');
		
		// date + teams
		$this->createIndex('date_teams', 'event', 'date, team_home, team_away');
		$this->createIndex('date_team_home', 'event', 'date, team_home');
		$this->createIndex('date_team_away', 'event', 'date, team_away');
	}

	public function down(){
		// int_id
		$this->dropIndex('int_id', 'event');
		$this->dropIndex('int_src', 'event');
		// event_id
		$this->dropIndex('event_id', 'event');
		$this->dropIndex('event_src', 'event');
		// src_type
		$this->dropIndex('src_type', 'event');
		$this->dropIndex('src_date', 'event');
		// date
		$this->dropIndex('date', 'event');
		// date + teams
		$this->dropIndex('date_teams', 'event');
		$this->dropIndex('date_team_home', 'event');
		$this->dropIndex('date_team_away', 'event');
	}

}
