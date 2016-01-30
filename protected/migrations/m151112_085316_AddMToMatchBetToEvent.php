<?php

/**
 * [affected]
 * @see Event
 */
class m151112_085316_AddMToMatchBetToEvent extends CDbMigration{

	public function up(){
		$this->renameColumn('event', 'bet_1', 'bet_m_1');
		$this->renameColumn('event', 'bet_x', 'bet_m_x');
		$this->renameColumn('event', 'bet_2', 'bet_m_2');
		$this->renameColumn('event', 'bet_1x', 'bet_m_1x');
		$this->renameColumn('event', 'bet_12', 'bet_m_12');
		$this->renameColumn('event', 'bet_x2', 'bet_m_x2');
		$this->renameColumn('event', 'bet_tu15', 'bet_m_tu15');
		$this->renameColumn('event', 'bet_to15', 'bet_m_to15');
		$this->renameColumn('event', 'bet_tu25', 'bet_m_tu25');
		$this->renameColumn('event', 'bet_to25', 'bet_m_to25');
		$this->renameColumn('event', 'bet_tu35', 'bet_m_tu35');
		$this->renameColumn('event', 'bet_to35', 'bet_m_to35');
		$this->renameColumn('event', 'bet_gh', 'bet_m_gh');
		$this->renameColumn('event', 'bet_gn', 'bet_m_gn');
	}

	public function down(){
		$this->renameColumn('event', 'bet_m_1', 'bet_1');
		$this->renameColumn('event', 'bet_m_x', 'bet_x');
		$this->renameColumn('event', 'bet_m_2', 'bet_2');
		$this->renameColumn('event', 'bet_m_1x', 'bet_1x');
		$this->renameColumn('event', 'bet_m_12', 'bet_12');
		$this->renameColumn('event', 'bet_m_x2', 'bet_x2');
		$this->renameColumn('event', 'bet_m_tu15', 'bet_tu15');
		$this->renameColumn('event', 'bet_m_to15', 'bet_to15');
		$this->renameColumn('event', 'bet_m_tu25', 'bet_tu25');
		$this->renameColumn('event', 'bet_m_to25', 'bet_to25');
		$this->renameColumn('event', 'bet_m_tu35', 'bet_tu35');
		$this->renameColumn('event', 'bet_m_to35', 'bet_to35');
		$this->renameColumn('event', 'bet_m_gh', 'bet_gh');
		$this->renameColumn('event', 'bet_m_gn', 'bet_gn');
	}

}
