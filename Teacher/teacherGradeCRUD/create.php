<?php 
session_start();
require('../phpcodes/connection.php');  

if(isset($_POST['fname'])){
  $fname =  trim($_POST['fname']);
  $lname = trim($_POST['lname']);
  $quarter = trim($_POST['quarter']);
  $schoolyear = trim($_POST['schoolyear']);
  $writtenwork = trim($_POST['writtenwork']);
  $performancetask = trim($_POST['performancetask']);
  $assessment = trim($_POST['assessment']);
  $studentID = trim($_POST['studentID']);

  $query = "INSERT INTO studentgrades(writtenWork,performanceTask,assessment,schoolYear,quarter,studentID) VALUES(?,?,?,?,?,?)";
  $stmt = mysqli_prepare($conn,$query);
  $stmt->bind_param("dddiii", $writtenwork,$performancetask, $assessment, $schoolyear, $quarter, $studentID);

    if($stmt->execute()){
      // Check the affected rows to verify if the insertion was successful
      $affected_rows = $stmt->affected_rows;

      if($affected_rows > 0){
          $_SESSION['status'] = "Successfully added";
          $_SESSION['status_code'] = "success";
          header('location: ../TeacherGrade.php');
      } else {
          // Handle the case where no rows were affected (insertion failed)
          $_SESSION['status'] = "Failed to add record";
          $_SESSION['status_code'] = "error";
          header('location: ../TeacherGrade.php');
      }
  } else {
      // Handle the case where the execute method failed
      $_SESSION['status'] = "Error executing query";
      $_SESSION['status_code'] = "error";
      header('location: ../TeacherGrade.php');
  }
}
?>