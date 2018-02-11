<?php
/**
 * Created by PhpStorm.
 * User: Vadim
 * Date: 28.01.2018
 * Time: 2:40
 */

namespace backend\models;


use vendor\core\base\Model;

class User extends Model {

	public $table = 'users';

	public $attributes = [
		'login' => '',
		'password' => '',
	];

	public $rules = [
		'login' => [
			'required' => 'true',
			'min' => 3,
			'max' => 20
		],
		'password' => [
			'required' => 'true',
			'min' => 4,
			'max' => 20
		]
	];

	public function login() {
		$login       = ! empty( trim( $_POST['login'] ) ) ? trim( $_POST['login'] ) : null;
		$password    = ! empty( trim( $_POST['password'] ) ) ? trim( $_POST['password'] ) : null;
		if ( $login && $password ) {
			$user = $this->selectOne( $login, 'login' );
			if ( $user ) {
				if ( sha1( $password ) === $user['password'] ) {
					foreach ( $user as $k => $v ) {
						if ( $k != 'password' ) {
							$_SESSION['user'][ $k ] = $v;
						}
					}
					return true;
				}
			}
		}
		$this->errors['signIn'] = 'Неправильный логин или пароль!';
		return false;
	}

	public function logOut(){
		if (isset($_SESSION['user'])){
			unset($_SESSION['user']);
			return true;
		}
		return false;
	}
}