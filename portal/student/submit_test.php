<?php 

require_once("../../scripts/conn.php");
session_start();

if(!isset($_SESSION['id'])){
    echo "Please log in to access test";
    exit();
}

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $test_id = intval($_POST['test_id']);
    $student_id = $_SESSION['id'];
    $answers = $_POST['answers'];


    $score = 0;

    foreach($answers as $question_id => $answer_id){
        $stmt = $conn->prepare("SELECT is_correct FROM answers WHERE id = ?");
        $stmt->bind_param("i",$answer_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $answer = $result->fetch_assoc();

        if($answer && $answer['is_correct'] == 1 ){
            $score++;
        }
    }

    $stmt = $conn->prepare("INSERT INTO test_score (student_id, test_id, score) VALUES(?,?,?)");
    $stmt->bind_param("iii",$student_id,$test_id,$score);

    if($stmt->execute()){
        echo "Test submitted successfully! Your score is" . $score;
    }
    else{
        echo "Error: Could not save your score.";
    }

}

?>