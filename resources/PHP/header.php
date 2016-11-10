<?php

	
	/*echo "<header>" .
		"<div id='menuBtnContainer'>" .
			"<a href='#' class='menuBtn'><p>Home</p></a>" .
			"<a href='#' class='menuBtn'><p>Page 1</p></a>" .
			"<a href='#' class='menuBtn'><p>Page 2</p></a>" .
		"</div>" .
	"</header>"*/
		$btnCount = Count($pageNames);
		
		echo "<header>" .
			"<div id='menuBtnContainer'>";
			
		for ($i = 0; $i < $btnCount; $i++)
		{
			echo "<a href='$pages[$i]' class='menuBtn' style='width:100%/$btnCount;'>$pageNames[$i]</a>";
		}
		
		echo "</div>" .
			"</header>";
			
			
?>