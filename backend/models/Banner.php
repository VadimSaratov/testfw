<?php
/**
 * Created by PhpStorm.
 * User: Vadim
 * Date: 30.01.2018
 * Time: 21:13
 */

namespace backend\models;


use vendor\core\base\Model;
use vendor\core\UploadImg;

class Banner extends Model {

	public $table = 'banners';

	public $attributes = [
		'name' => '',
		'url' => '',
		'status' => '',
		'position' => '',
	];

	public $files = [
		'image' => ''
	];

	public $rules = [
			'name' => [
				'required' => 'true',
				'min' => 3,
				'max' => 20
				],
			'url' => [
				'required' => 'true',
				'regexp' => '/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/'
				],
			'position' => [
				'required' => 'true',
				'number' => 'true',
				'unique' => 'banners'
			]
		];

	public function addBanner(){
		if (!empty($this->attributes['status'])){
			$this->attributes['status'] = 1;
		}else{
			$this->attributes['status'] = 0;
		}
		if ($this->dbInsert($this->table, $this->attributes)){
			$id = $this->pdo->lastID();
			$img = new UploadImg($this->files);
			$img = $img->resize(700, 500)->save(IMG_PATH, $id);
			if ($this->dbUpdate($this->table, ['id' => $id], ['image' => $img] )){
				return true;
			}
		}
		return false;
	}

	public function updateBanner($id){
		if (!empty($this->attributes['status'])){
			$this->attributes['status'] = 1;
		}else{
			$this->attributes['status'] = 0;
		}
		if (!empty($this->files)){
			$img = new UploadImg($this->files);
			$img = ['image' => $img->resize(700, 500)->save(IMG_PATH, $id)];
			$this->attributes = array_merge($this->attributes, $img);
		}if ($this->dbUpdate($this->table, ['id' => $id], $this->attributes )){
			return true;
		}
		return false;
	}

	public function checkFields($post =[], $fields =[]){
		$res = array_intersect_assoc($post, $fields);
		if (is_array($res)){
			foreach ($res as $key => $value){
				unset($this->rules[$key]);
			}
		}
		return $this;
	}

	public function deleteBanner($id){
		$img = $this->selectOne($id)['image'];
		$file = IMG_PATH . $img;
		if (file_exists($file)){
			unlink($file);
		}
		if (!$this->dbDelete($id)){
			return false ;
		}
		return true;
	}

	public function updatePosition($id, $position){
		$id = (int)$id;
		$position = (int)$position;
		if ($this->dbUpdate($this->table, ['id' => $id], ['position' => $position] )){
			return true;
		}
		return false;
	}

	public function setStatus($id, $status) {
		$id     = (int) $id;
		$status = $status === 'true' ? 1 : 0;
		if ( $id ) {
			if ( $this->dbUpdate( $this->table, [ 'id' => $id ], [ 'status' => $status ] ) ) {
				return true;
			}
		}
		return false;
	}


}