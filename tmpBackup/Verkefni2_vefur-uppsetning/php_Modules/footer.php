<?php
	echo "<footer>";
	
		$startYear = 2016;
		$thisYear = date('Y');
		
		echo "<p>&copy ";
		if ($startYear == $thisYear)
		{
			echo $startYear;
		}
		else
		{
			echo $startYear . " - " . $thisYear;
		}
		echo "</p>";
		
		echo 
			"<p>VEF2A3U</p>" .
			"<p>Daníel Þór Þórisson</p>";
				
	echo "</footer>";
?>