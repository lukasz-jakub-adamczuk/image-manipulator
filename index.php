<?php

$start = microtime(true);

error_reporting(E_ALL);
ini_set('show_errors', 1);

define('APP_DIR', dirname(__FILE__));

// require_once APP_DIR.'/ImageManipulator.php';
require_once APP_DIR.'/image.php';

$sDir = APP_DIR.'/../goToNepal/media/photos/people/';

//$sImageName = 'WP_20130926_021.jpg';
$sImageName = 'katarzyna-merchata.jpg';

$sFile = $sDir . $sImageName;

$aParams = array();
$aParams['path'] = $sFile;
// $aParams['width'] = 320;
// $aParams['height'] = 240;

$aParams['width'] = 120;
$aParams['height'] = 120;
$aParams['margins'] = isset($_GET['margins']) ? strip_tags($_GET['margins']) : true;

echo '<img src="'.getImageUrl($sImageName, $aParams).'" />';

$total = microtime(true) - $start;
echo 'index.php: '.(int)($total * 1000).'ms';