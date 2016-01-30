<?php

/**
 * [affected]
 * @see Event
 */
class m151112_092351_AddNewBetsToEvent extends CDbMigration{

	public function up(){
		$SUFF_BET_TYPE = 'decimal(8,4) default null after ';
		
		$this->addColumn('event', 'bet_m_1tu05', $SUFF_BET_TYPE.'bet_m_to35');
		$this->addColumn('event', 'bet_m_1to05', $SUFF_BET_TYPE.'bet_m_1tu05');
		$this->addColumn('event', 'bet_m_1tu15', $SUFF_BET_TYPE.'bet_m_1to05');
		$this->addColumn('event', 'bet_m_1to15', $SUFF_BET_TYPE.'bet_m_1tu15');
		$this->addColumn('event', 'bet_m_1tu25', $SUFF_BET_TYPE.'bet_m_1to15');
		$this->addColumn('event', 'bet_m_1to25', $SUFF_BET_TYPE.'bet_m_1tu25');
		$this->addColumn('event', 'bet_m_2tu05', $SUFF_BET_TYPE.'bet_m_1to25');
		$this->addColumn('event', 'bet_m_2to05', $SUFF_BET_TYPE.'bet_m_2tu05');
		$this->addColumn('event', 'bet_m_2tu15', $SUFF_BET_TYPE.'bet_m_2to05');
		$this->addColumn('event', 'bet_m_2to15', $SUFF_BET_TYPE.'bet_m_2tu15');
		$this->addColumn('event', 'bet_m_2tu25', $SUFF_BET_TYPE.'bet_m_2to15');
		$this->addColumn('event', 'bet_m_2to25', $SUFF_BET_TYPE.'bet_m_2tu25');

		$this->addColumn('event', 'bet_p1_tu05', $SUFF_BET_TYPE.'bet_p1_2');
		$this->addColumn('event', 'bet_p1_to05', $SUFF_BET_TYPE.'bet_p1_tu05');
		$this->addColumn('event', 'bet_p1_gh', $SUFF_BET_TYPE.'bet_p1_to35');
		$this->addColumn('event', 'bet_p1_gn', $SUFF_BET_TYPE.'bet_p1_gh');
		
		$this->addColumn('event', 'bet_p2_tu05', $SUFF_BET_TYPE.'bet_p2_2');
		$this->addColumn('event', 'bet_p2_to05', $SUFF_BET_TYPE.'bet_p2_tu05');
		$this->addColumn('event', 'bet_p2_gh', $SUFF_BET_TYPE.'bet_p2_to35');
		$this->addColumn('event', 'bet_p2_gn', $SUFF_BET_TYPE.'bet_p2_gh');
		
	}

	public function down(){
		$this->dropColumn('event', 'bet_m_1tu05');
		$this->dropColumn('event', 'bet_m_1to05');
		$this->dropColumn('event', 'bet_m_1tu15');
		$this->dropColumn('event', 'bet_m_1to15');
		$this->dropColumn('event', 'bet_m_1tu25');
		$this->dropColumn('event', 'bet_m_1to25');
		$this->dropColumn('event', 'bet_m_2tu05');
		$this->dropColumn('event', 'bet_m_2to05');
		$this->dropColumn('event', 'bet_m_2tu15');
		$this->dropColumn('event', 'bet_m_2to15');
		$this->dropColumn('event', 'bet_m_2tu25');
		$this->dropColumn('event', 'bet_m_2to25');
		
		$this->dropColumn('event', 'bet_p1_tu05');
		$this->dropColumn('event', 'bet_p1_to05');
		$this->dropColumn('event', 'bet_p1_gh');
		$this->dropColumn('event', 'bet_p1_gn');
		
		$this->dropColumn('event', 'bet_p2_tu05');
		$this->dropColumn('event', 'bet_p2_to05');
		$this->dropColumn('event', 'bet_p2_gh');
		$this->dropColumn('event', 'bet_p2_gn');
		
	}

}
