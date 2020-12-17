<?php
    session_start();
    if(!isset($_SESSION['uName'])){
        header("location:/assignment");
    }
?>
<!DOCTYPE html>
<html>
    <?php include '../head.php'; ?>
    <div class="page">
        <?php 
        include '../header.php';

        if(isset($_POST['updatePswd'])){
            $newP = mysqli_real_escape_string($dBase, $_POST['newPswd']);
            $rePswd = mysqli_real_escape_string($dBase, $_POST['retypeNewPswd']);
            $newP = md5($newP);
            $rePswd = md5($rePswd);
            $uName = $_SESSION['uName'];
            $_SESSION['rstP'] = $newP;
            $sql2 = "UPDATE employee SET Pswd = '$newP' WHERE personalNumber = '$uName'";
            if(mysqli_query($dBase, $sql2)){?>
                <div class="record-success">
                    <p>Password Changed Successfully!</p>
                    <div class="div-flex">
                        <button class='actions-button pswd-rst'><a href='/assignment/login'>Proceed to Sign In</a></button>
                    </div>
                </div><?php
            }else{
                echo "Failed to Update Record: ".mysqli_error($dBase);
            }
        }
        ?>
        <main>
            <?php
            if(!isset($_SESSION['rstP'])){?>
                <form method="POST" class="login-form">
                    <h3 class="login-head">Type in a New Password</h3>
                    <p class="login-inf">Make sure both passwords match</p>
                    <input type="password" name="newPswd" placeholder="New Password" class="login-input" required />
                    <input type="password" name="retypeNewPswd" placeholder="Retype New Password" class="login-input" required />
                    <button type="submit" name="updatePswd" class="submit-btn">Update Password</button>
                </form><?php
            }?>
        </main>
        <section class="footer-sec">
            <?php include '../footer.php';?>
        </section>
    </div>
</html>