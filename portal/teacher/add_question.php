<?php

require_once('../../scripts/conn.php');

if(isset($_POST['submit'])){
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $test_id = $_POST['test_id'];
        $question_text = $_POST['question_text'];
        $answers = $_POST['answers'];
        $correct_answer = $_POST['correct_answer'];

        $stmt = $conn->prepare("INSERT INTO questions (test_id, question_text) VALUES (?,?)");
        $stmt->bind_param("is",$test_id,$question_text);

        if($stmt->execute()){
            $question_id = $stmt->insert_id;
            
            foreach($answers as $answer){
                $is_correct = ($answer === $correct_answer)? 1 : 0;
                $stmt_answer = $conn->prepare("INSERT INTO answers (question_id, answer_text, is_correct) VALUES (?, ?, ?)");
                $stmt_answer->bind_param("isi", $question_id, $answer, $is_correct);
                $stmt_answer->execute();
                $stmt_answer->close();
            }
            echo "Questions and Answers added Successfully";
        }
        else{
            echo "Error: Could not add question.";
        }
        $stmt->close();
    }
}

?>