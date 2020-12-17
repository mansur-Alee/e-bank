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
            $uName=$_SESSION['username'];
            $ps=$_SESSION['sn'];
            $sql="SELECT * FROM employee WHERE Username='$uName' AND Pswd='$ps'";
            $res=mysqli_query($dBase,$sql);
            $row=mysqli_fetch_array($res);
        ?>
        <main>
            <div class="reg-form">
                <div class="logo-flex">
                    <img src="<?php echo $row['img'];?>" alt="<?php echo $row['firstName']; ?>" class="dash-logo">
                </div>
                <p class="land-welcome">Welcome to your Page, <?php echo$row['firstName']; ?></p>
            </div>
        </main>
        <section class="footer-sec">
            <?php
                include '../footer.php';
            ?>
        </section>
    </div>
</html>