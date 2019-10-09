<?php



class videoUploadData extends DB_Object{
	protected static $db_table = "videos";
	protected static $db_fields = array('id','title','description','privacy','category','uploadedBy','filePath');

	public $title;
	public $description;
	public $privacy;
	public $category;
	public $uploadedBy;
	public $filePath;

	public $finalPath;
	

	public $targetDir ='uploads/videos/';
	public $tempPath;
	private $MaxFilesize = 500000000;
	public $msg;
	private $ffmpegPath = SITE_ROOT."/ffmpeg/bin/ffmpeg.exe";

	private static $allowedTypes = array('video/mp4','video/x-ms-wmv','video/flv','video/avi','video/3gp','video/webm','video/x-matroska','video/vob','video/mpeg','video/mpg','video/ogv','video/ogg');


	public function upload($files){
		

		$this->tempPath = $this->targetDir.time().basename($files['name']);

		$this->tempPath = str_replace(" ", "_", $this->tempPath);
		


		return $validData = $this->processData($files,$this->tempPath);

		

	}
	

	private function processData($files,$tempPath){
		$videoType = pathinfo($tempPath,PATHINFO_EXTENSION);

		if($this->isvalidSize($files) && 
			$this->isValidType($files['type']) && 
			$this->hasNoError($files['error'])
			
		){

			if(move_uploaded_file($files['tmp_name'],$tempPath)){
				$this->msg = "Your Video Uploaded Successfully";

				if($files['type'] == 'video/mp4'){
					return true;
				}
				else{
					$this->isMp4($files);
					$this->filePath = $this->finalPath;
					unlink($tempPath);
					return true;
				}
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

			echo "The video format must be any of this ".$type;

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

	public function convertVideo($tempPath,$finalPath){
		
		$cmd = "$this->ffmpegPath -i $tempPath $finalPath 2>&1"; 
		
		


		$outputLog = array();

		exec($cmd,$outputLog, $returnCode);

		if($returnCode !=0){
			foreach ($outputLog as $line) {
				echo $line . "<br>";
			}
			return false;
		}
		return true;

	}

	public function isMp4($file){
		if($file['type'] == 'video/mp4'){
			return true;
		}
		else{
			$this->finalPath = $this->targetDir.time().".mp4";
			$this->convertVideo($this->tempPath,$this->finalPath);
			$this->tempPath = $this->finalPath;
			
		}
	}




}






$videoUploadData = new videoUploadData();









?>