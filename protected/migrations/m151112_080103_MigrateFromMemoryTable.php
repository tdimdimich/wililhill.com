<?php

/**
 * [affected]
 * @see Event
 */
class m151112_080103_MigrateFromMemoryTable extends CDbMigration{

	public function up(){
		$this->getDbConnection()->createCommand('alter table event engine=InnoDB')->execute();
		$this->getDbConnection()->createCommand('alter table fork engine=InnoDB')->execute();
	}

	public function down(){
		$this->getDbConnection()->createCommand('alter table event engine=Memory')->execute();
		$this->getDbConnection()->createCommand('alter table fork engine=Memory')->execute();
	}

}
