<?php

namespace Helpers;

class DB
{
	private $dbh;
	private $error;
	private $stmt;
	
	public function __construct() 
    {
        $config = parse_ini_file(__DIR__."/../config.ini");
        
		// Set DSN
		$dsn = 'mysql:host=' . $config['DB_HOST'] . ';dbname=' . $config['DB_NAME'];
		$options = array (
			\PDO::ATTR_PERSISTENT => true,
			\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION 
		);

		// Create a new PDO instanace
		try {
			$this->dbh = new \PDO ($dsn, $config['DB_USER'], $config['DB_PASS'], $options);
		}		
		catch ( \PDOException $e ) { // Catch any errors
			$this->error = $e->getMessage();
			die($this->error);
		}
	}
	
	// Prepare statement with query
	public function query($query) {
		$this->stmt = $this->dbh->prepare($query);
	}
	
	// Bind values
	public function bind($param, $value, $type = null) {
		if (is_null ($type)) {
			switch (true) {
				case is_int ($value) :
					$type = \PDO::PARAM_INT;
					break;
				case is_bool ($value) :
					$type = \PDO::PARAM_BOOL;
					break;
				case is_null ($value) :
					$type = \PDO::PARAM_NULL;
					break;
				default :
					$type = \PDO::PARAM_STR;
			}
		}
		$this->stmt->bindValue($param, $value, $type);
	}

	public function bindParams($params)
	{
		return $this->stmt->execute($params);
	}

	public function getSingle()
	{
		return $this->stmt->fetch(\PDO::FETCH_OBJ);
	}
	
	// Execute the prepared statement
	public function execute(){
		return $this->stmt->execute();
	}
	
	// Get result set as array of objects
	public function resultset(){
		$this->execute();
		return $this->stmt->fetchAll(\PDO::FETCH_OBJ);
	}
	
	// Get single record as object
	public function single(){
		$this->execute();
		return $this->stmt->fetch(\PDO::FETCH_OBJ);
	}
	
	// Get record row count
	public function rowCount(){
		return $this->stmt->rowCount();
	}
	
	// Returns the last inserted ID
	public function lastInsertId(){
		return $this->dbh->lastInsertId();
	}
}