<?php

class Upload
{
	protected $uploaded = [];
	protected $destination;
	protected $max = 50 * 1024;
	protected $permitted = ['image/gif', 'image/jpeg', 'image/pjpeg', 'image/png'];
	
	protected $conn;
	
	public function __construct($path)
	{
		if (!is_dir($path) || !is_writable($path))
		{
			throw new \Exception("$path must be a valid, writable directory.");
		}
		
		$this->destination = $path;
	}
	
	
	public function Conn()
	{
		$source = 'mysql:host=tsuts.tskoli.is;dbname=0806933629_picturebase;';
		$user = '0806933629';
		$passw = 'letmein';

		// Sjá nánar um PDO t.d.: http://www.sitepoint.com/re-introducing-pdo-the-right-way-to-access-databases-in-php/ 
		try {
			$this->conn = new PDO($source, $user, $passw);   
			# Notum utf-8 og gerum það með SQL fyrirspurn exec sendir sql fyrirspurnir til database
			$this->conn->exec('SET NAMES "utf8"');

		} catch (PDOException $e) {
			echo 'Tenging mistókst: ' . $e->getMessage();
		}
	}
	
	public function upload($name, $description, $user)
	{
		$uploaded = current($_FILES);
		
		if ($this->checkFile($uploaded))
		{
			//echo $this->checkFile($uploaded);
			$this->moveFile($uploaded);
			
			$this->Conn();
			
			$mysqlCommands = new MysqlCommands($this->conn);
			$mysqlCommands->InsertImage($name, $this->destination, $description, $user);
		}
	}
	
	public function getMessages() 
	{
		return $this->messages;
	}
	
	protected function checkFile($file)
	{
		if ($file['error'] != 0)
		{
			$this->messages[] = "Error message: " . $file['error'];
			return false;
		}
		elseif (!in_array($file['type'], $this->permitted))
		{
			$this->messages[] = "Invalid file type.";
			return false;
		}
		elseif ($file['size'] > $this->max)
		{
			$this->messages[] = "File size exceeds upload limit.";
		}
		else
		{
			return true;
		}
	}
	
	protected function moveFile($file)
	{
		$temp = explode(".", $file['name']);
		$newFileName = round(microtime(true)) . '.' . end($temp);
		$success = move_uploaded_file($file['tmp_name'], $this->destination . $newFileName);
		
		if ($success)
		{
			$result = $file['name'] . ' was uploaded succesfully';
			$this->messages[] = $result;
		}
		else
		{
			$this->messages[] = 'Could not upload ' . $file['name'];
		}
	}
}
?>