<?php

	class Validate{
		
		function test_input($data) {
		  $data = trim($data);
		  $data = stripslashes($data);
		  $data = htmlspecialchars($data);
		  $data = strtolower($data);
		  return $data;
		}
	}

	
?>