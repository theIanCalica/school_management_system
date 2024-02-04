<?php
session_start();
require('../phpcodes/connection.php');

if (isset($_POST['studentID'])) {
    $studentId = $_POST['studentID'];
    print_r($_POST);
    $query = "DELETE FROM students WHERE studentID = ?";
    $stmt = mysqli_prepare($conn, $query);
    $stmt->bind_param("i", $studentId);

    if ($stmt->execute()) {
        echo "Query executed successfully.<br>";
        $affected_rows = $stmt->affected_rows;

        if ($affected_rows > 0) {
            $_SESSION['status'] = "Successfully deleted";
            $_SESSION['status_code'] = "success";
            header('location: ../studentrecords.php');
        } else {
            echo "No rows affected.<br>";
            $_SESSION['status'] = "Failed to delete record: " . $stmt->error;
            $_SESSION['status_code'] = "error";
            header('location: ../studentrecords.php');
        }

        $stmt->close(); // Close the statement
    } else {
        echo "Error executing query.<br>";
        $_SESSION['status'] = "Error executing query";
        $_SESSION['status_code'] = "error";
        header('location: ../studentrecords.php');
    }
}
?>
