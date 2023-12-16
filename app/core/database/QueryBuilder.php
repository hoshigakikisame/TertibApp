<?php


class QueryBuilder
{
	protected $pdo;
	protected int $paginationLimit;
	function __construct(PDO $pdo)
	{	
		/**
		 * @var array $config
		 */
		$config = App::get('config');
		$this->pdo = $pdo;
		$this->setTimeZone();
		$this->paginationLimit = $config['database']['pagination_limit'];
	}

	private function setTimeZone()
	{
		/**
		 * @var array $config
		 */
		$config = App::get('config');
		$timezone = $config['timezone'];
		$this->pdo->exec("SET time_zone = '{$timezone}'");
	} 

	public function getLastInsertId()
	{
		return $this->pdo->lastInsertId();
	}

	public function count(string $table, array $where = []): int
	{
		$sql = sprintf(
			"SELECT COUNT(*) FROM %s %s",
			$table,
			$where ? "WHERE " . implode(' AND ', array_map(fn ($key) => "$key = :$key", array_keys($where))) : ''
		);

		$statement = $this->pdo->prepare($sql);
		$statement->execute($where);
		return $statement->fetchColumn();
	}

	/**
	 * select all rows from the table
	 * @param  string $table_name
	 * @return array    
	 */
	public function selectAll($table)
	{
		$statement = $this->pdo->prepare("SELECT * FROM {$table}");
		$statement->execute();
		return $statement->fetchAll(PDO::FETCH_CLASS) ?? [];
	}

	/**
	 * Find one row using an id|pk
	 * @param  string $id
	 * @param string $table_name
	 * @return array 
	 */

	 public function execute($sql, $params = []) {
		try {
			$statement = $this->pdo->prepare($sql);
			$statement->execute($params);
			return $statement->fetchAll(PDO::FETCH_CLASS) ?? [];
		} catch (PDOException $e) {
			die("Whoops!! Something Went Wrong!!!". $e->getMessage());
		}
	 }

	 public function findAll($table, string $orderby = '', string $order = 'ASC', int $page = 0) {
		$sql = sprintf(
			"SELECT * FROM %s %s",
			$table,
			($orderby ? "ORDER BY $orderby $order" : '') .
			($this->paginationLimit > 0 && $page > 0 ? " LIMIT " . ($page - 1) * $this->paginationLimit . ", $this->paginationLimit" : '')
		);

		try {
			$statement = $this->pdo->prepare($sql);
			$statement->execute();
			return $statement->fetchAll(PDO::FETCH_CLASS) ?? [];
		} catch (PDOException $e) {
			die("Whoops!! Something Went Wrong!!!". $e->getMessage());
		}
	 }

	 public function findMany($table, $parameters = [], string $orderby = '', string $order = 'ASC', int $page = 0)
	 {
		$sql = sprintf(
			"SELECT * FROM %s WHERE %s %s",
			$table,
			implode(' AND ', array_map(fn ($key) => "$key = :$key", array_keys($parameters))),
			($orderby ? "ORDER BY $orderby $order" : '') . 
			($this->paginationLimit > 0 && $page > 0 ? " LIMIT " . ($page - 1) * $this->paginationLimit . ", $this->paginationLimit" : '')
		);

		try {
			$statement = $this->pdo->prepare($sql);
			$statement->execute($parameters);
			return $statement->fetchAll(PDO::FETCH_CLASS) ?? [];
		} catch (PDOException $e) {
			die("Whoops!! Something Went Wrong!!!". $e->getMessage());
		}
	 }

	public function findOne($table, $parameters = [])
	{
		$sql = sprintf(
			"SELECT * FROM %s WHERE %s LIMIT 1",
			$table,
			implode(' AND ', array_map(fn ($key) => "$key = :$key", array_keys($parameters)))
		);
		try {
			$statement = $this->pdo->prepare($sql);
			$statement->execute($parameters);
			$results = $statement->fetchAll(PDO::FETCH_CLASS);
			return $results[0];
		} catch (PDOException $e) {
			die("Whoops!! Something Went Wrong!!! " . $e->getMessage());
		}
	}

	public function findWhere($table, $parameters = [])
	{
		$sql = sprintf(
			"SELECT * FROM %s WHERE %s",
			$table,
			implode(' AND ', array_map(fn ($key) => "$key = :$key", array_keys($parameters)))
		);

		try {
			$statement = $this->pdo->prepare($sql);
			$statement->execute($parameters);
			$results = $statement->fetchAll(PDO::FETCH_CLASS) ?? [];
			return $results;
		} catch (PDOException $e) {
			die("Whoops!! Something Went Wrong!!!");
		}
	}

	public function findWhereNot($table, $parameters = [], string $orderby = '', string $order = 'ASC', int $limit = 0)
	 {
		$sql = sprintf(
			"SELECT * FROM %s WHERE %s %s",
			$table,
			implode(' AND ', array_map(fn ($key) => "$key != :$key", array_keys($parameters))),
			($orderby ? "ORDER BY $orderby $order" : '') . 
			($limit > 0 ? " LIMIT $limit" : '')
		);

		try {
			$statement = $this->pdo->prepare($sql);
			$statement->execute($parameters);
			return $statement->fetchAll(PDO::FETCH_CLASS) ?? [];
		} catch (PDOException $e) {
			die("Whoops!! Something Went Wrong!!!". $e->getMessage());
		}
	 }

	/**
	 * Insert new data into the table
	 * @param  string $table  table name
	 * @param  array  $params [description]
	 * @return [type]         [description]
	 */
	public function insert(string $table, array $params = []): string 
	{
		$sql = sprintf(
			"INSERT INTO %s (%s) VALUES(%s)",
			$table,
			implode(',', array_keys($params)),
			':' . implode(', :', array_keys($params))
		);

		try {
			$statement = $this->pdo->prepare($sql);
			$statement->execute($params);

			return $this->getLastInsertId();
		} catch (PDOException $e) {
			die("Whoops!! Something Went Wrong!!!\n" . $e->getMessage());
		}
	}

	public function update(string $table, array $params = [], array $where = []) {
		$sql = sprintf(
			"UPDATE %s SET %s WHERE %s",
			$table,
			implode(',', array_map(fn ($key) => "$key = :$key", array_keys($params))),
			implode(' AND ', array_map(fn ($key) => "$key = :$key", array_keys($where)))
		);

		try {
			$statement = $this->pdo->prepare($sql);
			$statement->execute([...$params, ...$where]);
		} catch (PDOException $e) {
			die("Whoops!! Something Went Wrong!!!" . $e->getMessage());
		}
	}

	public function delete(string $table, array $where = []) {
		$sql = sprintf(
			"DELETE FROM %s WHERE %s",
			$table,
			implode(' AND ', array_map(fn ($key) => "$key = :$key", array_keys($where)))
		);

		try {
			$statement = $this->pdo->prepare($sql);
			$statement->execute($where);
		} catch (PDOException $e) {
			die("Whoops!! Something Went Wrong!!!");
		}
	}
}