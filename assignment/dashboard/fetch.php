<?php
session_start();
if(!isset($_SESSION['username'])){
	header('location:/assignment/login');
}
unset($_SESSION['info']);
unset($_SESSION['tr_type']);
?>
<!DOCTYPE html>
<html>
    <?php include '../head.php'; ?>
    <div class="page">
        <?php
            include '../header.php';
            
            if(isset($_POST['fetch'])){
                $pn = mysqli_real_escape_string($dBase, $_POST['personalNumber']);

                $sql = "SELECT * FROM employee WHERE personalNumber='$pn'";
                $result = mysqli_query($dBase, $sql);
                $tab = mysqli_fetch_assoc($result);
                if (mysqli_num_rows($result)==1) {
                    $_SESSION['info'] = $tab['personalNumber'];
                    $_SESSION['tr_type']=$_POST['tr_type'];
                    header("location:/assignment/dashboard/userinfo.php");
                }else{?>
                <div class="record-success">
                    <p>Your search entry returned zero results, Check your entry and try again</p>
                </div><?php
            }
            }
        ?>
        <main>
            <form class='reg-form' method="POST">
                <div class="logo-flex">
                    <img src="/assignment/images/ANXIOM-LOGO.png" alt="AXIOMS LOGO" class="dash-logo" />
                </div>
                <input type="text" name="personalNumber" class='reg-input' placeholder='Employee Number' autofocus required />
                <select name="tr_type" id="tr_type" class="reg-input" required>
                    <option value="" selected disabled>Select Transaction Type</option>
                    <option value="credit">Credit</option>
                    <option value="debit">Debit</option>
                </select>
                <button name="fetch" class='submit-btn'>Get Information</button>
            </form>
        </main>
        <section class='footer-sec'>
            <?php
                include '../footer.php';
            ?>
        </section>
    </div>
</html>