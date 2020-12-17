<?php
    session_start();
    if(isset($_SESSION['username'])){
        header("location:/assignment/dashboard");
    }
?>
<!DOCTYPE html>
<html>
    <?php include '../head.php'; ?>
    <div class='page'>
        <?php  
        include '../header.php';
        
        if(isset($_POST['reset-pswd'])){
            $pn = mysqli_real_escape_string($dBase, $_POST['pn']);
            $username = mysqli_real_escape_string($dBase, $_POST['username']);
            
            $sql = "SELECT * FROM employee WHERE personalNumber = '$pn' AND Username = '$username'";
            $result = mysqli_query($dBase, $sql);
            $tab = mysqli_fetch_array($result);

            if(mysqli_num_rows($result) == 1){
                $_SESSION['uName'] = $tab['personalNumber'];
                header("location:/assignment/login/resetpswd.php");
            }
        }
        ?>
        <main>
            <form method="POST" class="login-form">
		        <h3 class="login-head">Password Reset Form</h3>
		        <p class="login-inf">Fill the required input</p>
		        <input type="text" name="pn" placeholder="Personal Number" class="login-input" autofocus required />
		        <input type="text" name="username" placeholder="Username" class="login-input" required />
		        <button type="submit" name="reset-pswd" class="submit-btn">Reset Password</button>
            </form>
        </main>
        <section class='footer-sec'>
            <?php include '../footer.php';?>
        </section>
    </div>
</html>