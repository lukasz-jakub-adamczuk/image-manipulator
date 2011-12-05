<?php

error_reporting(E_ALL);
ini_set('show_errors', 1);

define('APP_DIR', dirname(__FILE__));

require_once APP_DIR.'/ImageManipulator.php';

$oImageManipulator = new ImageManipulator();

$oImageManipulator->loadImage(APP_DIR.'/wall-1.jpg');

$oImageManipulator->resize(500, 500);



$oImageManipulator->show();
