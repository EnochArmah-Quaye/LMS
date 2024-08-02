<?php
    require_once('../../scripts/conn.php');

    if(isset($_POST['submit'])){
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $date_of_birth = $_POST['Dob'];
        $username = $_POST['username'];
        $password = $_POST['password1'];
        $email = $_POST['email'];
        $contact = $_POST['contact'];
        $description = $_POST['description'];
        $cert = $_POST['Cert'];
        
    }
?>