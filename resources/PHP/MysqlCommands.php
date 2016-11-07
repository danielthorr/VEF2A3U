<?php
	class MysqlCommands	
	{
		private $connection;
		
		public function __construct($connection_name)
		{
			
			if(!empty($connection_name)){

				$this->connection = $connection_name;
			}
			else{
				throw new Exception("cant connect to database");
			}
		}
		
		public function StoreTokenForUser($userName, $tmpToken)
		{
			try
			{
				//$sqlCommand = "INSERT INTO users(logInToken) VALUES ('$tmpToken') WHERE userName = '$userName'";
				
				$this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				
				$statement = $this->connection->prepare("UPDATE users SET logInToken='$tmpToken' WHERE userName='$userName'");
				
				$statement->execute();
				
				echo $statement->rowCount() . " records UPDATED successfully";
			}
			catch(PDOException $e)
			{
				echo "<br/>Error: " . $e->getMessage() . "<br/>";
			}
		}
		
		public function FetchTokenByUserName($userName)
		{
			$statement = $this->connection->query("SELECT logInToken FROM users WHERE userName='$userName'");
			
			$row = $statement->fetchObject();
			return $row->logInToken;
		}
	}
?>