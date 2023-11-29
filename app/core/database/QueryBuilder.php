<?php


class QueryBuilder
{
	protected $pdo;
	function __construct(PDO $pdo)
	{
		$this->pdo = $pdo;
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
	public function findOne($table, $parameters = [])
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
			return $results[0];
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

		} catch (PDOException $e) {
			die("Whoops!! Something Went Wrong!!!");
		}

	}
}