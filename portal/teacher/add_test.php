<?php

require_once('../../scripts/conn.php');
session_start();

if(isset($_POST['submit'])){
    $course_id = $_POST['course_id'];
    $title = $_POST['title'];
    $description = $_POST['description'];

    $stmt = $conn->prepare("INSERT INTO tests (course_id, title, description1) VALUES (?,?,?)");
    $stmt->bind_param("iss",$course_id, $title, $description);

    if($stmt->execute()){
        echo "<div> Test added Successfully</div>";
    }
    else{
        echo "<div>Error: Test was not added </div>";
    }

    }

?>