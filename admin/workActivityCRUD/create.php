<?php 
  session_start();
  require('../../db/config.php');
  print_r($_FILES);
  if(isset($_POST['title'])){
    //print_r($_POST);
    $title = trim($_POST['title']);
    $desc = trim($_POST['desc']);
    $classID = trim($_POST['classID']);
    $dueDate = trim($_POST['dueDate']);
    $score = trim($_POST['score']);
    if (!isset($_FILES) || empty($_FILES)) {
      $query = "INSERT INTO workActivity(class_id,actName,actDesc,dueDate,actScore) VALUES(?,?,?,?,?)";
      $stmt = mysqli_prepare($conn,$query);
      $stmt->bind_param("isssi", $classID,$title,$desc,$dueDate,$score);
    } else {
      echo "meron ";
      $files = array_filter($_FILES['files']['name']);
      $total_count = count($_FILES['files']['name']);
      for($i = 0; $i < $total_count; $i++){
        $tmpFilePath = $_FILES['files']['tmp_name'][$i];
        $filename = $_FILES['files']['name'][$i];
        $fileExt = explode('.',$filename);
        $fileActualExt = strtolower(end($fileExt));
        $fileNameNew = uniqid('', true) . "." . $fileActualExt;
        if($tmpFilePath != ""){
          $newFilePath = "../../uploads/subProducts/" . $fileNameNew;
          move_uploaded_file($tmpFilePath, $newFilePath);
          $uploadedFilePaths [] = $newFilePath; 
        }
      }
    }
  
  }
?>