<?php 

require_once('../../scripts/conn.php');
session_start();

if(!isset($_SESSION['id'])){
    echo "Log in before you can access this page";
    exit();
}

require "../../vendor/autoload.php";

use GeminiAPI\Client;
use GeminiAPI\Resources\Parts\TextPart;

$student_id = $_SESSION['id'];

$stmt = $conn->prepare("SELECT incorrect_answer FROM test_score WHERE student_id=?");
$stmt->bind_param("i", $student_id);
$stmt->execute();
$result = $stmt->get_result();

$data = $result->fetch_assoc();
$json_data = json_encode($data);

$client = new Client("AIzaSyDP39zhCDBvqIbEjp_19qMcX8kj3Be7X30");

$response = $client->geminipro()->generateContent(new TextPart($json_data));

echo $response->text();


?>