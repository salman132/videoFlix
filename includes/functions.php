<?php


function cleanInput($input){
	trim($input);
	htmlspecialchars($input);

	return $input;
}


function redirect($string){
	header("location: {$string}");
}




?>