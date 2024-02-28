<?php
session_start();
include("config.php");

if(isset($_POST["insertTask"])){

    $title = $_POST['title'];
    $description = $_POST['description'];
    $priority = $_POST['priority'];
    $due_date = $_POST['due_date'];

    $query = "INSERT INTO `tasks`(`title`, `description`, `priority`, `due_date`) VALUES ('$title', '$description', '$priority', '$due_date')";
    $query_result = mysqli_query( $con, $query );

    if($query_result){
        $_SESSION['status'] = "Task Added";
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


if(isset($_POST["updateTask"])){
    $id = $_POST["id"];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $priority = $_POST['priority'];
    $due_date = $_POST['due_date'];

    $query = "UPDATE `tasks` SET `title`='$title',`description`='$description',`priority`='$priority',`due_date`='$due_date' WHERE id='$id'";
    $query_result = mysqli_query( $con, $query );

    if($query_result){
        $_SESSION['status'] = "Task Updated";
        $_SESSION['status_code'] = "success";
        header("Location: index.php");
        exit();
    }else{
        $_SESSION['status'] = "Update fail";
        $_SESSION['status_code'] = "error";
        header("Location: index.php");
        exit();
    }
}

?>