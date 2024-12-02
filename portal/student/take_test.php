<?php 

require_once('../../scripts/conn.php');
session_start();

if(!isset($_GET['course_id'])){
    echo "Test can't be found.";
    exit;
}

$course_id = $_GET['course_id'];
//echo $course_id;
$stmt = $conn->prepare("SELECT title, description1, id FROM tests WHERE course_id = ? ");
$stmt->bind_param("i",$course_id);
$stmt->execute();
$result = $stmt->get_result();


while($row = $result->fetch_assoc()){
    echo "<h1>Title</h1>";
    echo "<p>".htmlspecialchars($row['title'])."</p>";
    echo "<p>".htmlspecialchars($row['description1'])."</p>";
}

echo "<button><a href='take_test1.php?course_id=".$course_id."'>Proceed to take test</a></button>";


?>