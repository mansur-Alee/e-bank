<?php
session_start();
?>
<!DOCTYPE html>
<html>
<?php include 'head.php'; ?>
<div class="page">
<?php 
include 'header.php';
	
	$id = $_REQUEST['id'];
	if(!isset($id)){
		header("location:/assignment/memberslist.php");
	}
	$sq1 = "SELECT * FROM employee where ID = '$id'";
	$result = mysqli_query($dBase, $sq1);
	$tab = mysqli_fetch_array($result);

if(isset($_POST['update-btn'])){
	$newName = mysqli_real_escape_string($dBase, $_POST['newName']);
	$newMiddleName = mysqli_real_escape_string($dBase, $_POST['newMiddleName']);
	$newSurname = mysqli_real_escape_string($dBase, $_POST['newSurname']);
	//$newDob = mysqli_real_escape_string($dBase, $_POST['DOB']);
	$newEmail = mysqli_real_escape_string($dBase, $_POST['newEmail']);
	$newUsername = mysqli_real_escape_string($dBase, $_POST['username']);
	$newState = mysqli_real_escape_string($dBase, $_POST['newState']);
	$newLGA = mysqli_real_escape_string($dBase, $_POST['newLGA']);
	$newAmount = mysqli_real_escape_string($dBase, $_POST['newAmount']);
	$newRank = mysqli_real_escape_string($dBase, $_POST['rank']);
	//$pswd = mysqli_real_escape_string($dBase, $_POST['password']);
	//$repswd = mysqli_real_escape_string($dBase, $_POST['retype']);
	//$pswd = md5($pswd);	
	//$repswd = md5($repswd);
	/*$target_dir = "images/mem-img/";
	$target_file = $target_dir . basename($_FILES["mem-img"]["name"]);
	$uploadOk = 1;
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
	$img = mysqli_real_escape_string($dBase, "/assignment/".$target_file);
  
  $check = getimagesize($_FILES['mem-img']["tmp_name"]);
  if ($check !== false) {
    $uploadOk = 1;
  }else {
    $uploadOk = 0;
  }
  if (file_exists($target_file)) {?>
	  <div class="record-success">
		  <p>File already exists</p>
	  </div><?php
    $uploadOk= 0;
  }
  /*if ($_FILES['mem-img']['size'] > 500000) {?>
	  <div class="record-succeess">
		  <p>Maximum file size exceeded</p>
	  </div><?php
    $uploadOk = 0;
  }
  if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {?>
	  <div>
		  <p>File type has to be <b>jpg, jpeg, or png</b></p>
	  </div><?php
    $uploadOk = 0;
  }
  if($uploadOk == 0){?>
	  <div class="recored-success">
		  <p>We couldn't upload your photo</p>
	  </div><?php
  }else {
    if (move_uploaded_file($_FILES['mem-img']['tmp_name'], $target_file)) {
      $sql = "UPDATE employee SET  WHERE ID='$id'";
      mysqli_query($dBase,$sql);
    }
  }*/
  $sql = "UPDATE employee SET firstName='$newName', middleName='$newMiddleName', Surname='$newSurname', Email='$newEmail', Username='$newUsername', State='$newState', LGA='$newLGA', Amount='$newAmount', rank='$newRank' WHERE ID='$id'";
  if (mysqli_query($dBase, $sql)) {
	  header("location:/assignment/memberslist.php");
  }
}
?>
<main>
<form action="" method="post" id="form" class="reg-form" enctype="multipart/form-data">
	<h3 class="form-header">What are you editing?</h3>
		<div class="grid">
			<div>
				<label for="newName" class="reg-label">First Name</label>
				<input type="text" name="newName" class="reg-input" value="<?php echo $tab['firstName']; ?>" />
			</div>
			<div>
				<label for="middle-name" class="reg-label">Middle Name</label>
				<input type="text" name="newMiddleName" class="reg-input" value="<?php echo $tab['middleName'];?>" />
			</div>
			<div>
				<label for="surname" class="reg-label">Surname</label>
				<input type="text" name="newSurname" class="reg-input" value="<?php echo $tab['Surname']?>" />
			</div>
			<div>
				<label for="newEmail" class="reg-label">Email</label>
				<input type="email" name="newEmail" class="reg-input" value="<?php echo $tab['Email'];?>" />
			</div>
			<!--<div>
				<label for="DOB" class="reg-label">Date of Birth</label>
				<input type="date" name="DOB" class="reg-input" value="<?php echo $tab['DOB'];?>" />
			</div>-->
			<div>
				<label for="Username" class="reg-label">Username</label>
				<input type="text" name="username" class="reg-input" value="<?php echo $tab['Username'];?>" />
			</div>
			<div>
				<label for="newState" class="reg-label">State</label>
				<input type="text" name="newState" class="reg-input" value="<?php echo $tab['State'];?>" />
			</div>
			<div>
				<label for="newLGA" class="reg-label">Local Gov't Area</label>
				<input type="text" name="newLGA" class="reg-input" value="<?php echo $tab['LGA'];?>" />
			</div>
			<div>
				<label for="newAmount" class="reg-label">Amount</label>
				<input type="number" name="newAmount" class="reg-input" value="<?php echo $tab['Amount'];?>" />
			</div>
			<div>
				<label for="rank" class="reg-label">Rank</label>
				<input type="text" name="rank" class="reg-input" value="<?php echo $tab['rank'];?>" />
			</div>
			<!--<div>
				<label for="img" class="reg-label">Profile Photo</label>
				<input type="file" name="mem-img" class="reg-input" required />
			</div>-->
			<div>
				<label for="salary_id" class="reg-label">Salary ID</label>
				<input type="number" name="salary_id" id="salary_id" class="reg-input" value="<?php echo $tab['salary_id']; ?>" required />
			</div>
		</div>
		<button type="submit" name="update-btn" id="update-btn" class="submit-btn">Update Record</button>
	</form>
</main>
<section class="footer-sec">
<?php include 'footer.php';?>
</section>
</div>
</html>