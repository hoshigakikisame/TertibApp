<?php


class QueryBuilder
{
	protected $pdo;
	function __construct(PDO $pdo)
	{
		$this->pdo = $pdo;
	}

	public function getLastInsertId()
	{
		return $this->pdo->lastInsertId();
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
		return $statement->fetchAll(PDO::FETCH_CLASS);
	}

	/**
	 * @param  string $keyword [description]
	 * @param  string $table   [description]
	 * @return array          [description]
	 */
	public function search($keyword, $table)
	{

	}

	/**
	 * Find one row using an id|pk
	 * @param  string $id
	 * @param string $table_name
	 * @return array 
	 */

	 public function findAll($table) {
		$sql = sprintf(
			"SELECT * FROM %s",
			$table
		);

		try {
			$statement = $this->pdo->prepare($sql);
			$statement->execute();
			return $statement->fetchAll(PDO::FETCH_CLASS);
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
			die("Whoops!! Something Went Wrong!!!");
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
			$results = $statement->fetchAll(PDO::FETCH_CLASS);
			return $results;
		} catch (PDOException $e) {
			die("Whoops!! Something Went Wrong!!!");
		}
	}

	/**
	 * Insert new data into the table
	 * @param  string $table  table name
	 * @param  array  $params [description]
	 * @return [type]         [description]
	 */
	public function insert(string $table, array $params = [])
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