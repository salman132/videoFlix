<?php

class VideoDetailsFormProvider{
	public function createUploadForm(){

		return "<form action='processing.php' method='post'>
					{$this->creatFileInput()}
					{$this->createTitleInput()}
					{$this->createDescripton()}
					{$this->createPrivacyInput()}
					{$this->createCategories()}
					{$this->createSubmit()}
				</form>";
	}

	private function creatFileInput(){
		 return '<div class="form-group">
					<label for="file">Your File</label>
					<input type="file" name="video" id="file" required="required" class="form-control">
				</div>';
	} 

	private function createTitleInput(){
		return '<div class="form-group">
					<label for="title">Title</label>
					<input type="text" name="title" id="title" class="form-control" class="form-control" placeholder="Title Name">
				</div>';
	}

	private function createDescripton(){
		return '<div class="form-group">
					<label for="description">Description</label>
					<textarea name="description" id="description" cols="30" rows="10" class="form-control"></textarea>
				</div>';
	}

	private function createPrivacyInput(){
		return '<div class="form-group">
		<label for="privacy">Post In</label>
			<select name="privacy" id="privacy" class="form-control">
				<option value="1">Public</option>
				<option value="2">Private</option>
			</select>
		</div>';
	}


	private function createCategories(){
		global $db;
		$sql = $db->connection->prepare("SELECT *FROM categories");
		$sql->execute();

		$html = '<div class="form-group">
		<label for="privacy">Post In</label>
			<select name="privacy" id="privacy" class="form-control">';

		while($row = $sql->fetch(PDO::FETCH_ASSOC)){
			$html .= "<option value='{$row['id']}'>". $row['name'] ."</option>";
			 
				
			
		}

		$html .= '</select>
		</div>';

		return $html;
	}


	private function createSubmit(){
		return '<div class="form-group">
					<input type="submit" value="Upload" name="upload" class="btn btn-primary">
				
				</div>';
	}





}
// .....End Of Class .......






?>



