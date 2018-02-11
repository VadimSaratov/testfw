<?php
/**
 * Created by PhpStorm.
 * User: Vadim
 * Date: 30.01.2018
 * Time: 23:08
 */

namespace vendor\core;


class Validation {
	/*
	 * параметры и данные для валидации
	 * @ver array
	 */
	private $_data = [];

	/*
	 * подключение к БД
	 */
	private $_pdo;

	/*
	 * список ошибок
	 */
	private $_errors = [];
	/*
	 * whitelist загружаемых файлов
	 * @var array
	 */
	private $_types = [ 'jpg', 'png', 'gif', 'bmp', 'jpeg' ];


	public function __construct( $data, $rules, $files = null ) {
		$this->_data = $data;
		foreach ( $rules as $field => $methods ) {
			foreach ( $methods as $method => $value ) {
				$this->$method( $field, $value );
			}
		}
		if ( $files ) {
			$this->can_upload( $files );
		}
	}

	/*
    * проверка на заполнение поля
    */
	public function required( $field ) {
		if ( ! isset( $this->_errors[ $field ] ) ) {
			if ( ! trim( $this->_data[ $field ] ) ) {
				$this->_errors[ $field ] = 'Поле должно быть заполнено';
			}
		}
	}

	/*
	* проверка на минимальное кол-во символов в строке
	*/

	public function min( $field, $min ) {
		if ( ! isset( $this->_errors[ $field ] ) ) {
			if ( strlen( trim( $this->_data[ $field ] ) ) < $min ) {
				$this->_errors[ $field ] = 'В поле должно быть не меньше ' . $min . ' символов';
			}
		}
	}
	/*
	* проверка на максимальное кол-во символов в строке
	*/
	public function max( $field, $max ) {
		if ( ! isset( $this->_errors[ $field ] ) ) {
			if ( strlen( trim( $this->_data[ $field ] ) ) > $max ) {
				$this->_errors[ $field ] = 'В поле должно быть не больше ' . $max . ' символов';
			}
		}
	}

	/*
	 * проверка на соответствие заданному регулярному выражению
	 */
	public function regexp( $field, $pattern ) {
		if ( ! isset( $this->_errors[ $field ] ) ) {

			if ( ! preg_match( $pattern, $this->_data[ $field ] ) ) {

				$this->_errors[ $field ] = 'Некорректно заполнено поле';
			}
		}
	}

	/*
	 * проверка на числовое значение
    */

	public function number( $field ) {
		if ( ! isset( $this->_errors[ $field ] ) ) {
			if ( ! is_numeric( $this->_data[ $field ] ) ) {
				$this->_errors[ $field ] = 'Допускается только числовое значение';
			}
		}
	}

	/*
 * проверка на наличие записи с указанным параметром в БД
 * @return void
 */

	public function unique( $field, $table ) {
		$this->_pdo = Db::instance();
		if ( ! isset( $this->_errors[ $field ] ) ) {
			$pos = $this->_pdo->query( "SELECT * FROM {$table} WHERE {$field} = {$this->_data[$field]}" );
			if ( $pos->fetchAll() ) {
				$this->_errors[ $field ] = 'Данная позиция занята';
			}
		}
	}

	/*
	 * проверка загружаемого файла
	 *
	 */


	public function can_upload( $files ) {
		foreach ( $files as $file => $name ) {
			if ( empty($files[ $file ]['name'])) {
				$this->_errors[ $file ] = 'Вы не выбрали файл';
			} elseif ( $files[ $file ]['size'] == 0 ) {
				$this->_errors[ $file ] = 'Вы не выбрали файл';
			} elseif ( ! $this->checkMime( $files[ $file ]['name'] ) ) {
				$this->_errors[ $file ] = 'Недопустимый тип файла';
			}
		}
	}

	/*
	 * проверка соотвествия расширения файла допустимым
	 * @return boolean
	 */

	public function checkMime( $fileName ) {
		$getMime = explode( '.', $fileName );
		$mime    = strtolower( end( $getMime ) );
		if ( ! in_array( $mime, $this->_types ) ) {
			return false;
		}

		return true;
	}

	/*
	 * получение информации об успешной\неуспешной валидации
	 * @return boolean
	 */

	public function isValidate() {
		if ( empty( $this->_errors ) ) {
			return true;
		} else {
			return false;
		}
	}

	/*
    * получение списка ошибок
    * @return array
    */

	public function getErrors() {
		return $this->_errors;
	}
}