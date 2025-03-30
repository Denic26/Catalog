<?php 
	function dd($a)
	{
		echo '<pre>';
		print_r($a);
		echo '</pre>';
	}

	class DB
	{
		// Объект класса PDO
		public $db;
	
		// Соединение с БД
		public function __construct()
		{
			$dbinfo = require 'C:\OSPanel\domains\abd-31\project 4\dbinfo.php';
			$this->db = new PDO('mysql:host=' . $dbinfo['host'] . ';dbname=' . $dbinfo['dbname'], $dbinfo['login'], $dbinfo['password']);
			// Устанавливаем режим ошибок
			$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}
	
		// Операции над БД
		public function query($sql, $params = [])
		{
			$stmt = $this->db->prepare($sql);
	
			if (!empty($params)) {
				foreach ($params as $key => $value) {
					$stmt->bindValue(":$key", $value);
				}
			}
	
			// Выполняем запрос
			$stmt->execute();
			
			// Если запрос на вставку данных, возвращаем последний вставленный ID
			if (strpos(strtoupper($sql), 'INSERT') === 0) {
				return $this->db->lastInsertId();  // Возвращаем последний вставленный ID
			}
	
			// Для других типов запросов возвращаем результаты
			return $stmt->fetchAll(PDO::FETCH_ASSOC);
		}
	
		// Дополнительный метод для получения последнего вставленного ID (в случае необходимости)
		public function lastInsertId()
		{
			return $this->db->lastInsertId();
		}
	}
		function Redirect($url, $permanent = false)
	{
		header('Location: ' . $url, true, $permanent ? 301 : 302);
	
		exit();
	}
?>