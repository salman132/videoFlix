<?php
require_once('includes/header.php');


if(isset($_POST['upload'])){

	// $videoUploadData = new videoUploadData();
	
	$videoUploadData->upload($_FILES['video']);
	$videoUploadData->uploadBy = $_SESSION['user_id'];
	$videoUploadData->filePath = $videoUploadData->getVideoPath();;
	$videoUploadData->title = cleanInput($_POST['title']);
	$videoUploadData->description = cleanInput($_POST['description']) ? : 1;
	$videoUploadData->privacy = cleanInput((int)$_POST['privacy']) ? : 1;
	$videoUploadData->category = cleanInput((int)$_POST['category']) ? : 1;
	$videoUploadData->uploadedBy = $_SESSION['user_id'];


	if($videoUploadData->create()){
		Session::flush($videoUploadData->msg);  
	}

	
	redirect('upload.php');


	$videoUploadData->category = (int)$_POST['category'];
	

	

	

	




}
else{
	// redirect("index.php");
	// die("Hacker it's not your day");
}















?>