<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


class ClientScript extends CClientScript{
	
	public function registerCssFile($url, $media = ''){
		$url .= '?v='.Yii::app()->params['version'];
		parent::registerCssFile($url, $media);
		return $this;
	}
	
	public function registerScriptFile($url, $position = null, array $htmlOptions = array()){
		$url .= '?v='.Yii::app()->params['version'];
		parent::registerScriptFile($url, $position, $htmlOptions);
		return $this;
	}
	
	
}
