<?php 

require_once('../../scripts/conn.php');
session_start();

if(!isset($_SESSION['id'])){
    echo "Log in before you can access this page";
    exit();
}

require "../../vendor/autoload.php";

use GeminiAPI\Client;
use GeminiAPI\Enums\ModelName;
use GeminiAPI\Resources\Parts\TextPart;

$student_id = $_SESSION['id'];

$stmt = $conn->prepare("SELECT question_text,incorrect_answer FROM test_score WHERE student_id=?");
$stmt->bind_param("i", $student_id);
$stmt->execute();
$result = $stmt->get_result();

$data = $result->fetch_assoc();
$json_data = json_encode($data);
echo $json_data;

$client = new Client("AIzaSyDP39zhCDBvqIbEjp_19qMcX8kj3Be7X30");

$response = $client
           // ->withV1BetaVersion()
            ->geminiPro()
            //->withSystemInstruction('You are an AI module created to suggest learning paths for students based on their performance on a test in a LMS.')
            ->generateContent(new TextPart($json_data));

  echo $response->text();



?>