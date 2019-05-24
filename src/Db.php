<?php
	namespace GoMovil;
	/**
	 * Db class
	 *
	 * @author			Daniel Rinaldi <daniuf@gmail.com>
	 * @version 		1.0
	 * 
	 */
	class Db
	{
		private $dsn;
		private $error;
		private $errorMessage;
		private $password;
		private $pdo;
		private $schema;
		private $username;
		private $dbh;

		public function __construct()
		{
			$this->error = false;
		}

		public function connect()
		{
				try {
					$this->dbh = new \PDO($this->dsn, $this->username, $this->password);
				} catch (\PDOException $e) {
					$this->error = true;
					$this->errorMessage .= ' || eCode: '.$e->getCode().'; eMessage: '.$e->getMessage();
				}
		}
			
		public function getErrorMessage()
		{
			$this->errorMessage = '';
		}

		public function prepare( $statement, $options = array() )
		{
			try {
				$this->sth = $this->dbh->prepare( $statement, $options);
			} catch (Exception $ex) {
				$this->errorMessage .= ' || '.$ex->getMessage();
			}
		}

		public function execute( $input_parameters = array() )
		{
			if($this->sth->execute() === false)
			{
				$this->error = true;
			}
		}

		public function fetch( $fetchStyle = \PDO::FETCH_ASSOC, $cursorOrientation = 0, $cursorOffset = 0)
		{
			$this->result = $this->sth->fetch($fetchStyle, $cursorOrientation, $cursorOffset);
			
			return $this->result;
		}
			
		public function fetchAll( $fetchStyle = \PDO::FETCH_ASSOC)
		{
			$this->result = $this->sth->fetchAll($fetchStyle);
			
			return $this->result;
		}
		
		public function rowCount()
		{
			return $this->sth->rowCount();	
		}

		public function beginTran( )
		{
			return $this->dbh->beginTransaction();
		}

		public function commit( )
		{
			return $this->dbh->commit();
		}

		public function rollBack()
		{
			$this->dbh->rollBack();
		}

		public function lastInsertedId()
		{
			return $this->dbh->lastInsertId();
		}

		public function setDsn( $dsn )
		{
			$this->dsn = $dsn;
		}

		public function setUsername( $username )
		{
			$this->username = $username;
		}

		public function setPassword( $password )
		{
			$this->password = $password;
		}

		public function getError()
		{
			return $this->error;
		}
	}
