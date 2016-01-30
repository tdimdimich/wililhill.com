<?php


/**
 * [affected]
 * @see User
 * 
 */
class m150508_153454_CreateUser extends CDbMigration{

	public function up(){
		$this->createTable('user', [
			'id' => 'serial',
			'username' => 'varchar(64) not null',
			'password' => 'varchar(64) not null',
			'is_admin' => 'boolean not null default false',
			'primary key(id)',
		]);
		
		$this->insert('user', [
			'username' => 'admin',
			'password' => CPasswordHelper::hashPassword('1'),
			'is_admin' => true,
		]);
	}

	public function down(){
		$this->dropTable('user');
	}
	
}
