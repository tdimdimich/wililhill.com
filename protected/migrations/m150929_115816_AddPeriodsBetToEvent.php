<?php


/**
 * [affected]
 * @see Event
 */
class m150929_115816_AddPeriodsBetToEvent extends CDbMigration{

	public function up(){
		// Перемещение колонок
		$this->alterColumn('event', 'visible', 'boolean not null default true after enabled');
		$this->alterColumn('event', 'etz_mbs', 'tinyint unsigned after islive');
		
		// p1 1 x 2
		$this->addColumn('event', 'bet_p1_1', 'decimal(8,4) default null');
		$this->addColumn('event', 'bet_p1_x', 'decimal(8,4) default null');
		$this->addColumn('event', 'bet_p1_2', 'decimal(8,4) default null');
		// p1 tu to 15 25 35
		$this->addColumn('event', 'bet_p1_tu15', 'decimal(8,4) default null');
		$this->addColumn('event', 'bet_p1_to15', 'decimal(8,4) default null');
		$this->addColumn('event', 'bet_p1_tu25', 'decimal(8,4) default null');
		$this->addColumn('event', 'bet_p1_to25', 'decimal(8,4) default null');
		$this->addColumn('event', 'bet_p1_tu35', 'decimal(8,4) default null');
		$this->addColumn('event', 'bet_p1_to35', 'decimal(8,4) default null');
		// p2 1 x 2
		$this->addColumn('event', 'bet_p2_1', 'decimal(8,4) default null');
		$this->addColumn('event', 'bet_p2_x', 'decimal(8,4) default null');
		$this->addColumn('event', 'bet_p2_2', 'decimal(8,4) default null');
		// p2 tu to 15 25 35
		$this->addColumn('event', 'bet_p2_tu15', 'decimal(8,4) default null');
		$this->addColumn('event', 'bet_p2_to15', 'decimal(8,4) default null');
		$this->addColumn('event', 'bet_p2_tu25', 'decimal(8,4) default null');
		$this->addColumn('event', 'bet_p2_to25', 'decimal(8,4) default null');
		$this->addColumn('event', 'bet_p2_tu35', 'decimal(8,4) default null');
		$this->addColumn('event', 'bet_p2_to35', 'decimal(8,4) default null');
	}

	public function down(){
		// p1 1 x 2
		$this->dropColumn('event', 'bet_p1_1');
		$this->dropColumn('event', 'bet_p1_x');
		$this->dropColumn('event', 'bet_p1_2');
		// p1 tu to 15 25 35
		$this->dropColumn('event', 'bet_p1_tu15');
		$this->dropColumn('event', 'bet_p1_to15');
		$this->dropColumn('event', 'bet_p1_tu25');
		$this->dropColumn('event', 'bet_p1_to25');
		$this->dropColumn('event', 'bet_p1_tu35');
		$this->dropColumn('event', 'bet_p1_to35');
		// p2 1 x 2
		$this->dropColumn('event', 'bet_p2_1');
		$this->dropColumn('event', 'bet_p2_x');
		$this->dropColumn('event', 'bet_p2_2');
		// p2 tu to 15 25 35
		$this->dropColumn('event', 'bet_p2_tu15');
		$this->dropColumn('event', 'bet_p2_to15');
		$this->dropColumn('event', 'bet_p2_tu25');
		$this->dropColumn('event', 'bet_p2_to25');
		$this->dropColumn('event', 'bet_p2_tu35');
		$this->dropColumn('event', 'bet_p2_to35');
	}

}
