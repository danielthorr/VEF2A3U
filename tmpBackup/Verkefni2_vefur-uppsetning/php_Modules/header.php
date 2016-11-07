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
		$currPage = basename($_SERVER['SCRIPT_FILENAME']);
		$btnCount = Count($btnNames);
		
		echo "<header>" .
			"<div id='menuBtnContainer'>";
			
		for ($i = 0; $i < $btnCount; $i++)
		{
			if ($currPage == $btnLinks[$i])
			{
				$insertColor = "background-color:#365070; border: 2px solid #4480c8;";
			}
			else
			{
				$insertColor = "";
			}
			echo "<a href='$btnLinks[$i]' class='menuBtn' style='$insertColor width:100%/$btnCount;'><p>$btnNames[$i]</p></a>";
		}
		
		echo "</div>" .
			"</header>";
	}
?>