<?php
$dBase = new mysqli('localhost', 'root', '', 'axiomsltd');
if (!$dBase) {
	die("Connection failed: ".mysqli_connect_error());
}
?>