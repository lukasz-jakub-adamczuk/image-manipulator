<?php

error_reporting(E_ALL);
ini_set('show_errors', 1);




define('APP_DIR', dirname(__FILE__));

//require_once APP_DIR.'/../ola/funcs.php';

$sPath = isset($_GET['path']) ? $_GET['path'] : '';



$aContent = dir_content(APP_DIR.'/../ola/ola-prace/'.$sPath);

sort($aImages);

print_r($aImages);

echo '<ul>';
foreach ($aContent as $items => $item) {
	echo '<li><a href="http://localhost/~ash/image-manipulator/index.php?path='.$sPath.'/'.$item.'">'.$item.'</a></li>';
}
echo '</ul>';

//$sFile = APP_DIR.'/../ola/ola-prace/niewiem/konstrukcja.jpg';

echo '<form>';


    
    asort($aImages);
//    //ksort($aImages, SORT_STRING);
//    //sort($aImages);
//    //sort($aImages, SORT_NUMERIC);
//    //sort($aImages, SORT_STRING);
//    
//    foreach ($aImages as $imgs => $img) {
//    	ksort($img);
//        $aResult[][$imgs] = $img;
//    }
//
//    echo '<pre>';
//    //print_r($aImages);
//    print_r($aResult);
//    echo '</pre>';

$sFile = isset($_GET['path']) ? APP_DIR.'/../ola/ola-prace/'.$_GET['path'] : APP_DIR.'/wall-1.jpg';

require_once APP_DIR.'/ImageManipulator.php';

$oImageManipulator = new ImageManipulator();

$oImageManipulator->loadImage($sFile);

//$oImageManipulator->resize(320, 200, false, 'center', 'top');
$oImageManipulator->resize(320, 200, false);
//$oImageManipulator->resize(320, 200);

//$oImageManipulator->resize(600, 960);
//$oImageManipulator->resize(960, 600);
//$oImageManipulator->resize(600, 600);
$oImageManipulator->show();

$sNewFile = APP_DIR.'/../ola/img/thumbs/'.(isset($_GET['file']) ? $_GET['file'] : 'result.jpg');

$oImageManipulator->save($_GET['file']);

//$oImageManipulator->resize(300, 300);
//$oImageManipulator->show();
//
//$oImageManipulator->resize(100, 300);
//$oImageManipulator->show();

//$oImageManipulator->debug();

/*
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
*/


function dir_content($sPath, $sExt = null) {
    $aContent = array();
	if ($handle = opendir($sPath)) {
		while (($file = readdir($handle)) !== false) {
			if ($file != '.' && $file != '..') {
			    //echo $file.'_';
//			    if (is_dir($sPath.'/'.$file)) {
//			        if ($bRecursive) {
////			            $aItems = dir_content($sPath.'/'.$file);
////			            sort($aItems);
////        			    $aContent[$file] = $aItems;
//						$aContent[$file] = dir_content($sPath.'/'.$file);
//    			    } else {
//    			        $aContent[] = $file;
//    			    }
//			    } else {
			    	//if ($sExt)
    				$aContent[] = $file;
//				}
			}
		}
		closedir($handle);
	}
	
	return $aContent;
}



