<?php
session_start();

include 'db_pdo.php';

$con = $db->open();
$stmt = $con->prepare("SELECT personalNumber FROM employee");
$stmt->execute();
$list = "";
foreach ($stmt as $row) {
    $list .= "
        <option value='{$row['personalNumber']}'></option>
    ";
}

?>
<!DOCTYPE html>
<html lang="en">
<?php include '../head.php' ?>
</head>
<body>
    <div class="page">
        <?php include '../header.php' ?>
        <form id="fetch_form" class="reg-form">
            <input type="text" name="reg_number" class="reg-input" placeholder="Personal Number" list="id_list">
            <datalist id="id_list">
            <?php echo $list ?>
            </datalist>
            <button type="submit" id="fetch" class="submit-btn">Generate Report</button>
        </form>
    </div>
    <div id="report"></div>
</body>
<script src="../jquery.js"></script>
<script>
    $("#fetch_form").submit(function(e){
        e.preventDefault();
        var details = $(this).serialize();
        $.ajax({
            type: 'POST',
            url: 'get_report.php',
            data: details,
            dataType: 'json',
            success: function(response){
                $("#report").html(response);
            }
        })
    })
</script>
<?php $db->close() ?>
</html>