<?php
/**
 * Created by PhpStorm.
 * User: Vadim
 * Date: 28.01.2018
 * Time: 2:09
 */

namespace backend\controllers;


use vendor\core\base\Controller;

class AppController extends Controller {
	public $layout = 'default';

	public function __construct( $route, $module ) {
		parent::__construct( $route, $module );
		if (!isset($_SESSION['user']['role']) && $_SESSION['user']['role'] !== 'admin'){
			header('Location: /admin/login');
			exit;
		}
	}
}