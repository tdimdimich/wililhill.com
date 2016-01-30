<?php

require_once 'functions.php';

// очистка старых событий
exec('php '.DIR_ROOT.'yiic event deleteold');
// очистка старой статистики
exec('php '.DIR_ROOT.'yiic statistic deleteold');





