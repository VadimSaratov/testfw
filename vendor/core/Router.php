<?php
namespace vendor\core;

class Router {

	/*
	 * $routes - все маршруты
	 * @var array
	 * */
	protected  $routes = [];
	/*
	 * $route - текущий маршрут
	 * @var array
	 * */
	protected  $route = [];

	protected  $controllerNamespace = 'frontend\controllers';
	protected  $module = 'frontend';

	/*
	 * метод add для наполнения $routes
	 * @param string $regexp - регулярное выражение маршрута (URL, параметры)
	 * @param array $route маршрут[controllers, action, params]
	 * */
	public function __construct($config) {
		$this->routes = $config['routes'];
		$this->controllerNamespace = $config['controllerNamespace'];
		$this->module = $config['module'];
	}


	/*
	 * метод getRoutes для получения всех маршрутов $routes
	 * */
	public  function getRoutes() {
		return $this->routes;
	}

	/*
	 * метод getRoute для получения текущего маршрута $route
	 * */
	public function getRoute() {
		return $this->route;
	}

	/*
	 * ищет URL в таблице маршрутов
	 * @param string $url входящий URL
	 * @return boolean
	 * */
	public  function matchRoute( $url ) {
		foreach ( $this->routes as $pattern => $route ) {
			if ( preg_match( "#$pattern#i", $url, $matches ) ) {
				foreach ( $matches as $k => $v ) {
					if ( is_string( $k ) ) {
						$route[ $k ] = $v;
					}
				}
				if ( ! isset( $route['action'] ) ) {
					$route['action'] = 'index';
				}
				$this->route = $route;
				return true;
			}
		}

		return false;
	}
	/*
	 * перенаправляет URL по корректному маршруту
	 *@param string $url входящий URL
	 *@return void
	 */

	public  function run( $url ) {
		$url = $this->removeQueryString($url);
		if ( $this->matchRoute( $url ) ) {
			$controller = $this->controllerNamespace . DS . ucfirst($this->route['controller']) . 'Controller';
			if (class_exists($controller)){
				$cObj = new $controller($this->route, $this->module);
				$action = 'action' . $this->route['action'];
				if (method_exists($cObj,$action)){
					$cObj->$action();
					$cObj->getView();
				}else{
					echo "метод <b>$controller::$action</b> не найден";
				}
			}else{
				echo 'Controller<b> '. $controller .' </b>не найден!';
			}
		} else {
			http_response_code( 404 );
			include '404.html';
		}
	}

	protected  function removeQueryString($url){
		if ($url){
			$params = explode('&', $url, 2);
			if (false === strpos($params[0], '=')){
				return rtrim($params[0], '/');
			}else{
				return '';
			}
		}
	}

}
?>