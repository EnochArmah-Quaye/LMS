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
    $question_id = intval($_POST['question_id']);
    $question_text = $_POST['question_text'];
    echo $question_text;


    $score = 0;
    $answer_text = "";
    $status = 0;

    foreach($answers as $question_id => $answer_id){
        $stmt = $conn->prepare("SELECT is_correct, answer_text FROM answers WHERE id = ?");
        $stmt->bind_param("i",$answer_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $answer = $result->fetch_assoc();
        $answer_text1 = $answer["answer_text"];
       //echo $answer_text;

        if($answer && $answer['is_correct'] == 1 ){
            $score++;
            $status = 1;
        
            $stmt = $conn->prepare("INSERT INTO test_score (student_id, test_id, score, question_text, status1) VALUES(?,?,?,?,?)");
            $stmt->bind_param("iiisi",$student_id,$test_id, $score,$question_text,$status);
            $stmt->execute();

            echo "The answer you privided was correct. Your score is". $score;
        }
        else{
            $status = 0;
            $stmt= $conn->prepare("INSERT INTO test_score (student_id, test_id, score, incorrect_answer, question_text, status1 ) VALUES(?,?,?,?,?,?)");
            $stmt->bind_param("iiissi", $student_id,$test_id, $score,$answer_text1, $question_text, $status );
            $stmt->execute();
            
            echo "The answer you provided was wrong. Your score is" . $score;
            echo "<br/>";
            echo "<button><a href='learn_path.php?'>Suggest a new learning path</a></button>";
        }
    }

    

  

}

?>