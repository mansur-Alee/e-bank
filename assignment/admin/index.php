<?php
    session_start();
    if(!isset($_SESSION['username']) || !$_SESSION['isadmin']){
        header("location:/assignment/login/");
    }
?>
<!DOCTYPE html>
<html>
<?php include '../head.php'; ?>
    <div class="page">
        <?php
            include '../header.php';
        ?>
        <div class="reg-form text-center test-bg">
            <h2 class="form-header">Welcome to Admin Section</h2>
            <p>What would you like to do?</p>
            <a href="">Approve Loans</a><br>
            <a href="">View Loan Apllications</a>
        </div>
    </div>
</html>