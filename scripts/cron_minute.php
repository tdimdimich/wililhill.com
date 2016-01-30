<?php

require_once 'functions.php';

$TH_MINUTE = date('i');
$GRABBER_LIST = [
	// action => grab per minute
	'eventetz grab'			=> 2,
	'eventetz grablive'		=> 4,
	'eventpns grab'			=> 4,
	'eventwlh grab'			=> 4,
];

while(date('i') == $TH_MINUTE){usleep(500 * 1000);}
$TH_MINUTE = date('i');

mthreads($GRABBER_LIST);


// Вызов каждого грабера в отдельном потоке 
function mthreads($list){
	foreach($list as $action => $gpm){
		$pid = pcntl_fork();
		if($pid == 0){
			grab_process($action, $gpm);
			exit();
		}
	}
	while(pcntl_waitpid(0, $status) != -1){}
}

// Выполнение грабера несколько раз в минуту
function grab_process($action, $gpm){
	global $TH_MINUTE;
	$step = (int)(60 / $gpm);
	for($sec = 0; $sec < 60; $sec+=$step){
		// Выходим если минута кончилась
		if(date('i') != $TH_MINUTE) break; 
		// Пропускаем такт если задерка предыдущего
		if(date('s') > $sec) continue;
		// Ждем назначенного времени
		while(date('s') < $sec){
			usleep(500 * 1000);
		}
		// Выполение
		exec(YIIC." $action");
//		echo("process:\t".$action."\t".date(DATE_MYSQL)."\n");
//		sleep(rand(1, 30));
//		echo("end:\t\t".$action."\t".date(DATE_MYSQL)."\n");
	}
}

