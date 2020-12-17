<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("location:/assignment/login");
}
?>
<!DOCTYPE html>
<html>
    <?php 
        include '../head.php';
    ?>
    <div class="page">
        <?php
            include '../header.php';
            $id=$_GET['id'];
            if(!isset($id)){
                header("location:/assignment/dashboard/entersalary.php");
            }
            unset($_SESSION['sal_edit']);
            $sql="SELECT * FROM salary WHERE salary_id='$id'";
            $res=mysqli_query($dBase,$sql);
            $row=mysqli_fetch_assoc($res);
        ?>
        <main>
            <form action="" method="post" class="reg-form">
                <h3 class="form-header">Update Salary</h3>
                <p class="login-inf">You are editing salary <?php echo $row['category'] ?></p>
                <label for="level_s" class="reg-label">Level/Step</label>
                <input type="text" name="level_s" id="level_s" class="reg-input" value="<?php echo $row['level_step']; ?>" required />
                <label for="amt" class="reg-label">Salary Amount</label>
                <input type="number" name="amt" id="amt" class="reg-input" value="<?php echo $row['salary_amount']; ?>" required />
                <button type="submit" name="update-sal" id="update-sal" class="submit-btn loan-btn">Update Category</button>
            </form>
            <!--<button class="actions-button"><a href="?sal_id=1">Go</a></button>-->
        </main>
        <section class="footer-sec">
            <?php
                include '../footer.php';
            ?>
        </section>
    </div>
</html>