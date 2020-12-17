<?php 
	session_start();
	if (isset($_SESSION['employee'])) {
		header("location:/assignment/view.php");
	}
?>
<!DOCTYPE html>
<html>
<?php include 'head.php'; ?>
<div class="page">
<?php
include "header.php";

if(isset($_POST['submit-btn'])) {
	$firstName = mysqli_real_escape_string($dBase,$_POST['first-name']);
	$middleName = mysqli_real_escape_string($dBase,$_POST['middle-name']);
	$surname = mysqli_real_escape_string($dBase,$_POST['surname']);
	$email = mysqli_real_escape_string($dBase,$_POST['email']);
	$dob = mysqli_real_escape_string($dBase, $_POST['DOB']);
	$username = mysqli_real_escape_string($dBase,$_POST['username']);
	$state = mysqli_real_escape_string($dBase,$_POST['state']);
	$lga = mysqli_real_escape_string($dBase,$_POST['lga']);
	$amount = mysqli_real_escape_string($dBase,$_POST['amount']);
	$sal_id=mysqli_real_escape_string($dBase,$_POST['salary']);
	$rank = mysqli_real_escape_string($dBase,$_POST['rank']);
	$password = mysqli_real_escape_string($dBase,$_POST['password']);
	$retype = mysqli_real_escape_string($dBase,$_POST['retype']);
	$password = md5($password);
	$retype = md5($retype);
	
	$target_dir = "images/mem-img/";
	$target_file = $target_dir . basename($_FILES["photo"]["name"]);
	$uploadOk = 1;
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
	$img = mysqli_real_escape_string($dBase, "/assignment/".$target_file);
  
  $check = getimagesize($_FILES['photo']["tmp_name"]);
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
  /*if ($_FILES['photo']['size'] > 500000) {?>
	  <div class="record-succeess">
		  <p>Maximum file size exceeded</p>
	  </div><?php
    $uploadOk = 0;
  }*/
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
    if (!move_uploaded_file($_FILES['photo']['tmp_name'], $target_file)) {?>
		<div class="record-success">
			<p>Your photo was not uploaded</p>
		</div><?php
    }

	if ($password !== $retype) {?>
		<div class="record-success">
			<p>Passwords do not match</p>
		</div><?php
	} else {
		$sql = "INSERT INTO employee(firstName, middleName, Surname, Email, DOB, Username, State, LGA, Amount,salary_id, rank, img, Pswd) VALUES('$firstName', '$middleName', '$surname', '$email', '$dob', '$username', '$state', '$lga', '$amount', '$sal_id', '$rank', '$img', '$password')";
		if(mysqli_query($dBase, $sql)) {?>
			<div class='record-success'>
				<h3 class='review-header'>Record has been stored successfully</h3>
				<p>Name: <?php echo $firstName." ".$middleName." ".$surname;?></p>
				<p>Email: <?php echo $email;?></p>
				<p>Date of Birth: <?php echo $dob;?></p>
				<p>State: <?php echo $state;?></p>
				<p>LGA: <?php echo $lga;?></p>
				<p>Rank: <?php echo $rank;?>
			</div><?php
		}else{
			echo "<div class='record-success'><p>ERROR: failed to store record $sql".mysqli_error($dBase)."</p></div>";
		}
	}
}

	
}
?>
<main>
	<!--Form Area-->
	<form action="" method="post" id="form" class="reg-form" enctype="multipart/form-data">
	<h3 class="form-header">Please fill the form below</h3>
		<div class="grid">
			<div>
				<label for="first-name" class="reg-label">First Name</label>
				<input type="text" name="first-name" class="reg-input" required />
			</div>
			<div>
				<label for="middle-name" class="reg-label">Middle Name</label>
				<input type="text" name="middle-name" class="reg-input" />
			</div>
			<div>
				<label for="surname" class="reg-label">Surname</label>
				<input type="text" name="surname" class="reg-input" required />
			</div>
			<div>
				<label for="DOB" class="reg-label">Date of Birth</label>
				<input type="date" name="DOB" class="reg-input" required />
			</div>
			<div>
				<label for="email" class="reg-label">Email</label>
				<input type="email" name="email" class="reg-input" required />
			</div>
			<div>
				<label for="Username" class="reg-label">Username</label>
				<input type="text" name="username" class="reg-input" required />
			</div>
			<div>
				<label for="state" class="reg-label">State</label>
				<input type="text" name="state" class="reg-input" required />
			</div>
			<div>
				<label for="lga" class="reg-label">Local Gov't Area</label>
				<input type="text" name="lga" class="reg-input" required />
			</div>
			<div>
				<label for="amount" class="reg-label">Amount</label>
				<input type="number" name="amount" class="reg-input" required />
			</div>
			<div>
				<label for="rank" class="reg-label">Rank</label>
				<input type="text" name="rank" class="reg-input" required />
			</div>
			<div>
				<label for="salary" class="reg-label"></label>
				<select name="salary" id="salary" class="reg-input">
					<option value="" selected disabled>Salary Category</option>
					<option value="1">Category A</option>
					<option value="2">Category B</option>
					<option value="3">Category C</option>
				</select>
			</div>
			<div>
				<label for="password" class="reg-label">Password</label>
				<input type="password" name="password" class="reg-input" required />
			</div>
			<div>
				<label for="retype" class="reg-label">Retype Password</label>
				<input type="password" name="retype" class="reg-input" required />
			</div>
			<div>
				<label for="image" class="reg-label">Upload Photograph</label>
				<input type="file" name="photo" class="reg-input" required />
			</div>
			<div>
				<input type="hidden" name="rank" id="rank" class="reg-input" value="Academic" />
			</div>
		</div>
		<button type="submit" name="submit-btn" class="submit-btn">Register Now</button>
	</form>
</main>
<section class="footer-sec">
<?php
include "footer.php";
?>
</section>
</div> 
</html>