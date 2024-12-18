<?php

require_once('../../scripts/conn.php');
session_start();

if(!isset($_SESSION['id'])){
    echo "Please log in to view your enrolled courses";
    exit;
}

$user_id = $_SESSION['id'];

$stmt = $conn->prepare("SELECT courses.id, courses.title, courses.description FROM courses JOIN enrollments ON courses.id = enrollments.course_id WHERE enrollments.student_id = ? ");
$stmt->bind_param("i",$user_id);
$stmt->execute();

$result = $stmt->get_result();

if($result){
    echo "<html lang='en'>";
    echo "<head>
        <meta charset='UTF-8'>
        <meta http-equiv='X-UA-Compatible' content='IE=edge'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Document</title>
        <link rel='stylesheet' href='../../dist/css/main.css' >
        <script src='../../js/bootstrap.bundle.min.js'></script>
    </head>
    <body>
    <div class='container'>";
    while($row = $result->fetch_assoc()){
        echo "<div>";
        echo "<h2>".htmlspecialchars($row['title'])."</h2>";
        echo "<p>".htmlspecialchars($row['description'])."</p>";
        echo "<a href='view_course.php?course_id=".$row['id']."'.>View Course</a>";
        echo "</div>";
    }
    echo "</div>
    </body>
    </html>";
   
}
else{
    echo "You are not enrolled in this course";
}

?>