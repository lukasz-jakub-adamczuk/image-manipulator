<?php

$start = microtime(true);

error_reporting(E_ALL);
ini_set('show_errors', 1);

define('APP_DIR', dirname(__FILE__));


$sDir = APP_DIR.'/../goToNepal/media/photos/';


$sImg = 'WP_20130924_007.jpg';

$sFile = dirname(__DIR__) . '/goToNepal/media/photos/' . $sImg;

// echo $sFile;

$iWidth = 320;
$iHeight = 240;

$sNewFile = APP_DIR.'/tmp/img-'.$iWidth.'-'.$iHeight.'.jpg';

// echo $sNewFile;

if (file_exists($sNewFile)) {
	echo 'file exists';
} else {
	echo 'file does not exists';
	// require_once APP_DIR.'/ImageManipulator.php';

	// $oImageManipulator = new ImageManipulator();

	// $oImageManipulator->loadImage($sFile);

	// $oImageManipulator->resize($iWidth, $iHeight);

	// $oImageManipulator->resize(320, 200, false, 'center', 'top');
	//$oImageManipulator->resize(320, 200, false, 'center', 'top');
	// $oImageManipulator->resize(200, 500, true, '10%', 'top');
	// $oImageManipulator->resize($iWidth, $iHeight, $bMargins, $sHorCrop, $sVerCrop);

	// $oImageManipulator->resize(600, 960);
	// $oImageManipulator->resize(960, 600);
	// $oImageManipulator->resize(120, 90);
	// $oImageManipulator->show();


	// $sNewFile = APP_DIR.'/tmp/result.jpg';

	// $oImageManipulator->save($sNewFile);
}

echo '<img src="tmp/img-'.$iWidth.'-'.$iHeight.'.jpg" />';
echo '<br>';

// echo '<img src="tmp/result.jpg" />';

$total = microtime(true) - $start;
echo (int)($total * 1000).'ms';