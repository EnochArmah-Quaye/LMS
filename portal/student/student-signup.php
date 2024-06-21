<?php

require_once('../../scripts/conn.php');

if(isset($_POST['submit'])){
    $firstName= $_POST['firstname'];
    $lastName= $_POST['lastname'];
    $dob= $_POST['Dob'];
    $email= $_POST['email'];
    $contact= $_POST['contact'];
    $username= $_POST['username']; 
    $password= $_POST['password1'];

    $sql= "INSERT INTO student (id, firstName, lastName, dob, email, contact, userName, password1) 
    VALUES('0','$firstName', '$lastName', '$dob', '$email', '$username', '$password')";

    $rsl= mysqli_query($conn,$sql);

    if(!$rsl){
        echo"<p> Student Profile Created Successfully</p>";
    }
    else{
        echo"<p>Student Profile Was Not Created</p>";
    }
}
 ?>