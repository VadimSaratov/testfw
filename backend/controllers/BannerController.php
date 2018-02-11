<?php

namespace backend\controllers;

use backend\models\Banner;
use vendor\core\base\View;


class BannerController extends AppController {

	public function actionAdd() {

		if ( ! empty( $_POST ) ) {
			$model = new Banner();
			$model->load( $_POST, $_FILES );
			if ( $model->validate() ) {
				$model->addBanner();
				if ($this->isAjax()){
					$this->layout = false;
					echo 'OK';
				}
			} else {
				$errors = $model->errors;
				if ($this->isAjax()){
					$this->layout = false;
					echo json_encode($errors, JSON_UNESCAPED_UNICODE);
				}else{
					$this->set( compact( 'errors' ) );
				}
			}
		}

		View::setMeta( 'Админка::Добавить', 'Описание', 'Ключевые слова' );
	}

	public function actionEdit() {
		$model = new Banner();
		$id    = (int) $_GET['id'];
		if ( ! empty( $id ) ) {
			$banner = $model->selectOne( $id );
			$this->set( compact( 'banner' ) );
			if ( ! empty( $_POST ) ) {
				$model->load( $_POST, ! empty( $_FILES['image']['name'] ) ? $_FILES : null );
				if ( $model->checkFields( $_POST, $banner )->validate() ) {
					$model->updateBanner( $id );
				} else {
					$errors = $model->errors;
					$this->set( compact( 'errors', 'banner' ) );
				}
			}
			View::setMeta( 'Админка::Редактирование', 'Описание', 'Ключевые слова' );
		}
	}

	public function actionDelete() {
		$this->layout = false;
		$model = new Banner();
		$id    = (int) $_GET['id'];
		if ( ! empty( $id ) ) {
			if ($model->deleteBanner( $id )){
			header( 'Location: /admin/' );
			exit;
			}
		}
	}

	public function actionPosition() {
		$this->layout = false;
		$model        = new Banner();
		if ( $this->isAjax() ) {
			if ( ! empty( $_POST ) ) {
				foreach ( $_POST as $id => $position ) {
				$model->updatePosition( $id, $position );
				}
			}
		}
	}
	public function actionStatus() {
		if ( $this->isAjax() ) {
			$this->layout = false;
			if ( ! empty( $_POST['status'] ) && ! empty( $_POST['id'] ) ) {
				$model = new Banner();
				if ( $model->setStatus( $_POST['id'], $_POST['status'] ) ) {
					echo 'OK';
				}
			}
		}
	}
}

?>