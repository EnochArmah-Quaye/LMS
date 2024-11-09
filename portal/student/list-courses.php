<?php

require_once('../../scripts/conn.php');

$stmt = "SELECT * FROM courses";
$result = $conn->query($stmt);

if($result){
    while($course = $result->fetch_assoc()) {
    echo "<div>";
    echo "<h1>".htmlspecialchars($course['title'])."</h1>";
    echo "<p>".htmlspecialchars($course['description'])."</p>";
    echo "<a href='enroll_course.php?course_id=".$course['id']."'>Enroll in this course</a>";
    echo "</div>";
    }
    $result->free();
}
else{
    echo"No courses available";
}



?>