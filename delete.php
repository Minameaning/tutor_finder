<?php
    include "./templates/database.php";
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $sql = "DELETE from `tutor_info` where id=$id";
        $conn->query($sql);
    }
    header('location:display-person.php');
    exit;
?>