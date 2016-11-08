<?php

class Book
{	
	public $titill;
	public $verd;
	
	function __construct($tmpTitle, $tmpPrice)
	{
		$this->titill = $this->setTitle($tmpTitle);
		$this->verd = $this->setPrice($tmpPrice);
	}
	
	function setPrice($number)
	{
		return number_format($number, 0, ',', '.');
	}
	
	function getPrice()
	{
		return $this->verd;
	}
	
	function setTitle($title)
	{
		return ucwords($title);
	}
	
	function getTitle()
	{
		return $this->titill;
	}
}

class ExtBook extends Book
{
	public $publisher;
	
	function __construct($tmpTitle, $tmpPrice, $tmpPublisher)
	{
		parent::__construct($tmpTitle, $tmpPrice);
		$this->publisher = $this->setPublisher($tmpPublisher);
	}
	
	function setPublisher($publisher)
	{
		return ucwords($publisher);
	}
	
	function getPublisher()
	{
		return $this->publisher;
	}
}


?>