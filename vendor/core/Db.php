<?php
namespace vendor\core;

class Db{
	/*
	 *
	 */
	protected $pdo;

	/*
	 *
	 */
	protected static $instance;

	/*
	 * количество удачных SQL запросов
	 * @var int
	 */
	public static $countSql = 0;

	/*
	 * все выполненные запросы
	 * @var array
	 */
	public static $queries = [];


	protected function __construct() {
		$db = require ROOT . '/common/config/config_db.php';
		$options = [
			\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
			\PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
		];
		$this->pdo = new \PDO($db['dsn'],$db['user'],$db['password'], $options);
	}

	public static function instance(){
		if (self::$instance === null){
			self::$instance = new self;
		}
		return self::$instance;
	}

	private function __clone() {
		// TODO: Implement __clone() method.
	}
	/*
	 * метод для создания таблиц, изменения таблиц
	 */

	public function execute($sql,  $params = []){
		self::$countSql++;
		self::$queries[] = $sql;
		$stmt = $this->pdo->prepare($sql);
		return $stmt->execute($params);
	}

	public function query($sql, $params = []) {
		self::$countSql++;
		self::$queries[] = $sql;

		$stmt = $this->pdo->prepare($sql);
		if (!empty($params)) {
			$x =1;
			foreach ($params as $key => $val) {
				$stmt->bindValue($x, $val, \PDO::PARAM_STR);
				$x++;
			}
		}
		$stmt->execute();
		return $stmt;
	}
	public function lastID(){
		return $this->pdo->lastInsertId();
	}

}

?>