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

    if(mysqli_num_rows($rsl) == 1)
}

?>