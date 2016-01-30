<?php

/**
 * [affected]
 * @see Event
 * @see Fork
 */
class m151026_130347_AddUpdatedToEventAndFork extends CDbMigration{

	public function up(){
		$this->addColumn('event', 'updated', 'timestamp not null default now() after enabled');
		$this->update('event', ['updated' => new CDbExpression('utc_timestamp()')]);
		
		$this->addColumn('fork', 'updated', 'timestamp not null default now() after type');
		$this->update('fork', ['updated' => new CDbExpression('utc_timestamp()')]);
	}

	public function down(){
		$this->dropColumn('event', 'updated');
		$this->dropColumn('fork', 'updated');
	}

}
