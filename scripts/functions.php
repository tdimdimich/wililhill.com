<?php

mb_internal_encoding('utf8');
libxml_use_internal_errors(true);

// dir
define('DIR_ROOT', dirname(dirname(__FILE__)).'/');
define('DIR_FW', DIR_ROOT.'framework/');
define('DIR_APP', DIR_ROOT.'protected/');
define('DIR_WEB', DIR_ROOT.'public/');
define('DIR_SCRIPTS', DIR_ROOT.'scripts/');

define('YIIC', 'php '.DIR_ROOT.'yiic');

// const
define('DATE_MYSQL', 'Y-m-d H:i:s');

// yii
defined('YII_DEBUG') or define('YII_DEBUG',false);
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',0);

function dump($var, $depth = 10, $highlight = true){
	if(class_exists('CVarDumper')) CVarDumper::dump($var, $depth, $highlight);
	else var_dump($var);
}


function xpath_get_value($xpath, $query, $node = null){
	$qnode = $xpath->query($query, $node)->item(0);
	return $qnode ? $qnode->nodeValue : null;
}

function xpath_get_attr($xpath, $query, $attr, $node = null){
	$qnode = $xpath->query($query, $node)->item(0);
	return $qnode ? $qnode->getAttribute($attr) : null;
}

define('PHP_ROUND_DOWN', 10);
function round_time($ts, $step, $mode = PHP_ROUND_HALF_UP){
	switch($mode){
		case PHP_ROUND_DOWN: return (int)($ts / $step) * $step;
		default : return $step * round($ts / $step, 0, $mode);
	}
}


function date_add_hour($date, $hour){
	if($hour == 0) return $date;
	$date = new DateTime($date);
	if($hour > 0){
		$date->add(new DateInterval("PT{$hour}H"));
	}else{
		$hour = abs($hour);
		$date->sub(new DateInterval("PT{$hour}H"));
	}
	return $date->format(DATE_MYSQL);
}


function format_microtime($time){
	if($time < 800)
		return sprintf('%d ms', $time);
	if(($time /= 1000) < 60)
		return sprintf('%.2f s', $time);
	return sprintf('%.2f m', $time / 60);
}

function format_bytes($val){
	if($val < 800)
		return sprintf('%dB', $val);
	if(($val /= 1024) < 800)
		return sprintf('%.2fKB', $val);
	if(($val /= 1024) < 800)
		return sprintf('%.2fMB', $val);
	return sprintf('%.2fGB', $val / 1024);
}


/**
 * Indents a flat JSON string to make it more human-readable.
 * @param string $json The original JSON string to process.
 * @return string Indented version of the original JSON string.
 */
function json_human($json){
	$INDENT = "\t";
	$NEWLINE = "\n";
	$result = '';
	$pos = 0;
	$prevChar = '';
	$outOfQuotes = true;

	for($i = 0; $i <= strlen($json); $i++){
		$char = substr($json, $i, 1);
		if($char == '"' && $prevChar != '\\'){
			$outOfQuotes = !$outOfQuotes;
		}else if(($char == '}' || $char == ']') && $outOfQuotes){
			$result .= $NEWLINE;
			$pos --;
			for($j = 0; $j < $pos; $j++){
				$result .= $INDENT;
			}
		}
		$result .= $char;
		
		if(($char == ',' || $char == '{' || $char == '[') && $outOfQuotes){
			$result .= $NEWLINE;
			if($char == '{' || $char == '['){
				$pos ++;
			}

			for($j = 0; $j < $pos; $j++){
				$result .= $INDENT;
			}
		}
		$prevChar = $char;
	}

	return $result;
}

function array_and($arr){
	return implode(' and ', array_filter($arr));
}

function array_or($arr){
	$r = implode(' or ', array_filter($arr));
	return $r ? "($r)" : '';
}

function multicurl($curls, $callback, $max_threds = 4){
	$multi = curl_multi_init();
	$i = $active = 0;
	do{
		// запуск
		while(curl_multi_exec($multi, $active) == CURLM_CALL_MULTI_PERFORM);
		if(curl_multi_select($multi) == -1){
			usleep(10);
		}
		// результаты
		while($info = curl_multi_info_read($multi)){
			$ch = $info['handle'];
			call_user_func($callback, curl_multi_getcontent($ch));
			curl_multi_remove_handle($multi, $ch);
			curl_close($ch);
		}
		// добавление
		while($active < $max_threds && $i < count($curls)){
			curl_multi_add_handle($multi, $curls[$i++]);
			while(curl_multi_exec($multi, $active) == CURLM_CALL_MULTI_PERFORM);
		}
	}while($active);
	curl_multi_close($multi);
}


