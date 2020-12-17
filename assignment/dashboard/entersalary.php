<?php
    session_start();
    if (!isset($_SESSION['username'])) {
        header("location:/assignment/login/");
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
            
            if (isset($_POST['sal_but'])) {
                $cat=mysqli_real_escape_string($dBase,$_POST['category']);
                $lev=mysqli_real_escape_string($dBase,$_POST['level_step']);
                $amt=mysqli_real_escape_string($dBase,$_POST['sal_amt']);
                $desc=mysqli_real_escape_string($dBase,$_POST['desc']);
                $com=mysqli_real_escape_string($dBase,$_POST['comment']);
                $status=mysqli_real_escape_string($dBase,$_POST['status']);

                $sql="INSERT INTO salary(category,level_step,salary_amount,description,comment,status) VALUES('$cat','$lev','$amt','$desc','$com','$status')";
                if (mysqli_query($dBase,$sql)) {?>
                    <div class="record-success">
                        <p>Succefully created new salary category</p>
                    </div><?php
                }else{
                    echo "Error: ".mysqli_error($dBase);
                }
            }
        ?>
        <main>
            <div class="dash-flex">
                <div class="flex1">
                    <form action="" method="post" class="dash-form">
                        <h3 class="form-header">Salary Entry Form</h3>
                        <input type="text" name="category" id="category" class="reg-input" placeholder="Category Name" required />
                        <input type="text" name="level_step" id="level_step" class="reg-input" placeholder="Level/Step" required />
                        <input type="number" name="sal_amt" id="sal_amt" class="reg-input" placeholder="Salary Amount (&#8358;)" required />
                        <textarea name="desc" id="desc" cols="30" rows="10" placeholder="Enter Salary Description" class="reg-input"></textarea>
                        <input type="hidden" name="comment" id="comment" value="..." class="reg-input">
                        <input type="hidden" name="status" id="status" value="active" class="reg-input">
                        <button type="submit" name="sal_but" id="sal_but" class="submit-btn loan-btn">Create Category</button>
                    </form>
                </div >
                <div class="flex2">
                    <div>
                        <h3 class="form-header">Would you rather edit a category?</h3>
            <?php
                $q="SELECT salary_id, category FROM salary";
                $result=mysqli_query($dBase,$q);
                while ($row=mysqli_fetch_assoc($result)) {?>
                    <button class="actions-button"><a href="/assignment/dashboard/editsalary.php?id=<?php echo $row['salary_id']; ?>"><?php echo $row['category']; ?></a></button><?php
                }
            ?>
                    </div>
                </div>
            </div>
        </main>
        <section>
            <?php
                include '../footer.php';
            ?>
        </section>
    </div>
</html>