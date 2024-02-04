<?php 
  session_start();
  require('../../db/config.php');
  print_r($_FILES);
  if(isset($_POST['id'])){
     
    $uploadedFiles = $_FILES['files']['name'];

    $allFilesEmpty = true;
    
    foreach ($uploadedFiles as $fileName) {
        if ($fileName !== "") {
            $allFilesEmpty = false;
            break;  // Exit the loop as soon as a non-empty file name is found
        }
    }
    
    if ($allFilesEmpty) {
        $query = "UPDATE workActivity SET "
    } else {
        echo "meron";
    }
   
  
  
  }
?>