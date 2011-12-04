<?php

error_reporting(E_ALL);
ini_set('show_errors', 1);

define('APP_DIR', dirname(__FILE__));

//require_once APP_DIR.'/ImageManipulator.php';

//$oImageManipulator = new ImageManipulator();

//header('Content-Type: image/jpeg');

//echo 'after construct';

//$oImageManipulator->loadImage(APP_DIR.'/wall-1.jpg');
//
//$oImageManipulator->resize(320, 240);

//print_r($oImageManipulator);

//touch (APP_DIR.'/test');


//echo $oImageManipulator->show();

$rImage = imagecreatefromjpeg(APP_DIR.'/wall-1.jpg');

		$iWidth = imagesx($rImage);
		$iHeight = imagesy($rImage);
		
		$iDstWidth = 222;
		$iDstHeight = 111;

		$rDstImage = imagecreatetruecolor($iDstWidth, $iDstHeight);
		$rBackground = imagecolorallocate($rDstImage, 200, 55, 15);
		
		imagefill($rDstImage, 0, 0, $rBackground);
		imagecopyresampled($rDstImage, $rImage, 0, 0, 0, 0, $iDstWidth, $iDstHeight, $iWidth, $iHeight);
		
//		$this->_saveToFile($rImage, dirname(__FILE__).'/result.jpg');
//		$this->_saveToFile('result.jpg', $rImage);
//		$this->_sName = dirname(__FILE__).'/image.jpg';

		$sNewimage = dirname(__FILE__).'/image.jpg';
		
		imagejpeg($rDstImage, $sNewimage);
		
		echo '<img src="image.jpg" />';