<!--ASSIGNMENT CREATE-->

<?php
session_start();
require('../../admin/phpcodes/connection.php');

print_r($_FILES);
if(isset($_POST['activityname'])){
    $activityname=$_POST['activityname'];
    $activitydescription=$_POST['activitydescription'];
    $uploadfile=$_FILES['uploadfile'];
    $duedate=$_POST['duedate'];
    $classid=$_POST['class'];


   $files = array_filter($_FILES['uploadfile']['name']);
    $total_count = count($_FILES['uploadfile']['name']);
    for($i = 0; $i < $total_count; $i++){
      $tmpFilePath = $_FILES['uploadfile']['tmp_name'][$i];
      $filename = $_FILES['uploadfile']['name'][$i];
      $fileNameNew = $filename;
      if($tmpFilePath != ""){
        $newFilePath = "../../uploads/activities/" . $fileNameNew;
        move_uploaded_file($tmpFilePath, $newFilePath);
        $uploadedFilePaths [] = $newFilePath; 
      }
      }


  $query = "INSERT INTO workactivity(actName, actDesc, actUploadFile, actSetDueDate, classID) VALUES(?,?,?,?,?)";

  $stmt = mysqli_prepare($conn, $query);
  $stmt->bind_param("ssssi", $activityname, $activitydescription, $filepath, $duedate, $classid);

  foreach($uploadedFilePaths as $filepath){
    $filepath = $filepath;
    $stmt->execute();
  }


          $_SESSION['status'] = "Successfully added";
          $_SESSION['status_code'] = "success";
          header('location: ../assignment.php');


}

?>