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
    $answer_text = "";

    foreach($answers as $question_id => $answer_id){
        $stmt = $conn->prepare("SELECT is_correct, answer_text FROM answers WHERE id = ?");
        $stmt->bind_param("i",$answer_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $answer = $result->fetch_assoc();
        $answer_text1 = $answer["answer_text"];
        echo $answer_text;

        if($answer && $answer['is_correct'] == 1 ){
            $score++;
        
            $stmt = $conn->prepare("INSERT INTO test_score (student_id, test_id, score) VALUES(?,?,?)");
            $stmt->bind_param("iii",$student_id,$test_id,$score);

            echo "The answer you privided was correct. Your score is". $score;
        }
        else{
            $stmt= $conn->prepare("INSERT INTO test_score (student_id, test_id, score, incorrect_answer) VALUES(?,?,?,?)");
            $stmt->bind_param("iiis", $student_id,$test_id,$score,$answer_text1);
            $stmt->execute();
            
            echo "The answer you provided was wrong. Your score is" . $score;
            echo "<br/>";
        }
    }

    

  

}

?>