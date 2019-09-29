<?php
require_once('includes/header.php');

if(isset($_POST['upload'])){

	$videoUploadData = new videoUploadData();
	
	$videoUploadData->upload($_FILES['video']);
	$videoUploadData->title = cleanInput($_POST['title']);
	$videoUploadData->description = cleanInput($_POST['description']);
	$videoUploadData->privacy = cleanInput((int)$_POST['privacy']);
	$videoUploadData->category = cleanInput((int)$_POST['category']);
	$videoUploadData->uploadedBy = cleanInput((int)1);


	Session::flush($videoUploadData->msg);  

	
	redirect('upload.php');
	

	

	

	




}
else{
	// redirect("index.php");
	// die("Hacker it's not your day");
}















?>