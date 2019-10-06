<?php
class imageUpload{
	private $imageMaxSize=2500000;
	private static $allowedFormat = array('image/jpg','image/jpeg','image/png');
	private $target_dir="uploads/profile/";
	public $msg;
	public $imageCheck;
	public $imageLink;

	public function upload($files){
		
		$temp_path = $this->target_dir.time().basename($files['name']);
		$temp_path = str_replace(" ","_", $temp_path);
		$this->imageLink = $temp_path;

		return $this->processData($files,$temp_path);
	}

	private function processData($files,$temp_path){
		$imgType = pathinfo($temp_path,PATHINFO_EXTENSION);

		if($this->validSize($files['size'])
			&& $this->isValidFormat($files['type'])
			&& $this->hasNoError($files['error'])
			&& $this->isImage()){

			if(move_uploaded_file($files['tmp_name'], $temp_path)){
				$this->msg = "Your Image Uploaded Successfully";
				return true;
			}
			else{
				$this->msg="Something Went Wrong.Upload again";
				return false;
			}

		}
		else{

			$this->msg = "Upload Unsuccessful due to error";
			return false;

		}

	}

	private function validSize($files){
		if($files<=$this->imageMaxSize){
			return true;
		}
		else{
			echo "Image size can not be more than " .$this->imageMaxSize;
		}
	}
	private function isValidFormat($files){
		$files = strtolower($files);

		if(in_array($files, static::$allowedFormat)){
			return true;
		}
		else{
			$types = implode(",", static::$allowedFormat);
			$type = str_replace("/",".", $types);

			echo "The video format must be any of this Example".$type;

			return false;
		}

	}

	private function hasNoError($file){
		if($file == 0){
			return true;
		}
		else{
			echo "File wasn't Properly Uploaded";
			return false;
		}
	}

	private function isImage(){
		if(in_array($this->imageCheck['mime'],static::$allowedFormat)){
			return true;
		}
		else{
			echo "This is not an Image.";
			return false;
		}
	}





}

$imageUpload = new imageUpload();



?>