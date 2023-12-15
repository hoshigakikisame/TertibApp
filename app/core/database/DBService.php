<?php

class DBService {
    private static $instances = [];

    /**
     * @var QueryBuilder
     */
    private $db;
    private string $table;
    private string $view;

    public function __construct(string $table = '', string $view = ''){
        $this->db = App::get('database');
        assert($this->db instanceof QueryBuilder);
        $this->table = $table;
        $this->view = $view != '' ? $view : $table;
    }

    protected function __clone(){}

    public function __wakeup(){
        throw new \Exception("Cannot unserialize a singleton.");
    }
    public static function getInstance(): self
    {
        $cls = static::class;
        if (!isset(self::$instances[$cls])) {
            self::$instances[$cls] = new static();
        }

        return self::$instances[$cls];
    }

    public function getTable() {
        return $this->table;
    }

    public function getDB() {
        return $this->db;
    }

    public function getView() {
        return $this->view;
    }

    public function getAll() {
        $rawData = $this->db->findAll($this->view);

        return $rawData;
    }

    public function getSingle(array $where) {
        $rawData = $this->db->findOne($this->view, $where);

        return $rawData;
    }
}