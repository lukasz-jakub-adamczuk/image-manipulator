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
		
		

		
	if($image_x > $image_y) // Landscape
   {
      $ratio_x = ($image_x > $max_x) ? $max_x/$image_x : 1;
      $ratio_y = $ratio_x;
      $move = 'y';
   }
   else // Portrait
   {
      $ratio_y = ($image_y > $max_y) ? $max_y/$image_y : 1;
      $ratio_x = $ratio_y;
      $move = 'x';
   }
		
	}
	
	public function resize($iWidth, $iHeight) {
		echo 'resizing';
		
		if ($this->_sOrientation == 'landscape') {
			$this->_iWidthRatio = ($this->_iWidth > $iWidth) ? $iWidth / $this->_iWidth : 1;
			$this->_iHeightRatio = $this->_iWidthRatio;
			$move = 'y';
		} elseif ($this->_sOrientation == 'portrait') {
			$this->_iHeightRatio = ($this->_iHeight > $iHeight) ? $iHeight / $this->_iHeight : 1;
			$this->_iWidthRatio = $this->_iHeightRatio;
			$move = 'x';
		} else {
			echo 'BOTH';
		}
		
		$iNewWidth = $this->_iWidth * $this->_iWidthRatio;
		$iNewHeight = $this->_iHeight * $this->_iHeightRatio;
		
		

      $move_x = ($move == "x") ? ($iWidth - $iNewWidth) / 2 : 0;
      $move_y = ($move == "y") ? ($iHeight - $iNewHeight) / 2 : 0;
//      $move_x = 0;
//      $move_y = 0;
		
		
		$rImage = imagecreatetruecolor($iWidth, $iHeight);
		$rBackground = imagecolorallocate($rImage, 255, 255, 255);
		
		imagefill($rImage, 0, 0, $rBackground);
		imagecopyresampled($rImage, $this->_rImage, $move_x, $move_y, 0, 0, $iWidth, $iHeight, $this->_iWidth, $this->_iHeight);
		
//		$this->_saveToFile($rImage, dirname(__FILE__).'/result.jpg');
//		$this->_saveToFile('result.jpg', $rImage);
		$this->_sName = dirname(__FILE__).'/image.jpg';

		$sNewimage = dirname(__FILE__).'/image.jpg';
		
		imagejpeg($rImage, $sNewimage);
		//imagejpeg(dirname(__FILE__).'/iamge.jpg', null, 100);
		
	}
	
	public function show($img) {
		//return '<img src="'.basename($this->_sName).'" />';
		echo '<img src="'.basename($this->_sName).'" />';
	}
	
	protected function _saveToFile($save_image, $new_image) {
		if($this->imgType($save_image) == "IMAGETYPE_JPEG")
      {
      	if (
         imagejpeg($new_img, $save_image, 100)
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
