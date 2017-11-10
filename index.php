<?php 
session_start();
require_once("system/includes.php");
	if($maintenance==true)
	{
		echo "Strona jest W trakcie budowy lub poprawek. Proszę wrócić póniej";
	}
	elseif($maintenance==false)
	{
		getPage();

	}
?>