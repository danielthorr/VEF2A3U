<?php
	class MysqlCommands	
	{
		private $connection;
		
		public function __construct($connection_name)
		{
			if(!empty($connection_name)){

				$this->connection = $connection_name;
				$this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			}
			else{
				throw new Exception("cant connect to database");
			}
		}
		
		public function StoreTokenForUser($userName, $tmpToken)
		{
			try
			{
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
			try
			{
				$statement = $this->connection->query("SELECT logInToken FROM users WHERE userName='$userName'");
				
				$row = $statement->fetchObject();
			}
			catch (PDOException $e)
			{
				echo "<br/>Error: " . $e->getMessage() . "<br/>";
			}
			
			return $row->logInToken;
		}
		
		public function InsertImage($name, $path, $description, $user)
		{
			try
			{
				$statement = $this->connection->query("SELECT userID FROM users WHERE userName='$user'");
				
				$row = $statement->fetchObject();
			}
			catch (PDOException $e)
			{
				echo "<br/>Error: " . $e->getMessage() . "<br/>";
			}
			
			try
			{
				$statement = $this->connection->query
				(
					"INSERT INTO 
					images(imageName, imagePath, imageText, categoryID, ownerID) 
					VALUES('$name', '$path', '$description', null, '" . $row->userID . "')"
				);
			}
			catch (PDOException $e)
			{
				echo "<br/>Error: " . $e->getMessage() . "<br/>";
			}
		}
		
		public function GetImages($user = "")
		{
			$counter = 0;
			$returnArray = array();
			try
			{
				if (isset($user) && !empty($user))
				{
					$statement = 
					(
						"SELECT * 
						FROM images 
						WHERE ownerID = 
						(SELECT userID 
						FROM users 
						WHERE userName = '$user')
						ORDER BY uploadDate DESC"
					);
					$temp = array();
					foreach($this->connection->query($statement) as $row)
					{
						$returnArray[$counter][0] = $row['imageID'];
						$returnArray[$counter][1] = $row['imageName'];
						$returnArray[$counter][2] = $row['imagePath'];
						$returnArray[$counter][3] = $row['imageText'];
						$returnArray[$counter][4] = $row['ownerID'];
						$returnArray[$counter][5] = $row['uploadDate'];
						$counter++;
					}
					array_push($returnArray, $temp);
				}
				
				$statement = "SELECT * FROM images WHERE ownerID != (SELECT userID FROM users WHERE userName = '$user') GROUP BY ownerID ORDER BY uploadDate";
				foreach ($this->connection->query($statement) as $row)
				{
					$returnArray[$counter][0] = $row['imageID'];
					$returnArray[$counter][1] = $row['imageName'];
					$returnArray[$counter][2] = $row['imagePath'];
					$returnArray[$counter][3] = $row['imageText'];
					$returnArray[$counter][4] = $row['ownerID'];
					$returnArray[$counter][5] = $row['uploadDate'];
					$counter++;
				}
			}
			catch (PDOException $e)
			{
				echo "<br/>Error: " . $e->getMessage() . "<br/>";
			}
			
			return $returnArray;
		}
	}
?>