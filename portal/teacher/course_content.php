<?php

require_once('../../scripts/conn.php');

if(isset($_POST['submit'])){
    $course_id = $_POST['course_id'];
    $intro = $_POST['intro'];
    $lesson_1 = $_POST['lesson1'];
    
    $lesson_2 = $_POST['lesson2'];
    

    $resources = ['resource1','resource2'];

    $files = [];
    
    foreach ($resources as $resource) {
       $file_name = $_FILES[$resource]['name'];
       $file_tmp = $_FILES[$resource]['tmp_name'];
       $file_size = $_FILES[$resource]['size'];
       $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

       if($file_ext !== 'pdf'){
        echo "<div>File must be a pdf</div>";  
          }
       else{
        $target_path ="../../pdf/" . basename($file_name); 
       
        if(move_uploaded_file($file_tmp, $target_path)){
            $files [] = $target_path ; 
        }
       else{
        echo "<div> File upload Failed </div>";
       }
       }
    }


    $stmt = $conn->prepare("INSERT INTO course_content (course_id, intro, lesson1, resource1, lesson2, resource2) VALUES(?,?,?,?,?,?)");
    $stmt->bind_param("isssss", $course_id, $intro, $lesson_1, $files[0], $lesson_2, $files[1]);
    
    if($stmt->execute()){
        echo "<div>Course Content Added Successfully</div>";
    }

    
}
?>