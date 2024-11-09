<?php

require_once('../../scripts/conn.php');
session_start();

if(!isset($_SESSION['id'])){
   echo "Please log in to enroll in a Course";
   exit;
}

$username = $_SESSION['id'];
$course_id = $_GET['course_id'];

$stmt = $conn->prepare("SELECT * FROM enrollments WHERE student_id = ? AND course_id = ?");
$stmt->bind_param("ii",$username,$description);
$stmt->execute();

$enrollment = $stmt->get_result();

if($enrollment && $enrollment->num_rows > 0){
   echo "You are already enrolled in this Course";
}
else{
   $stmt = $conn->prepare("INSERT INTO enrollments (student_id,course_id) VALUES(?,?)");
   $stmt->bind_param("ii",$username,$course_id);
   $stmt->execute();

   echo "Successfully enrolled in the course";
}
$stmt->close();
?>