<?php

class Settings extends CApplicationComponent{
	
	public static $DEFAULTS = [
		'pns_client_id' => '',
		'pns_client_pass' => '',
		'pns_last_time' => '',
		'etz_time_interval' => 0,
		'etz_time_shift' => 0,
		'fork_win_min' => -80,
		'fork_limit' => 1000,
		'events_updated' => '',
	];
	
	public static $LABELS = [
		'pns_client_id' => 'PinnacleSports: Client ID',
		'pns_client_pass' => 'PinnacleSports: Client Password',
		'pns_last_time' => 'PinnacleSports: Последний запрос',
//		'etz_time_interval' => 'Etopaz: Разброс временой зоны',
//		'etz_time_shift' => 'Etopaz: Сдвиг временой зоны',
		'fork_win_min' => 'Вилки: Фильтр минимальный выйгрыш',
		'fork_limit' => 'Вилки: Фильтр лимит количества',
	];
	
	private $_map = null;
	
	private function initMap(){
		$map = self::$DEFAULTS;
		$list = Setting::model()->findAll();
		foreach($list as $setting)
			$map[$setting->name] = $setting->value;
		$this->_map = $map;		
	}
	
	public function get($name){
		if(!$this->_map) $this->initMap();
		return $this->_map[$name];
	}
	
	public function set($name, $value){
		$this->_map = null;
		$setting = Setting::model()->findByPk($name);
		if(!$setting){
			$setting = new Setting();
			$setting->name = $name;
		}
		$setting->value = $value;
		$setting->save();
	}
	
}