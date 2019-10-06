<?php
require_once('includes/header.php');


$msg = "";


if(!empty($session->msg)){
	echo "<script>
			toastr.success('{$session->msg}');
		</script>";


}





if(isset($_POST['login'])){
	$user = new User();
	$user->email = cleanInput($_POST['email']);
	$user->password = bcrypt($_POST['password']);

	
	$user_found = User::verify_user($user->email,$user->password);
	if($user_found){
		$session->login($user_found);
		redirect("index.php");
	}
	else{
		$msg = "<div class='text-danger'>Email or Password is incorrent</div>";

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

		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <div class="form-group">
                    <input type="text" name="email" placeholder="Email" class="form-control">
                </div>
                <div class="form-group">
                    <input type="password" name="password" placeholder="Password" class="form-control">
                </div>
                <div class="form-group">
                    <input type="submit" value="login" name="login" class="btn btn-primary">
                </div>
        </form>
	</div>
</div>






<?php  require_once('includes/footer.php'); ?>




