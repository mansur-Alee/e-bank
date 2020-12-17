<?php 
session_start();
?>
<!DOCTYPE html>
<html>
    <?php include 'head.php'; ?>
    <div class="page">
        <?php
            include 'header.php';
        ?>
        <main>
            <div class="dash-flex">
                <div class="flex1"><?php
                    if (isset($_POST['msg-btn'])) {?>
                        <h3 class="review-header"><?php echo $_POST['subject']; ?></h3>
                        <p><?php echo $_POST['message']; ?></p><?php
                    }
                    $sql="SELECT * FROM employee INNER JOIN transactions ON employee.ID=transactions.emp_id WHERE employee.ID=7 AND PersonalNumber='emp22'";
                    $result=mysqli_query($dBase,$sql);
                    $row=mysqli_fetch_array($result);

                    $tr_id=$row['trans_id'];
                    $sql2="SELECT * FROM employee INNER JOIN transactions ON employee.personalNumber=transactions.user_id WHERE transactions.trans_id='$tr_id'";
                    $res=mysqli_query($dBase,$sql2);
                    $tab=mysqli_fetch_array($res);
                    ?>
                    <h3>Contact Us on Social Media</h3>
                    <p class="pers-inf">Name: <?php echo $row['firstName']." ".$row['middleName']." ".$row['Surname']; ?></p>
                    <p class="pers-inf">Loan Amount: <?php echo "&#8358;".number_format(round($row['loanAmount']),2); ?></p>
                    <p class="pers-inf">Approved By: <?php echo $tab['firstName']." ".$tab['middleName']." ".$tab['Surname']; ?></p>
                    <p class="pers-inf">Transaction Time: <?php echo $row['transTime']; ?></p>
                    <p class="pers-inf">Loan Type: <?php echo $row['loanType'] ?></p>
                    <p class="pers-inf">DEscription: <?php echo $row['description'] ?></p>
                    <br/>
                    <br/>
                    <br/>
                    <br/>
                    <div class="social-flex">
                        <a href="https://www.instagram.com"><i style="font-size: 2rem;" class="fa fa-facebook"></i></a>
                        <a href="#"><i style="font-size: 2rem;" class="fa fa-twitter"></i></a>
                        <a href="#"><i style="font-size: 2rem;" class="fa fa-instagram"></i></a>
                    </div>
                </div>
                <div class="flex2">
                    <form action="" method="post" class="reg-form">
                        <div class="grid">
                            <input type="text" name="name" class="reg-input" placeholder="Name" />
                            <input type="email" name="email" class="reg-input" placeholder="Email" />
                        </div>
                            <input type="text" name="subject" class="reg-input off-grid" placeholder="Subject" />
                            <textarea name="message" cols="30" class="reg-input" rows="10" placeholder="Write Your Message..."></textarea>
                            <button type="submit" name="msg-btn" class="submit-btn">Send Message</button>
                    </form>
                </div>
            </div>
        </main>
        <section class="footer-sec">
            <?php include 'footer.php'?>
        </section>
    </div>
</html>