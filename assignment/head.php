<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" type="image/x-icon" href="/assignment/images/ANXIOM-LOGO.ico">
    <link rel="stylesheet" type="text/css" href="/assignment/style.css">
    <link rel="stylesheet" href="/loans2go/css/font-awesome.min.css"/>
    <title><?php
        if ($_SERVER['PHP_SELF'] == "/assignment/register.php") {
            echo "Register - ";
        } elseif($_SERVER['PHP_SELF'] == "/assignment/login/index.php" || $_SERVER['PHP_SELF'] == "/assignment/login/employeelogin.php") {
            echo "Login - ";
        } elseif ($_SERVER['PHP_SELF'] == "/assignment/dashboard/index.php") {
            echo "Dashboard - ";
        } elseif ($_SERVER['PHP_SELF'] == "/assignment/contact.php") {
            echo "Contact - ";
        } elseif ($_SERVER['PHP_SELF'] == "/assignment/dashboard/userinfo.php") {
            echo "User Info - ";
        } elseif ($_SERVER['PHP_SELF'] == "/assignment/dashboard/loan.php") {
            echo "Loan - ";
        } elseif ($_SERVER['PHP_SELF'] == "/assignment/memberslist.php") {
            echo "Members' List - ";
        }
        
    ?>The Axioms Ltd.</title>
</head>