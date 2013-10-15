<?php
class Thumbnailer extends CApplicationComponent
{
	public $wideImagePath; // WideImage relative path from application base path
	public $width;
	public $height;
        public $image = null;


        public function init()
	{
		include dirname(__FILE__) . DIRECTORY_SEPARATOR .
				$this->wideImagePath . DIRECTORY_SEPARATOR .
				'WideImage.php';
	}
        
        public function load($imagePath) {
            $this->image = WideImage::load($imagePath);
            return $this;
        }
	
	public function generate($imagePath, $thumbnailPath)
	{
		$image = WideImage::load($imagePath);
		$resized = $image->resize($this->width, $this->height, 'outside');
		$cropped = $resized->crop('center', 'center', $this->width, $this->height);
		$cropped->saveToFile($thumbnailPath);
	}
        
        public function writeText($text, $fontSize = 18, $rgb = array(200, 220, 225), $x = 'right-10', $y = 'bottom-10', $angle = 0) {
            if($this->image == null) {
                return false;
            }
            $canvas = $this->image->getCanvas();
            $canvas->useFont('Arial.ttf', $fontSize, $this->image->allocateColor($rgb[0], $rgb[1], $rgb[2]));
            $canvas->writeText($x, $y, $text, $angle);
            
            return $this;
        }
        
        public function writeShadowText($text, $fontSize = 18, $rgb = array(200, 220, 225), $x = 'right-5', $y = 'bottom-5', $angle = 0) {
            if($this->image == null) {
                return false;
            }
            
            if(!is_array($rgb) && count($rgb) != 3) {
                $rgb = array(200, 220, 225);
            }
            
            $fontSize = max($fontSize, 10);
            $this->writeText($text, $fontSize, array(0,0,0), "$x+1", "$y+1", $angle);
            $this->writeText($text, $fontSize, $rgb, $x, $y, $angle);
            
            return $this;
        }
        
        public function saveToFile($imagePath) {
            if($this->image == null) {
                return false;
            }
            
            $this->image->saveToFile($imagePath);
        }
}