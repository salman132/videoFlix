<?php


class videoUploadData{
	public $title;
	public $description;
	public $privacy;
	public $category;
	public $uploadedBy;
	public $filetype;
	private $MaxFilesize = 500000000;
	public $msg;
	private static $allowedTypes = array('video/mp4','video/wmv','video/flv','video/avi','video/3gp','video/webm','video/mkv','video/vob','video/mpeg','video/mpg','video/ogv','video/ogg');


	public function upload($files){
		$targetDir = 'uploads/videos/';

		$tempPath = $targetDir.time().basename($files['name']);

		$tempPath = str_replace(" ", "_", $tempPath);

		$validData = $this->processData($files,$tempPath) ;

		

	}

	private function processData($files,$tempPath){
		$videoType = pathinfo($tempPath,PATHINFO_EXTENSION);

		if($this->isvalidSize($files) && 
			$this->isValidType($files['type']) && 
			$this->hasNoError($files['error'])){

			if(move_uploaded_file($files['tmp_name'],$tempPath)){
				$this->msg = "Your Video Uploaded Successfully";
				return true;
			}
			else{
				$this->msg="Something Went Wrong.Upload again";
				return false;
			}

		}
		else{
			echo "Unsuccessfull attempt";
			return false;
		}

	}

	private function isvalidSize($files){
		if($files['size']<=$this->MaxFilesize){
			return true;
		}
		else{
			echo "File is to Large. Can't be more than ".$this->MaxFilesize;
			return false;
		}

	}

	private function isValidType($files){
		$lowercase = strtolower($files);




		if(in_array($lowercase, static::$allowedTypes)){
			return true;
		}
		else{
			$types = implode(",", static::$allowedTypes);
			$type = str_replace("/",".", $types);

			echo "The video format must be any of this Example".$type;

			return false;
		}


	}

	private function hasNoError($error){
		if($error == 0){
			return true;
		}
		else{
			echo "File wasn't properly uploaded";
			return false;
		}
	}




}
















?>