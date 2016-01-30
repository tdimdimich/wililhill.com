<?php

/**
 * 
 * [affected]
 * @see Event
 * 
 */
class m150518_212724_CreateEvent extends CDbMigration{

	public function up(){
		$this->createTable('event', [
			'id' => 'serial',
			'src_type' => 'tinyint unsigned not null default 0',
			'int_id' => 'varchar(32) not null',
			'team_home' => 'varchar(255) not null',
			'team_away' => 'varchar(255) not null',
			'date' => 'datetime not null',
			'bet_1' => 'decimal(8,4) default null',
			'bet_x' => 'decimal(8,4) default null',
			'bet_2' => 'decimal(8,4) default null',
			'bet_1x' => 'decimal(8,4) default null',
			'bet_12' => 'decimal(8,4) default null',
			'bet_x2' => 'decimal(8,4) default null',
			'bet_tu15' => 'decimal(8,4) default null',
			'bet_to15' => 'decimal(8,4) default null',
			'bet_tu25' => 'decimal(8,4) default null',
			'bet_to25' => 'decimal(8,4) default null',
			'bet_tu35' => 'decimal(8,4) default null',
			'bet_to35' => 'decimal(8,4) default null',
			'bet_gh' => 'decimal(8,4) default null',
			'bet_gn' => 'decimal(8,4) default null',
			'primary key(id)',
		], 'engine=memory');
	}

	public function down(){
		$this->dropTable('event');
	}
	
}
