<?php

require_once('../../scripts/conn.php');
session_start();

if(!isset($_GET['course_id'])){
    echo "Test can't be found.";
    exit;
}
if(!isset($_SESSION['id'])){
    echo "Log in to access test";
    exit;
}

$course_id = $_GET['course_id'];


$stmt = $conn->prepare("SELECT id, title from tests WHERE course_id = ?");
$stmt->bind_param("i",$course_id);
$stmt->execute();
$rsl = $stmt->get_result();
$rsl1 = $rsl->fetch_assoc();

if(!$rsl1){
    echo "Test not Found.";
    exit;
}

echo "<h1>Test: " . htmlspecialchars($rsl1['title']) . "</h1>";

$test_id = $rsl1['id'];

//Fetch questions and their answers
$stmt1 = $conn->prepare("SELECT q.id AS question_id, q.question_text, a.id AS answer_id, a.answer_text
                             FROM questions q JOIN answers a ON q.id = a.question_id WHERE q.test_id = ? ");
$stmt1->bind_param("i",$test_id);
$stmt1->execute();
$question_result = $stmt1->get_result();

$questions = [];
while($row = $question_result->fetch_assoc()){
    
    $questions[$row['question_id']]['text'] = $row['question_text']; 
    $questions[$row['question_id']]['answers'][] = [
        'id' => $row['answer_id'],
        'text' => $row['answer_text']
    ]; 
    

}

//echo $result;

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="submit_test.php" method="POST">
        <input type="hidden" name="test_id" value="<?php echo "$test_id"; ?>"/>
        <?php foreach($questions as $question_id => $question){ ?>
            <div>
                <h3><?php echo htmlspecialchars($question['text']); ?></h3>
                <?php foreach($question['answers'] as $answer) {?>
                    <label>
                        <input type="radio" name="answers[<php echo $question_id; ?>]" value="<?php echo $answer['id'] ?>" required />
                        <?php echo htmlspecialchars($answer['text']); ?>
                    </label>
                <?php }?>    
            </div>
        <?php }?>
        <button type="submit">Submit Test</button>
    </form>
</body>
</html>