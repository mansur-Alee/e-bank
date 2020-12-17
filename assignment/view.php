<?php session_start();
if(!isset($_SESSION['username'])){
    header('location:/assignment/login');
}
 ?>
<!DOCTYPE html>
<html>
    <?php include 'head.php'; ?>
    <div class="page">
        <?php
            include 'header.php';

            if(isset($_SESSION['employee'])){
                $id = $_SESSION['employee'];
            }else{
                $id = $_REQUEST['id'];
            }
            $sql = "SELECT * FROM employee WHERE ID='$id'";
            $result = mysqli_query($dBase, $sql);
            $row = mysqli_fetch_assoc($result);
        ?>
        <main>
            <div class='info-panel record-success'>
                <div class='info'>
                    <div class='img'>
                        <img src="<?php echo $row['img'] ?>" class="st-img" alt='<?php echo $row['firstName']?>' />
                    </div>
                    <div class='p-inf'>
                        <p class='pers-inf'>First Name: <?php echo $row['firstName']; ?></p>
                        <p class='pers-inf'>Middle Name: <?php echo $row['middleName']; ?></p>
                        <p class='pers-inf'>Surname: <?php echo $row['Surname']; ?></p>
                        <p class='pers-inf'>Personal Number: <?php echo $row['personalNumber']; ?></p>
                        <p class='pers-inf'>Date of Birth: <?php echo $row['DOB']; ?></p>
                        <p class='pers-inf'>Email: <?php echo $row['Email']; ?></p>
                        <p class='pers-inf'>State of Origin: <?php echo $row['State']; ?></p>
                        <p class='pers-inf'>Local Gov't Area: <?php echo $row['LGA']; ?></p>
                        <p class='pers-inf'>Rank: <?php echo $row['rank']; ?></p>
                    </div>
                </div>
            </div>
        </main>
        <section class='footer-sec'>
            <?php include 'footer.php';?>
        </section>
    </div>
</html>