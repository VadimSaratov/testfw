<?php
/**
 * Created by PhpStorm.
 * User: Vadim
 * Date: 01.02.2018
 * Time: 22:43
 */

namespace vendor\core;


class UploadImg {

	/*
	 * текущее изображение
	 *
	 */
	private $_image;
	/*
	 * исходная ширина изображения
	 *
	 */
	private $_width;
	/*
	 * исходная высота изображения
	 *
	 */
	private $_height;
	/*
	 * тип изображения (jpg, png, gif)
	 *
	 */
	private $_type;

	function __construct($file)
	{
		foreach ($file as $name => $value){
			$this->setType($file[$name]['tmp_name']);
			$this->openImage($file[$name]['tmp_name']);
			$this->setSize();
		}
	}

	/*
 * проверяет, является ли файл изображением и устанавливает его тип
 */
	private function setType($file)
	{
		$mime = mime_content_type($file);
		switch($mime)
		{
			case 'image/jpeg':
				$this->_type = "jpg";
				return true;
			case 'image/png':
				$this->_type = "png";
				return true;
			case 'image/gif':
				$this->_type = "gif";
				return true;
			default:
				return false;
		}
	}

	/*
	 * Определяет тип изображения
	 */
	private function openImage($file)
	{
		switch($this->_type)
		{
			case 'jpg':
				$this->_image = imagecreatefromjpeg($file);
				break;
			case 'png':
				$this->_image = imagecreatefrompng($file);
				break;
			case 'gif':
				$this->_image = imagecreatefromgif($file);
				break;
			default:
				exit("File is not an image");
		}
	}



	/*
	 * Устанавливает размеры изображения
	 */
	private function setSize()
	{
		$this->_width = imagesx($this->_image);
		$this->_height = imagesy($this->_image);
	}

	public function resize($width, $height){
		$newImage = imagecreatetruecolor($width, $height);
		imagecopyresampled($newImage, $this->_image, 0, 0, 0, 0, $width, $height, $this->_width, $this->_height);
		$this->_image = $newImage;
		$this->setSize();
		return $this;

	}

	function save($path, $fileName) {
		$file = trim( $fileName ) . "." . $this->_type;
		$savePath = $path . $file;
		switch ( $this->_type ) {
			case 'jpg':
				imagejpeg( $this->_image, $savePath );
				return $file;
			case 'png':
				imagepng( $this->_image, $savePath );
				return $file;
			case 'gif':
				imagegif( $this->_image, $savePath );
				return $file;
			default:
				return false;
		}
	}


}