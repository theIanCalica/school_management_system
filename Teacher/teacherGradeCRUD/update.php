<?php 
session_start();
 require('../phpcodes/connection.php');
if(isset($_POST['stidentID_edit'])){
  print_r($_POST);
  $studentID = $_POST['studentID_edit'];
  $quarter = $_POST['quarter_edit'];
  $schoolyear = $_POST['schoolyear_edit'];
  $writtenwork = $_POST['writtenwork_edit'];
  $performancetask = $_POST['performancetask_edit'];
  $assessment = $_POST['assessment_edit'];

  $query = "UPDATE studentgrades SET writtenWork = ?, performanceTask = ?, assessment = ?, schoolYear = ?, quarter = ?, studentID = ? WHERE studentGradesID = ?";
  $stmt = mysqli_prepare($conn,$query);
  $stmt->bind_param("dddiiii", $writtenwork, $performancetask, $assessment, $schoolyear, $quarter, $studentID, $studentGradesID);

  if($stmt->execute()){
      // Check the affected rows to verify if the insertion was successful
      $affected_rows = $stmt->affected_rows;

      if($affected_rows > 0){
          $_SESSION['status'] = "Successfully updated";
          $_SESSION['status_code'] = "success";
          header('location: ../TeacherGrade.php');
      } else {
          // Handle the case where no rows were affected (insertion failed)
          $_SESSION['status'] = "Failed to delete record";
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