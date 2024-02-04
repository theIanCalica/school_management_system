<!--ASSIGNMENT UPDATE-->

<?php
session_start();

print_r($_POST);
error_reporting(E_ALL);
ini_set('display_errors', 1);

require('../../../db/config.php');

// Assuming you have the activity name as an identifier in the form
$activityname = $_POST['activityname'];
$activitydescription = $_POST['activitydescription'];
$duedate = $_POST['duedate'];

// // Check if the file was uploaded without errors
// if ($_FILES["uploadfile"]["error"] == UPLOAD_ERR_OK) {
//     $fileupload = $_FILES["uploadfile"]["name"];

//     // Update the record in the database
//     $query = "UPDATE workActivity SET actDesc = ?, actUploadFile = ?, actSetDueDate = ? WHERE workActivityID = ?";
//     $stmt = mysqli_prepare($conn, $query);

//     // Assuming you have workActivityID available, for example from a hidden input in the form
//     $workactivityid = $_POST['workactivityid'];

//     $stmt->bind_param("sssi", $activitydescription, $fileupload, $duedate, $workactivityid);

//     if ($stmt->execute()) {
//         // Check the affected rows to verify if the update was successful
//         $affected_rows = $stmt->affected_rows;

//         $_SESSION['status'] = ($affected_rows > 0) ? "Successfully updated" : "No rows were updated";
//         $_SESSION['status_code'] = ($affected_rows > 0) ? "success" : "error";
//     } else {
//         // Handle the case where the execute method failed
//         $_SESSION['status'] = "Error executing query: " . mysqli_error($conn);
//         $_SESSION['status_code'] = "error";
//     } 
// } else {
//     // Handle file upload error
//     $_SESSION['status'] = "File upload error: " . $_FILES["uploadfile"]["error"];
//     $_SESSION['status_code'] = "error";
// }

// // Redirect to the same page or wherever you want
// header('location: ../Filipino.php');
?>