<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("location:/assignment/login");
}
if (!isset($_SESSION['info'])) {
    header("location:/assignment/dashboard/fetch.php");
}
?>
<!DOCTYPE html>
<html>
    <?php include '../head.php'; ?>
    <div class="page">
        <?php
            include '../header.php';
            //date_default_timezone_set("Africa/Lagos");
            $id = $_SESSION['info'];
            $sql = "SELECT * FROM employee INNER JOIN salary ON employee.salary_id=salary.salary_id WHERE personalNumber='$id'";
            $res = mysqli_query($dBase, $sql);
            $row = mysqli_fetch_assoc($res);
            $sal = $row['salary_amount'];
            $max_loan = ($sal * (1/3))*12;
            //$out_bal = $row['loanAmount'] - $row['Amount'];
            $fy=2020;
            $sy=2021;
            $vfy=2020;
            $vsy=2021;
            $rand="TRANS-".date("YmdHi")."_".mt_rand(100,999);
            $tracker=$_SESSION['tracker'];

            if(isset($_POST['loan-btn'])) {
                $user_id=mysqli_real_escape_string($dBase, $_POST['user_id']);
                $trans_id=mysqli_real_escape_string($dBase, $_POST['transaction_id']);
                $trans_type=mysqli_real_escape_string($dBase, $_POST['transaction_type']);
                $loan_amt=mysqli_real_escape_string($dBase, $_POST['trans_amt']);
                $session=mysqli_real_escape_string($dBase, $_POST['session']);
                if($_SESSION['tr_type']=="debit"){
                    $loan_type=mysqli_real_escape_string($dBase, $_POST['loan_type']);
                }
                $desc=mysqli_real_escape_string($dBase, $_POST['desc']);
                $emp_id=$row['personalNumber'];
                
                if($trans_type=="debit"){
                    $totalLoan=$loan_amt*(115/100);
                    $stamt=$row['Amount']-$totalLoan;
                    //$stamt=round($stamt,-3);
                    $totalLoan=round($totalLoan);
                    $upd="UPDATE employee SET Amount='$stamt' WHERE personalNumber='$emp_id'";
                    $query="INSERT INTO transactions(emp_id, trans_id, transType, loanAmount, session, user_id, loanType, description) VALUES('$emp_id','$trans_id','$trans_type','$totalLoan','$session','$user_id','$loan_type','$desc')";
                }elseif ($trans_type=="credit") {
                    $amt=$loan_amt*(80/100);
                    $bal=$row['Amount']+$amt;
                    //$amt=round($amt,3);
                    $desc="Loan Repayment";
                    $upd="UPDATE employee SET Amount='$bal' WHERE personalNumber='$emp_id'";
                    $query="INSERT INTO transactions(emp_id, trans_id, transType, loanAmount, session, user_id, description) VALUES('$emp_id','$trans_id','$trans_type','$loan_amt','$session','$user_id','$desc')";
                    $excess_query="INSERT INTO excess(trans_id,emp_id,excess_amt) VALUES('$trans_id','$emp_id','$amt')";
                    mysqli_query($dBase,$excess_query);
                }
                
                //echo $trans_id."<br/>".$user_id."<br/>".$session."<br/>".$totalLoan;
                $check="SELECT * FROM transactions WHERE trans_id='$trans_id'";
                $res=mysqli_query($dBase,$check);
                if (mysqli_num_rows($res)>=1) {?>
                    <div class="record-success">
                        <p>I Exist</p>
                    </div><?php
                }else{
                    if (mysqli_query($dBase,$query) && mysqli_query($dBase,$upd)) {?>
                        <div class="record-success">
                            <p>Successfully committed transaction</p>
                        </div><?php
                    }else {
                        echo "Error: ".mysqli_error($dBase);
                    }
                }
            }
        ?>
        <main>
            <div class="dash-flex">
                <div class="flex1">
                    <div class="inf-img">
                        <img src="<?php echo $row['img']; ?>" alt="<?php echo $row['firstName']; ?>" class="emp-img">
                    </div>
                    <div class="inf-grid">
                    <p class="pers-inf dash-inf">Name: <?php echo $row['firstName']." ".$row['middleName']." ".$row['Surname']; ?></p>
                    <p class="pers-inf dash-inf">Email: <?php echo $row['Email']; ?></p>
                    <p class="pers-inf dash-inf">Outstanding Balance: &#8358;<?php echo number_format($row['Amount'],2); ?></p>
                    <p class="pers-inf dash-inf">Level/Step: <?php echo $row['level_step']; ?></p>
                    <!--<p class="pers-inf dash-inf">Status: <?php echo $row['status']; ?></p>-->
                    <p class="pers-inf dash-inf">Salary: &#8358;<?php echo number_format($row['salary_amount'],2); ?></p>
                    <!--<p class="pers-inf dash-inf">Monthly Instalment: &#8358;<?php echo number_format($row['monthly_instalment'],2); ?></p>-->
                    <!--<p class="pers-inf dash-inf">Loan Type: <?php ?></p>-->
                    </div>
                </div>
                <div class="flex2">
                    <form action="" class="dash-form" method="post">
                        <h3 class="login-head">Loan Form</h3>
                        <p class="login-inf">FIll Form</p>
                        <input type="hidden" name="user_id" id="user_id" class="reg-input" value="<?php echo $tracker; ?>" />
                        <input type="hidden" name="transaction_id" id="transaction_id" class="reg-input" value="<?php echo $rand; ?>" />
                        <input type="hidden" name="transaction_type" id="transaction_type" value="<?php echo $_SESSION['tr_type']; ?>">
                        <?php
                            if($_SESSION['tr_type']=="debit"){?>
                                <select name="trans_amt" id="trans_amt" class="reg-input" required>
                                    <option value="" selected disabled>Select Transaction Amount</option>
                                    <?php
                                        for ($i = $max_loan; $i > 0 ; $i = $i-10000) {?>
                                            <option value="<?php echo round($i,-3); ?>">&#8358;<?php echo number_format(round($i,-3),2); ?></option><?php
                                        }
                                    ?>
                                </select><?php
                            }else{?>
                            <input type="number" name="trans_amt" id="trans_amt" min="1" class="reg-input" placeholder="Enter Transaction Amount" required><?php
                            }
                        ?>
                        <select name="session" id="session" class="reg-input">
                            <option value="" selected disabled>Session</option>
                            <?php
                                for ($i=0; $i < 10 ; $i++) { ?>
                                        <option value="<?php echo $vfy++."/".$vsy++; ?>"><?php echo $fy++."/".$sy++; ?></option><?php
                                }
                            ?>
                        </select>
                        <?php
                            if($_SESSION['tr_type']=="debit"){?>
                                <select name="loan_type" id="loan_type" class="reg-input">
                                    <option value="" selected disabled>Loan Type</option>
                                    <option value="Consummables">Consummables</option>
                                    <option value="Non-consummables">Non-Consummables</option>
                                </select><?php
                            }
                        ?>
                        <textarea name="desc" placeholder="If loan type is consummables, list items" class="reg-input"></textarea>
                        <button class="submit-btn loan-btn" name="loan-btn">Commit Transaction</button>
                    </form>
                </div>
            </div>
        </main>
        <section class="footer-sec">
            <?php include '../footer.php'; ?>
        </section>
    </div>
</html>