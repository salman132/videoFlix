<?php
require_once('includes/header.php');


if(isset($_POST['upload'])){

	// $videoUploadData = new videoUploadData();
	// print_r($_FILES['video']);
	// die();
	
	$videoUploadData->upload($_FILES['video']);
	$videoUploadData->uploadBy = $_SESSION['user_id'];
	$videoUploadData->filePath = $videoUploadData->tempPath;
	$videoUploadData->title = cleanInput($_POST['title']);
	$videoUploadData->description = cleanInput($_POST['description']) ? : 1;
	$videoUploadData->privacy = cleanInput((int)$_POST['privacy']) ? : 1;
	$videoUploadData->category = cleanInput((int)$_POST['category']) ? : 1;
	$videoUploadData->uploadedBy = $_SESSION['user_id'];


	if($videoUploadData->create()){
		Session::flush($videoUploadData->msg);  
	}

	
	redirect('upload.php');


	
	

	

	

	




}
else{
	// redirect("index.php");
	// die("Hacker it's not your day");
}















?>