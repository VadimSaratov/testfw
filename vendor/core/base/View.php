<?php

namespace vendor\core\base;


class View {

	/*
	 * $route - текущий маршрут
	 * @var array
	 * */
	public $route = [];

	/*
	 * $view - текущий вид
	 * @var string
	 * */
	public $view;

	/*
	 * $layout - текущий шаблон
	 * @var string
	 * */
	public $layout;
	/*
	 * $module - текущий модуль
     * @var string
	 * */
	public $module;
	/*
	 * массив со скриптами документа
	 * @var array
	 */
	public $scripts;

	/*
	 *
	 */
	public static $meta = ['title' => '', 'desc' => '', 'keywords' => ''];

	public function __construct( $route, $module, $layout = '', $view = '' ) {
		$this->route = $route;
		if ( $layout === false ) {
			$this->layout = false;
		} else {
			$this->layout = $layout ?: LAYOUT;
		}
		$this->view = $view;
		$this->module = $module;
	}

	/*
	 * подключение видов и шаблонов
	 *@return void
	 */
	public function render($data) {
		if (is_array($data)){
			extract($data);
		}
		$file_view = ROOT . DS . $this->module . DS . 'views' . DS . $this->route['controller'] . DS . $this->view . '.php';
		ob_start();
		if ( is_file( $file_view ) ) {
			require $file_view;
		} else {
			echo "<p>Не найден вид <b>$file_view </b></p>";
		}
		$content = ob_get_clean();
		if ( false !== $this->layout ) {
			$file_layout =  ROOT . DS . $this->module . DS . 'views'. DS .'layouts' . DS . $this->layout . '.php';
			if ( is_file( $file_layout ) ) {
				$content = $this->getScript($content);
				$scripts = [];
				if (!empty($this->scripts[0])){
					$scripts = $this->scripts[0];
				}
				require $file_layout;
			} else {
				throw new \Exception("<p>Не найден вид <b>$file_view </b></p>", 404);
			}
		}
	}
	/*
	 * Вырезает <script></script> и вставляет в конец документа
	 *
	 */
	protected function getScript($content){
		$pattern = "#<script.*?>.*?</script>#si";
		preg_match_all($pattern, $content, $this->scripts);
		if (!empty($this->scripts)){
			$content = preg_replace($pattern, '', $content);
		}
		return $content;

	}
	public static function getMeta(){
		echo '<title>' . self::$meta['title'] . '</title>
			<meta name="description" content="' . self::$meta['desc'] . '">
    		<meta name="keywords" content="' . self::$meta['keywords'] . '">';

	}
	public static function setMeta($title ='', $desc = '', $keywords = ''){
		self::$meta['title'] = $title;
		self::$meta['desc'] = $desc;
		self::$meta['keywords'] = $keywords;
	}

}