<?php

namespace backend\controllers;

use backend\models\User;
use vendor\core\base\Controller;
use vendor\core\base\View;

class UserController extends Controller {

	public function actionLogin() {
		$this->layout = 'login';
		if (isset($_SESSION['user'])){
			header('Location: /admin');
			exit;
		}

		if ( ! empty( $_POST ) ) {
			$model = new User();
			$model->load( $_POST );
			if ( $model->validate() ) {
				if ( $model->login() ) {
					header( 'Location: /admin' );
					exit;
				} else {
					$errors = $model->errors;
					$this->set( compact( 'errors' ) );
				}
			} else {
				$errors = $model->errors;
				$this->set( compact( 'errors' ) );
			}
		}
		View::setMeta( 'Админка::Вход', 'Описание', 'Ключевые слова' );

	}

	public function actionLogout() {
		$this->layout = 'login';
		$model = new User();
		if ($model->logOut()){
			header('Location: /admin/login');
			exit;
		}
	}

}