<?php

define('YII_DEBUG', true);

require_once '../scripts/functions.php';

require_once(DIR_FW.'yii.php');
Yii::createWebApplication(DIR_APP.'config/main.php')->run();