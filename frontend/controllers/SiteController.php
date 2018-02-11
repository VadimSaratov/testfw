<?php
namespace frontend\controllers;

use frontend\models\Site;
use vendor\core\base\View;

class SiteController extends AppController {


	public function actionIndex() {
		$model = new Site();
		$banners = $model->getBanners();
		View::setMeta('Ротатор баннеров', 'Описание', 'Ключевые слова');
		$this->set(compact('banners'));
	}
}