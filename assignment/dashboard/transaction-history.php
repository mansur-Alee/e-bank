<?php session_start();
if (!isset($_SESSION['username'])) {
    header("location:/assignment/login");
}
?>
<!DOCTYPE html>
<html lang="en">
<?php
include '../head.php';
?>
<div class="page">
    <?php 
        include '../header.php';
    ?>
    <main>
        <form action="" method="post" class="reg-form">
            <h3 class="form-header">Transaction History</h3>
            <input type="text" name="emp_id" id="emp_id" class="reg-input" placeholder="Enter Member ID or Transaction ID" autofocus required>
            <button type="submit" name="history-btn" id="history-btn" class="submit-btn">Get History</button>
        </form>
        <?php
            if (isset($_POST['history-btn'])) {
                $emp_id=$_POST['emp_id'];
                $sel="SELECT * FROM ((transactions INNER JOIN excess ON transactions.trans_id=excess.trans_id) INNER JOIN employee ON transactions.emp_id=employee.personalNumber) WHERE transactions.emp_id='$emp_id' OR transactions.trans_id='$emp_id'";
                $res=mysqli_query($dBase,$sel);?>
                <table id="myTable">
                    <thead>
                        <tr>
                            <th>Transaction ID</th>
                            <th>Account Name</th>
                            <th>Transaction Type</th>
                            <th>Deposit Amount</th>
                            <th>Excess Amount</th>
                            <th>Capital Share</th>
                            <!--<th>Outstanding Balance</th>-->
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if(mysqli_num_rows($res)){
                                while ($row=mysqli_fetch_array($res,MYSQLI_BOTH)) {?>
                                    <tr>
                                        <td><?php echo $row['trans_id']; ?></td>
                                        <td><?php echo $row['firstName']." ".$row['middleName']." ".$row['Surname']; ?></td>
                                        <td><?php echo $row['transType']; ?></td>
                                        <td>&#8358;<?php echo number_format($row['loanAmount'],2); ?></td>
                                        <td>&#8358;<?php echo number_format($row['excess_amt'],2); ?></td>
                                        <td>&#8358;<?php echo number_format(($row['loanAmount']*(20/100)),2); ?></td>
                                    </tr><?php
                                }
                            }
                        ?>
                    </tbody>
                </table><?php
            }
        ?>
    </main>
    <section class="footer-sec">
        <?php include '../footer.php'; ?>
    </section>
</div>
</html>