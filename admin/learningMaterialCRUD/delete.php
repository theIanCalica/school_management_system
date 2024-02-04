<?php 
  print_r($_POST);
  if(isset($_POST['d']))
  $query = "DELETE FROM learningMaterials WHERE id = ?";
  $stmt = mysqli_prepare($conn,$query);
  $stmt->bind_param("i", $id);
?>