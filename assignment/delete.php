<?php
session_start();
if($_SESSION['isadmin'] != 1){
	header("location:/assignment/login");
}
?>
<!DOCTYPE html>
<html>
<?php include 'head.php'; ?>
<?php
//include '/assignment/db.php';
?>
<div class="page">
	<?php include 'header.php';?>
<main>
<?php
$id = $_REQUEST['id'];
if(!isset($id)){
		header("location:/assignment/admin/memberslist.php");
	}

$sql = "DELETE FROM employee WHERE id='$id'";

if(mysqli_query($dBase, $sql)){
	header("location:/assignment/admin/memberslist.php");
}

?>
</main>
<section class="footer-sec">
<?php include 'footer.php';?>
</section>
</div>
</html>