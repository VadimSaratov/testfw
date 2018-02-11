<?php

namespace frontend\models;

use \vendor\core\base\Model;

class Site extends Model {

	public $table = 'banners';

	public function getBanners(){

		return  $this->selectAll(1,'status', ['position' => 'ASC']);
 	}

}