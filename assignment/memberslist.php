<?php session_start();?>
<!DOCTYPE html>
<html>
<?php include 'head.php'; ?>
<?php
if(!isset($_SESSION['username'])){
	header('location:/assignment/login');
}
?>
<div class="page">
<?php
include "header.php";
?>
	<main>
<?php
//include '/assignment/db.php';
include 'functions.php';
$sql = "SELECT * FROM employee ORDER BY firstName ASC";
$result = mysqli_query($dBase, $sql);
?>
	<div class="search-bar">
	<input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for names.." title="Type in a name" class="search-bar" />
	</div>
	<!--<button class="actions-button add-user"><a href="/assignment/newadmin.php">Add User</a></button>-->
	<table id="myTable">
		<tr>
			<th>S/N</th>
			<th>Name</th>
			<th>Email</th>
			<th>State</th>
			<th>Rank</th>
			<th>Action</th>
		</tr>
	<?php
	$sn = 1;
	if (mysqli_num_rows($result) > 0) {
		while($row = mysqli_fetch_assoc($result)) {?>
			<tr>
				<td><?php echo $sn++?></td>
				<td><?php echo $row['firstName']." ".$row['middleName']." ".$row['Surname']; ?></td>
				<td><?php echo $row['Email'];?></td>
				<td><?php echo $row['State'];?></td>
				<td><?php echo $row['rank'];?></td>
				<td>
					<button class='actions-button' name='view'><a href='/assignment/view.php?id=<?php echo $row['emp_id'];?>'>View</a></button>
					<button class='actions-button'><a href='/assignment/edit.php?id=<?php echo $row['emp_id'];?>'>Update</a></button>
					<button class='actions-button warn'><a href='/assignment/delete.php?id=<?php echo $row['emp_id'];?>'>Delete</a></button>
				</td>
			</tr><?php
		} 
	}else{
			echo "0 results";
	}
	?>
	</table>
	</main>
	<section class="footer-sec">
		<?php
		include "footer.php";
	mysqli_close($dBase);
	?> 
	</section>
</div>
</html>