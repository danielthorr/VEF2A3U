<?php

namespace File;
	
class Upload
{
	protected $uploaded = [];
	protected $destination;
	protected $max = 50 * 1024;
	protected $permitted = ['image/gif', 'image/jpeg', 'image/pjpeg', 'image/png'];
	
	public function __construct($path)
	{
		if (!is_dir($path) || !is_writable($path))
		{
			throw new \Exception("$path must be a valid, writable directory.");
		}
		
		$this->destination = $path;
	}
	
	public function upload()
	{
		$uploaded = current($_FILES);
		
		if ($this->checkFile($uploaded))
		{
			echo $this->checkFile($uploaded);
			$this->moveFile($uploaded);
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
		$success = move_uploaded_file($file['tmp_name'], $this->destination . $file['name']);
		
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