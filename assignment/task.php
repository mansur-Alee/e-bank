<!--CSS-->
<style>
#myInput {
	width: 25vw;
	padding: 12px 0;
	font-size: 16px;
	border: 1px solid #ddd;
	margin: 12px auto;
}
#myTable th {
  background: #06b0c6;
}
#myTable {
  border-collapse: collapse;
  width: 60vw;
  border: 1px solid #ddd;
  font-size: 18px;
  margin: 20px auto;
}

#myTable th, #myTable td {
  text-align: left;
  padding: 12px;
  border: 1px solid #000;
}

#myTable tr {
  border-bottom: 1px solid #ddd;
}

#myTable tr.header, #myTable tr:hover {
  background-color: #f1f1f1;
}
</style>
<!--FUNCTIONS-->
<script>
  function myFunction() {
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("myInput");
    filter = input.value.toUpperCase();
    table = document.getElementById("myTable");
    tr = table.getElementsByTagName("tr");
    for (i = 0; i < tr.length; i++) {
      td = tr[i].getElementsByTagName("td")[0];
      if (td) {
        txtValue = td.textContent || td.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
          tr[i].style.display = "";
        } else {
          tr[i].style.display = "none";
        }
      }       
    }
  }
</script>

<form method="post" enctype="multipart/form-data">
    Select image to upload:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload Image" name="submit">
</form>

<?php
include 'db.php';
if (isset($_POST['submit'])) {
  $target_dir = "images/";
	$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
	$uploadOk = 1;
  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
  
  $check = getimagesize($_FILES['fileToUpload']["tmp_name"]);
  if ($check !== false) {
    echo "I'm an image! ".$check["mime"].".";
    $uploadOk = 1;
  }else {
    echo "Nahh dude, wrong guy.";
    $uploadOk = 0;
  }
  if (file_exists($target_file)) {
    echo "Sorry! :(";
    $uploadOk= 0;
  }
  if ($_FILES['fileToUpload']['size'] > 500000) {
    echo "Wrong bitch!";
    $uploadOk = 0;
  }
  if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
    echo "NOOOOOOOOOOOOOOO!";
    $uploadOk = 0;
  }
  if($uploadOk == 0){
    echo "Upload Nah";
  }else {
    if (move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $target_file)) {
      echo "the file ".$target_file." has beeen uploaded";
      $sql = "INSERT INTO economics(regNumber) VALUE('$target_file')";
      mysqli_query($dBase,$sql);
    } else {
      echo "mhmmm :(";
    }
    
  }
  
}


  $try = 3200000;
  ?>
  <select>
    <?php for ($i=$try; $i >= 0 ; $i = $i - 10000) { 
      $ava = $i * (1/3); ?>
        <option value=""><?php echo "&#8358;".number_format(round($ava)); ?></option><?php
    } ?>
  </select>



<?php

$pn = 55;
//$sql = "SELECT firstName, level, salary_id, comment FROM students INNER JOIN salary ON students.ID=salary.salary_id where student.ID='$pn'";
$sql="SELECT firstName, img, rank, amount, salary_amount, comment
from students
inner join salary
on students.ID=salary.ID";
$exe=mysqli_query($dBase, $sql);
$row=mysqli_fetch_assoc($exe);
echo "&#8358;".number_format($row['salary_amount'], 2);



?>