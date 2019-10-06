<?php
require_once('includes/header.php');


$msg = "";

if(isset($_POST['login'])){
	$error = array();

	$user = new User();
	$user->name = cleanInput($_POST['name']);
	$user->email = cleanInput($_POST['email']);
	if(User::user_exist($user->email)){
		$msg = $error['ex'] = "<div class='text-danger'>This email is already exist</div>"; 
	}
	User::valid_email($user->email);
	$user->password = bcrypt($_POST['password']);

	




	if(count($error)==0){

		$imageUpload->imageCheck = getimagesize($_FILES['image']['tmp_name']);
		$imageUpload->upload($_FILES['image']);
		$user->image = $imageUpload->imageLink;
			
		if($user->create()){
		Session::flush("You Registered Succefully");
		redirect("login.php");
		die();
		}
	}

	
}


if($session->is_signed_in()){
	redirect("index.php");
	die("Hacker' it's not your day");
}


?>






<div class="my-box">
	<div class="form-box">
		<div class="text-primary">
			<h4>Login</h4>
			<?php echo $msg; ?>
		</div>

		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
				<div class="form-group">
					<label>Name: </label>
					<input type="text" name="name" placeholder="name" class="form-control" required="required">
				</div>
                <div class="form-group">
                	<label>Email: </label>
                    <input type="email" name="email" placeholder="Email" class="form-control" required="required">
                </div>
                <div class="form-group">
                	<label>Password: </label>
                    <input type="password" name="password" placeholder="Password" class="form-control" required="required">
                </div>
                <div class="form-group">
                	<label>Profile Picture: </label>
                	<input type="file" name="image" required="required">
                </div>
                <div class="form-group">
                    <input type="submit" value="Sign Up" name="login" class="btn btn-primary">
                </div>
        </form>
	</div>
</div>






<?php  require_once('includes/footer.php'); ?>




