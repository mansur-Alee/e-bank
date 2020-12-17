<?php 
session_start();
unset($_SESSION['username']);
// unset($_SESSION['isadmin']);
unset($_SESSION['sn']);
unset($_SESSION['info']);
header('location:/assignment/login');
// if(isset($_SESSION['employee'])){
// 	unset($_SESSION['employee']);
// 	header('location:/assignment/login/employeelogin.php');
// }else{
// }
?>