<?php session_start();
if(isset($_SESSION['username'])){
	header("location:/assignment/dashboard/");
}
unset($_SESSION['uName']);
unset($_SESSION['rstP']);
?>
<!DOCTYPE html>
<html>
<?php include '../head.php'; ?>
<div class="page">
<?php
include '../header.php';
if(isset($_POST['adminLogin'])) {
	$username = mysqli_real_escape_string($dBase, $_POST['username']);
	$pswd = mysqli_real_escape_string($dBase, $_POST['pswd']);
	$pswd = md5($pswd);

	$sql = "SELECT personalNumber,Username,Pswd,is_admin FROM employee WHERE Username = '$username' and Pswd = '$pswd'";
	$result = mysqli_query($dBase, $sql);
	$tab = mysqli_fetch_array($result);
	if(mysqli_num_rows($result) == 1) {
		$_SESSION['username'] = $tab['Username'];
		$_SESSION['isadmin'] = $tab['is_admin'];
		$_SESSION['sn'] = $tab['Pswd'];
		$_SESSION['tracker']=$tab['personalNumber'];
		if ($tab['is_admin']) {
			header("location:/assignment/admin/");
		} else {
			header('location:/assignment/dashboard/');
		}
		
	} else {?>
		<div class='record-success'><p>The Username or Password you entered is incorrect</p></div><?php
	}
}
?>
	<main>
		<form action="" method="POST" class="login-form">
			<h3 class="login-head">Admin</h3>
			<p class="login-inf">Please Enter your login details</p>
			<input type="text" name="username" placeholder="Username" class="login-input" autofocus required />
			<input type="password" name="pswd" placeholder="Password" class="login-input" required />
			<p class="forgot-pswd"><a href="/assignment/login/forgotpswd.php">Forgot Password?</a></p>
			<button type="submit" name="adminLogin" class="submit-btn login-btn">Login</button>
		</form>
	</main>
	<section class="footer-sec">
	<?php include '../footer.php'; ?>
	</section>
</div>
</html>