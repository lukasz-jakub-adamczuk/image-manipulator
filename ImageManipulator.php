<?php

class ImageManipulator {
	
	private $_rImage;
	
	private $_sName;
	
	private $_sType;
	
	private $_sOrientation;
	
	private $_iWidth;
	
	private $_iHeight;
	
	private $_iWidthRatio;
	
	private $_iHeightRatio;
	
	public function __construct() {
		
	}
	
	public function loadImage($source) {
		$this->_sName = $source;
		
		
		if($this->imgType($source) == "IMAGETYPE_JPEG")
      {
         $img_src = imagecreatefromjpeg($source);
      }
      elseif($this->imgType($source) == "IMAGETYPE_GIF")
      {
         $img_src = imagecreatefromgif($source);
      }
      elseif($this->imgType($source) == "IMAGETYPE_PNG")
      {
         $img_src = imagecreatefrompng($source);
      }
      else
      {
         die('Wrong filetype! Accepted images: JPG/JPEG, GIF, PNG');
      }
      

		$this->_rImage = $img_src;
		
		$this->_iWidth = imagesx($this->_rImage);
		$this->_iHeight = imagesy($this->_rImage);
		
		if ($this->_iWidth > $this->_iHeight) {
			$this->_sOrientation = 'landscape';
		} elseif ($this->_iWidth < $this->_iHeight) {
			$this->_sOrientation = 'portrait';
		} else {
			$this->_sOrientation = 'square';
		}

	}
	
	public function resize($iWidth, $iHeight, $bMargins = true, $sHorCrop = 'center', $sVerCrop = 'center') {
		// check image orientation
		if ($this->_sOrientation == 'landscape') {
			if ($bMargins) {
				$this->_iWidthRatio = ($this->_iWidth > $iWidth) ? $iWidth / $this->_iWidth : 1;
				$this->_iHeightRatio = $this->_iWidthRatio;
				$sMove = 'y';
			} else {
				$this->_iHeightRatio = ($this->_iHeight > $iHeight) ? $iHeight / $this->_iHeight : 1;
				$this->_iWidthRatio = $this->_iHeightRatio;
				$sMove = 'x';
			}
		} elseif ($this->_sOrientation == 'portrait') {
			if ($bMargins) {
				$this->_iHeightRatio = ($this->_iHeight > $iHeight) ? $iHeight / $this->_iHeight : 1;
				$this->_iWidthRatio = $this->_iHeightRatio;
				$sMove = 'x';
			} else {
				$this->_iWidthRatio = ($this->_iWidth > $iWidth) ? $iWidth / $this->_iWidth : 1;
				$this->_iHeightRatio = $this->_iWidthRatio;
				$sMove = 'y';
			}
		} else {
			if ($iWidth > $iHeight) {
//				$this->_iWidthRatio = $this->_iHeightRatio = $iWidth / $this->_iWidth;
				$this->_iWidthRatio = $this->_iHeightRatio = $iHeight / $this->_iHeight;
				$sMove = 'x';
			} else {
//				$this->_iWidthRatio = $this->_iHeightRatio = $iHeight / $this->_iHeight;
$this->_iWidthRatio = $this->_iHeightRatio = $iWidth / $this->_iWidth;
				$sMove = 'y';
			}
		}
		
		$iNewWidth = $this->_iWidth * $this->_iWidthRatio;
		$iNewHeight = $this->_iHeight * $this->_iHeightRatio;
		
//		echo '$iNewWidth'. $iNewWidth.'<br />';
//		echo '$iNewHeight'. $iNewHeight.'<br />';
		
		if ($sHorCrop == 'left') {
			$sMoveWidth = 0;
		} elseif ($sHorCrop == 'center') {
			$sMoveWidth = ($sMove == "x") ? ($iWidth - $iNewWidth) / 2 : 0;
		} else {
			$sMoveWidth = ($sMove == "x") ? ($iWidth - $iNewWidth) : 0;
		}

		if ($sVerCrop == 'top') {
			$sMoveHeight = 0;
		} elseif ($sVerCrop == 'center') {
			$sMoveHeight = ($sMove == "y") ? ($iHeight - $iNewHeight) / 2 : 0;
		} else {
			$sMoveHeight = ($sMove == "y") ? ($iHeight - $iNewHeight) : 0;
		}
				
		$rImage = imagecreatetruecolor($iWidth, $iHeight);
		$rBackground = imagecolorallocate($rImage, 255, 255, 255);
		
		imagefill($rImage, 0, 0, $rBackground);
		imagecopyresampled($rImage, $this->_rImage, $sMoveWidth, $sMoveHeight, 0, 0, $iNewWidth, $iNewHeight, $this->_iWidth, $this->_iHeight);
		
		$this->_sName = dirname(__FILE__).'/image-'.$iWidth.'-'.$iHeight.'.jpg';
		$this->_rImage = $rImage;
		
		imagejpeg($rImage, $this->_sName);
	}
	
	public function show() {
		//return '<img src="'.basename($this->_sName).'" />';
		echo '<img src="'.basename($this->_sName).'" style="border: 1px solid #aaa; margin: 5px;" />';
	}
	
	public function debug() {
		echo '<pre>';
		echo 'img width :      '.$this->_iWidth."\n"
			.'img height:      '.$this->_iHeight."\n"
			.'img ratio width: '.$this->_iWidthRatio."\n"
			.'img ratio height:'.$this->_iHeightRatio."\n"
			.'</pre>';
	}
	
	public function save($sFile) {
		$sFile = isset($sFile) ? $sFile : $this->_sName;
		imagejpeg($this->_rImage, $sFile);
	}
	
	protected function _saveToFile($save_image, $new_image) {
		if($this->imgType($save_image) == "IMAGETYPE_JPEG")
      {
      	if (
         imagejpeg($new_img, $save_image, 80)
         ) {
         	echo 'ok';
         } else {
         	echo 'no';
         }
      }
      elseif($this->imgType($save_image) == "IMAGETYPE_GIF")
      {
         imagegif($new_img, $save_image);
      }
      elseif($this->imgType($save_image) == "IMAGETYPE_PNG")
      {
         imagepng($new_img, $save_image);
      }
	}
	
	function imgType($name)
	{
	   if(substr($name, -4, 4) == '.jpg' || substr($name, -4, 4) == 'jpeg')
	   {
	      return "IMAGETYPE_JPEG";
	   }
	   elseif(substr($name, -4, 4) == '.gif')
	   {
	      return "IMAGETYPE_GIF";
	   }
	   elseif(substr($name, -4, 4) == '.png')
	   {
	      return "IMAGETYPE_PNG";
	   }
	}
}
