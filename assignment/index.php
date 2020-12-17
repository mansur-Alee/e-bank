<?php
session_start();
if (isset($_SESSION['username'])) {
	if ($_SESSION['isadmin']) {
		header("location:/assignment/admin/");
	} else {
		header("location:/assignment/dashboard/");
	}
	
}
?><!DOCTYPE html>
<html>
<?php include 'head.php'; ?>
<div class="page">
<?php
include 'welcome.php';
?>
	<main>
	</main>
</div>
</html>