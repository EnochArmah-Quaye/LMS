<?php
//Connection to the database

$servername="localhost";
$user="root";
$dbpassword = "";
$dbname="lms1";

$conn = mysqli_connect($servername,$user,$dbpassword,$dbname);

if(!$conn){
    die("Connection Failed: ".mysqli_connect_error());
}
//echo"<p>Connected Successfully</p>";

?>