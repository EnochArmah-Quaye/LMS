<?php 

require_once('../../scripts/conn.php');

session_start();

if(!isset($_SESSION['id'])){
    echo "<div> Please log in to view this course </div>";
    exit();
}

$course_id = $_GET['course_id'];
$student_id = $_SESSION['id'];
//echo $student_id;

$stmt = $conn->prepare("SELECT * FROM courses WHERE id = ?");
$stmt->bind_param("i",$course_id);
$stmt->execute();
$result = $stmt->get_result();

$course = $result->fetch_assoc();

if($course){
    echo "<h1>".htmlspecialchars($course['title'])."</h1>";
    echo "<p>".htmlspecialchars($course['description'])."</p>";
}
else{
    echo "<div> Course was not found </div>";
}

$stmt1 = $conn->prepare("SELECT * FROM course_content WHERE course_id = ?");
$stmt1->bind_param("i",$course_id);
$stmt1->execute();
$result1 = $stmt1->get_result();



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Course</h1>
    <?php if($result1->num_rows > 0 ) {?>
        <table >
        <tr>
            <th>ID</th>
            <th>Course ID</th>
            <th>Introduction</th>
            <th>Lesson 1</th>
            <th>Resource</th>
            <th>Lesson 2</th>
            <th>Resource</th>
        </tr>
        <?php  while($row = $result1->fetch_assoc()){?>
            <tr>
                <td><?php echo htmlspecialchars($row['id']); ?></td>
                <td><?php echo htmlspecialchars($row['course_id']); ?></td>
                <td><?php echo htmlspecialchars($row['intro']) ;?></td>
                <td><?php echo htmlspecialchars($row['lesson1']); ?></td>
                <td>
                    <?php if(!empty($row['resource1'])) {?>
                        <a href="<?php echo htmlspecialchars($row['resource1']); ?>" download>
                           <?php echo htmlspecialchars($row['resource1']);?>
                        </a>
                    <?php } ?>
                </td>
                <td><?php echo htmlspecialchars($row['lesson2']); ?></td>
                <td>
                    <?php if(!empty($row['resource2'])){ ?>
                        <a href="<?php echo htmlspecialchars($row['resource2']) ?>" download>
                           <?php echo htmlspecialchars($row['resource2'])?>                    
                        </a>
                    <?php } ?>   
                     
                </td>
            </tr>
        <?php } ?> 
        </table> 
        <?php } else{?>
            <p>No Courses Found</p>
    <?php } ?>
   <?php echo "<button><a href='take_test.php?course_id=".$course_id."'>Take a test</a></button>" ?>
</body>
</html> 