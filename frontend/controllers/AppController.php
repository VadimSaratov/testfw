<?php
/**
 * Created by PhpStorm.
 * User: Vadim
 * Date: 28.01.2018
 * Time: 2:09
 */

namespace frontend\controllers;


use vendor\core\base\Controller;

class AppController extends Controller {

	public function __construct( $route, $module ) {
		parent::__construct( $route, $module );
	}
}