<?php require_once("includes/header.php"); ?>

<?php
	if(!empty($session->msg)){
		echo "<script>
				toastr.success('{$session->msg}');
			</script>";
	}


?>

<div class="column">
	<form action='<?php echo htmlspecialchars("processing.php")?>' method='post' enctype='multipart/form-data'>
	    <div class="form-group">
	        <label for="file">Your File</label>
	        <input type="file" name="video" id="file" required="required" class="form-control">
	    </div>
	    
	    <div class="form-group">
	        <label for="title">Title</label>
	        <input type="text" name="title" id="title" class="form-control" class="form-control" placeholder="Title Name">
	    </div>
	    <div class="form-group">
	        <label for="description">Description</label>
	        <textarea name="description" id="description" cols="30" rows="10" class="form-control"></textarea>
	    </div>
	    <div class="form-group">
	        <label for="privacy">Post In</label>
	        <select name="privacy" id="privacy" class="form-control">
	            <option value="1">Public</option>
	            <option value="2">Private</option>
	        </select>
	    </div>
	    <div class="form-group">
	        <label for="categories">Select a Category</label>
	        <select name="category" id="categories" class="form-control">
	         	<?php
	         	
	         		$sql = $db->connection->prepare("SELECT *FROM categories");

	         		$sql->execute();

	         		while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
	         		
	         		?>
	         	
						<option value="<?php echo $row['id']; ?>"><?php  echo $row['name']  ?></option>

	         	<?php } ?>
	        </select>
	    </div>
	    <div class="form-group">
	        <input type="submit" value="Upload" name="upload" class="btn btn-primary">

	    </div>
	</form>

</div>







<?php require_once("includes/footer.php"); ?>
                