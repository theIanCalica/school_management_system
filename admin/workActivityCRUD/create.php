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
      if($stmt->execute()){
        // Check the affected rows to verify if the insertion was successful
        $affected_rows = $stmt->affected_rows;

        if($affected_rows > 0){
            $_SESSION['status'] = "Successfully added";
            $_SESSION['status_code'] = "success";
            header('location: ../workActivity.php');
        } else {
              // Handle the case where no rows were affected (insertion failed)
              $_SESSION['status'] = "Failed to add record";
              $_SESSION['status_code'] = "error";
              header('location: ../workActivity.php');
        }
      } else {
          // Handle the case where the execute method failed
          $_SESSION['status'] = "Error executing query";
          $_SESSION['status_code'] = "error";
          header('location: ../workActivity.php');
      }
    } else {
      echo "meron ";
      $files = array_filter($_FILES['files']['name']);
      $total_count = count($_FILES['files']['name']);
      for($i = 0; $i < $total_count; $i++){
        $tmpFilePath = $_FILES['files']['tmp_name'][$i];
        $filename = $_FILES['files']['name'][$i];
        $fileExt = explode('.',$filename);
        $fileActualExt = strtolower(end($fileExt));
       
        if($tmpFilePath != ""){
          $newFilePath = "../../uploads/activity/" . $filename;
          move_uploaded_file($tmpFilePath, $newFilePath);
          $uploadedFilePaths [] = $newFilePath; 
        }
      }
      $query = "INSERT INTO workActivity(class_id,actName,actDesc,dueDate,actScore) VALUES(?,?,?,?,?)";
      $stmt = mysqli_prepare($conn,$query);
      $stmt->bind_param("isssi", $classID,$title,$desc,$dueDate,$score);

      if($stmt->execute()){
        // Check the affected rows to verify if the insertion was successful
        $affected_rows = $stmt->affected_rows;

        if($affected_rows > 0){
            $_SESSION['status'] = "Successfully added";
            $_SESSION['status_code'] = "success";
            // header('location: ../workActivity.php');
        } else {
              // Handle the case where no rows were affected (insertion failed)
              $_SESSION['status'] = "Failed to add record";
              $_SESSION['status_code'] = "error";
              // header('location: ../workActivity.php');
        }
      } else {
          // Handle the case where the execute method failed
          $_SESSION['status'] = "Error executing query";
          $_SESSION['status_code'] = "error";
          // header('location: ../workActivity.php');
      }

      $query = "SELECT max(id) as maxWorkActivityID FROM workActivity";
      $query_run = mysqli_query($conn, $query);
      
      if ($query_run) {
          $row = mysqli_fetch_assoc($query_run);
          $lastID = $row['maxWorkActivityID'];
      } else {
          echo "Error executing query: " . mysqli_error($conn);
      }
      
      $query = "INSERT INTO workActivity_files(workActivityID,filepath) VALUES(?,?)";
      $stmt2 = mysqli_prepare($conn,$query);
      foreach($uploadedFilePaths as $filePath){
        $stmt2->bind_param("is", $lastID, $filePath);
        $stmt2->execute();
      }

    }
  
  }
?>