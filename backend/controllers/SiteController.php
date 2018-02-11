<?php
namespace backend\controllers;

use backend\models\Site;
use vendor\core\base\View;

class SiteController extends AppController {


	public function actionIndex() {
		$model = new Site();
		$banners = $model->getBanners();
		$this->set(compact('banners'));
		View::setMeta('Админка::Главная', 'Описание', 'Ключевые слова');
	}

}