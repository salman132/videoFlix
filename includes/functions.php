<?php




function cleanInput($input){
	
	$input = htmlspecialchars($input);

	return $input;
}


function redirect($string){
	header("location: {$string}");
}

function bcrypt($pass){
	$string = sha1("1>Az@?<zP*)^!");

	return sha1(md5($pass.$string));
}




?>