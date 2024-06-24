<?php

require_once('../../scripts/conn.php');

if(isset($_POST['submit'])){
    $firstName= $_POST['firstname'];
    $lastName= $_POST['lastname'];
    $dob= $_POST['Dob'];
    $email= $_POST['email'];
    $contact= $_POST['contact'];
    $username= $_POST['username']; 
    $password= $_POST['password'];

    $sql= "INSERT INTO student (id,firstName,lastName,dob,email,contact,userName,password1) VALUES('0','$firstName','$lastName','$dob','$email','$contact','$username','$password')";

    $rsl= mysqli_query($conn,$sql);

    if($rsl){
        echo"<script>alert('Student Profile Created Successfully');</script>";
    }
    else{
        echo"<script>alert('Student Profile Was Not Created');</script>";
    }
}
mysqli_close($conn);
 ?>