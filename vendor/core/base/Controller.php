<?php

namespace vendor\core\base;

abstract class Controller {
	/*
	 * текущий маршрут и параметры
	 * @var array
	 */
	public $route = [];
	/*
	 * текущий вид
	 * @var string
	 */
	public $view;
	/*
	 * текущий шаблон
	 * @var string
	 */
	public $layout;

	/*
	 * $module - текущий модуль
     * @var string
	 * */
	public $module;

	/*
	 * пользовательские данные
	 * @var array
	 */
	public $data;
	/*
	 * теущая модель
	 *
	 */

//	public $model;


	public function __construct( $route, $module ) {
		$this->route = $route;
		$this->view  = $route['action'];
		$this->module = $module;
//		$this->model = $this->loadModel();

	}

	/*
	 * подключение вида, вызов метода render из класса View
	 *@return void
	*/
	public function getView() {
		$vObj = new View( $this->route, $this->module, $this->layout, $this->view );
		$vObj->render($this->data);
	}

	/*
	 * заполнение свойства data пользовательскими данными
    */
	public function set( $data ) {
		$this->data = $data;

	}
	/*
	 * автозагрузка модели
	 */

//	public function loadModel(){
//		 $path =  $this->module . DS . 'models' . DS . ucfirst($this->route['controller']);
//		if (class_exists($path)){
//			return new $path;
//		}
//		return false;
//	}
	/*
	 * Провереяет поступили ли данные ассинхронно
	 * @return boolean
	 */
	public function isAjax(){
		return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest';
	}

	/*
	 * подключение view файла из папки
	 */
	public function loadView($view, $vars = [], $dir = ''){
		extract($vars);
		if (empty($dir)){
			$dir = $this->route['controller'];
		}
		require ROOT . DS . $this->module . DS . 'views' . DS . $dir . DS . $view . '.php';

	}

}