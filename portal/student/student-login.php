<?php 

require_once('../../scripts/conn.php');

if(session_status() == PHP_SESSION_NONE){
    session_start();
}

if($_SERVER["REQUEST METHOD"]=="POST"){
    $username = $_POST["userName"];
    $password = $_POST["password"];
    
    $sql = "SELECT * from student where userName= '".$username."' AND password1= '".$password."' ";

    $rsl = mysqli_query($conn,$sql); 

    if(mysqli_num_rows($rsl) == 1){
        $row = mysqli_fetch_assoc($rsl);

        if($row['usertype'] == 'student' ){
            $_SESSION['username'] = $username;
            $_SESSION['usertype'] = 'student';
            header("Location:student-homepage.php");
        }
        else{
            echo"<p>Invalid password and username<p/>";
        }
}
}
?>