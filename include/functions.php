<?php

/**
 * Social Codia
 */
class Functions
{

	function haveEmptyParameter($param)
	{
		if (isset($param)) 
		{
			if (empty($param)) 
			{
				return true;
			}
		}
		return false;
	}
		

	 function checkLength($param,$minLength,$maxLength)
	 {
	 	if (strlen($param)<$minLength || strlen($param)>$maxLength) {
	 		return true;
	 	}
	 	return false;
	 }

}


?>
