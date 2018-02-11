<?php

namespace backend\models;

use \vendor\core\base\Model;

class Site extends Model {

	public $table = 'banners';

	public function getBanners(){
		return  $this->dbFindAll(['position' => 'ASC']);
 	}


}