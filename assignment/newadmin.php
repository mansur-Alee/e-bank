<?php
	session_start();
	if($_SESSION['isadmin'] != 1){
		header('location:/assignment/dashboard');
	}
?>
<!DOCTYPE html>
<html>
<?php include 'head.php'; ?>
<div class='page'>
<?php
	include 'header.php';
?>
	<main>
	<?php
		//include 'db.php';
		$name = $username = $pswd = "";
		if(isset($_POST['btn'])){
		$name = mysqli_real_escape_string($dBase, $_POST['name']);
		$username = mysqli_real_escape_string($dBase, $_POST['username']);
		$pswd = mysqli_real_escape_string($dBase, $_POST['pswd']);
		$repswd = mysqli_real_escape_string($dBase, $_POST['retype-pswd']);
		$pswd = md5($pswd);
		$repswd = md5($repswd);

		if($pswd === $repswd){
			$sql = "INSERT INTO admins(Name, Username, Password) VALUES('$name', '$username', '$pswd')";
	
			if(mysqli_query($dBase, $sql)){?>
				<div class='record-success'>
					<p>User Added Successfully!</p>
				</div><?php
			}else{
				echo mysqli_error($dBase);
			}
		} else {?>
			<div class='record-success'>
				<p>Passwords do not match!</p>
			</div><?php
		}
		}
		?>
		<form method="POST" class="login-form">
			<h3 class="login-head">New User</h3>
			<p class="login-inf">Fill in User Details</p>
			<div class='grid'>
				<div>
					<input name="name" type="text" placeholder='Name' class='login-input' required/>
				</div>
				<div>
					<input type="text" name="username" placeholder="Username" class="login-input" required />
				</div>
				<div>
					<input type="password" name="pswd" placeholder="Password" class="login-input" required />
				</div>
				<div>
					<input type="password" name="retype-pswd" placeholder="Retype Password" class="login-input" required />
				</div>
			</div>
				<button type="submit" name="btn" class="submit-btn">Add User</button>
		</form>	
	</main>
	<section class='footer-sec'>
	<?php
		include 'footer.php'
	?>
	</section>
</div>
</html>