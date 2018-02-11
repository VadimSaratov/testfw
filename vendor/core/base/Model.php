<?php

namespace vendor\core\base;


use vendor\core\Db;
use vendor\core\Validation;

class Model {
	/*
	 * подключение с БД
	 */
	protected $pdo;
	/*
	 * таблица с которой работает модель
	 * @var string
	 */
	protected $table;

	/*
	 * имя первичного ключа в таблице, по умолчанию 'id'
	 * @var int
	 */
	protected $pk = 'id';

	/*
	 * данные пользователя
	 * @var array
	 */
	public $attributes = [];

	/*
	 * Загружаемые файлы
	 */
	public $files = [];

	/*
	 * правила валидации
	 * @var array
	 */
	public $rules = [];

	/*
	 * Ошибки при валидации полей
	 * @var array
	 */
	public $errors = [];


	public function __construct() {
		$this->pdo = Db::instance();
	}

	/*
	 * получение данных из формы и проверка на корректные поля
	 *
	 */
	public function load( $data, $files = false ) {
		foreach ( $this->attributes as $name => $value ) {
			if ( isset( $data[ $name ] ) ) {
				$this->attributes[ $name ] = htmlentities( $data[ $name ] );
			}
		}
		if ($files){
			foreach ( $this->files as $fileName => $value ) {
				if ( isset( $files[ $fileName ] ) ) {
					$this->files[$fileName] = $files[$fileName];
				}
			}
		}
		else{
			$this->files = false;
		}
	}

	public function validate() {
		$v = new Validation( $this->attributes, $this->rules, $this->files );
		if ( $v->isValidate() ) {
			return true;
		}
		$this->errors = $v->getErrors();
		return false;

	}

	public function dbFindAll($orderBy = []) {
		$sql = "SELECT * FROM {$this->table}";
		if ($orderBy && is_array($orderBy)){
			foreach ($orderBy as $fieldBy => $keyword){
				$sql .= " ORDER BY {$fieldBy} {$keyword}";
			}
		}
		return $this->pdo->query( $sql )->fetchAll();
	}

	public function selectOne( $id, $field = '' ) {
		$field = $field ?: $this->pk;
		$sql   = "SELECT * FROM {$this->table} WHERE $field = ? LIMIT 1";

		return $this->pdo->query( $sql, [ $id ] )->fetch();
	}

	public function customQuery( $sql, $params = [] ) {
		return $this->pdo->query( $sql, $params )->fetchAll();

	}

	public function selectAll( $id, $field = '',$orderBy = []) {
		$field = $field ?: $this->pk;
		$sql   = "SELECT * FROM {$this->table} WHERE $field = ?";
		if ($orderBy && is_array($orderBy)){
			foreach ($orderBy as $fieldBy => $keyword){
				$sql .= " ORDER BY {$fieldBy} {$keyword}";
			}
		}
		return $this->pdo->query( $sql, [ $id ] )->fetchAll();
	}

	public function dbInsert( $table, $fields = [] ) {
		$keys   = array_keys( $fields );
		$values = '';
		for ( $i = 1; $i <= count( $fields ); $i ++ ) {
			$values .= '?';
			if ( $i < count( $fields ) ) {
				$values .= ', ';
			}
		}
		$sql = "INSERT INTO {$table} (`" . implode( '`, `', $keys ) . "`) VALUES({$values})";
		if ( $this->pdo->query( $sql, $fields ) ) {
			return $this;
		}
		return false;
	}

	public function dbUpdate( $table, $where = [], $fields = [] ) {
		$params     = array_merge( $fields, $where );
		$whereField = array_keys( $where );
		$set = '';
		$x   = 1;
		foreach ( $fields as $name => $value ) {
			$set .= $name . ' = ?';
			if ( $x < count( $fields ) ) {
				$set .= ', ';
			}
			$x ++;
		}
		$sql = "UPDATE {$table} SET {$set} WHERE {$whereField[0]} = ?";
		if ( $this->pdo->query( $sql, $params ) ) {
			return true;
		}
		return false;
	}

	public function dbDelete( $id, $field = '' ) {
		$field = $field ?: $this->pk;
		$sql   = "DELETE FROM {$this->table} WHERE $field = ?";
		if (!$this->pdo->query( $sql, [ $id ] )){
			return false;
		}
		return true;
	}


}