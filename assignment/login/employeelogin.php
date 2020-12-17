<?php
session_start();
if(isset($_SESSION['username'])){
    header("location:/assignment/memberslist.php");
}elseif (isset($_SESSION['employee'])) {
    header("location:/assignment/view.php");
}
?>
<!DOCTYPE html>
<html>
    <?php include '../head.php'; ?>
    <div class="page">
        <?php include '../header.php';
        if(isset($_POST['stLogin'])){
            $username = mysqli_real_escape_string($dBase, $_POST['stUsername']);
            $pswd = mysqli_real_escape_string($dBase, $_POST['stPswd']);
            $pswd = md5($pswd);

            $sql = "SELECT * FROM students WHERE Pswd='$pswd'";
            $result = mysqli_query($dBase, $sql);
            $row = mysqli_fetch_Array($result);

            if(mysqli_num_rows($result) == 1){
                $_SESSION['employee'] = $row['emp_id'];
                //$_SESSION['username'] = $row['Username'];
                //$_SESSION['isadmin'] = "zzz";
                header("location:/assignment/view.php");
            }else{
                $_SESSION['wrong-pswd'] = "wrong"; ?>
                <div class='record-success'><p>The Username or Password you entered is incorrect</p></div><?php
            }
        }
        ?>
        <main>
            <?php
            if(!isset($_SESSION['wrong-pswd'])){?>
            <form method="POST" class="login-form">
			    <h3 class="login-head">Login Form</h3>
			    <p class="login-inf">Please Enter your login details</p>
			    <input type="text" name="stUsername" placeholder="Username" class="login-input" autofocus required />
			    <input type="password" name="stPswd" placeholder="Password" class="login-input" required />
			    <!--<p class="forgot-pswd"><a href="/assignment/login/forgotpswd.php">Forgot Password?</a></p>-->
			    <button type="submit" name="stLogin" class="submit-btn login-btn">Login</button>
            </form><?php
            } ?>
        </main>
        <section class="footer-sec">
            <?php include '../footer.php';
            unset($_SESSION['wrong-pswd']);
            ?>
        </section>
    </div>
</html>