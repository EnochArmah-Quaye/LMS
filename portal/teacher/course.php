<?php

require_once('../../scripts/conn.php');

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $title = $_POST['title'];
    $description = $_POST['description'];

    $stmt = $conn->prepare("INSERT INTO courses (title, description) VALUES (?,?) ");
    $stmt->bind_param("ss",$title,$description);
   
    if( $stmt->execute()){
        echo 'Course created Successfully';
    }
    else{
        echo "Course was not created";
    }


}

?>