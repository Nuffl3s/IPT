<?php
session_start();
include ("config.php");

if (isset($_POST['id'])) {
  $id = $_POST['id'];

  $query = "DELETE FROM tasks WHERE id = $id"; 
  $delete_result = mysqli_query($con, $query);

  if ($delete_result) {
    $_SESSION['status'] = "Deleted";
    $_SESSION['status_code'] = "success";
    header("Location: index.php");
    exit();
}else{
    $_SESSION['status'] = "Error";
    $_SESSION['status_code'] = "error";
    header("Location: index.php");
    exit();
    }
}
?>