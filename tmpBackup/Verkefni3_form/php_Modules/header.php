<?php

	
	/*echo "<header>" .
		"<div id='menuBtnContainer'>" .
			"<a href='#' class='menuBtn'><p>Home</p></a>" .
			"<a href='#' class='menuBtn'><p>Page 1</p></a>" .
			"<a href='#' class='menuBtn'><p>Page 2</p></a>" .
		"</div>" .
	"</header>"*/
	
	function CreateHeader(array $btnNames, array $btnLinks)
	{
		$btnCount = Count($btnNames);
		
		echo "<header>" .
			"<div id='menuBtnContainer'>";
			
		for ($i = 0; $i < $btnCount; $i++)
		{
			echo "<a href='$btnLinks[$i]' class='menuBtn' style='width:100%/$btnCount;'><p>$btnNames[$i]</p></a>";
		}
		
		echo "</div>" .
			"</header>";
	}
?>