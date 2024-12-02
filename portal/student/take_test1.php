<?php

require_once('../../scripts/conn.php');

if(!isset($_GET['course_id'])){
    echo "Test can't be found.";
    exit;
}

$course_id = $_GET['course_id'];

$stmt = $conn->prepare("SELECT id from tests WHERE course_id = ?");
$stmt->bind_param("i",$course_id);
$stmt->execute();
$rsl = $stmt->get_result();
$rsl1 = $rsl->fetch_assoc();
$result = $rsl1['id'];

echo $result;

?>