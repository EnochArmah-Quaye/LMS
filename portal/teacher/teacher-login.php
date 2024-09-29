<?php
require_once('../../scripts/conn.php');

if (session_status() == PHP_SESSION_NONE) {
   session_start();
}

if (isset($_POST['submit'])) {
    $username = $_POST['userName'];
    $password = $_POST['password1'];

    // Fetch the user based on the username
    $sql = "SELECT * FROM teacher WHERE userName = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();

        // Use password_verify to check the entered password against the stored hashed password
        if (password_verify($password, $row['password2'])) {
            if ($row['usertype'] == 'teacher') {
                $_SESSION['username'] = $username;
                $_SESSION['usertype'] = 'teacher';

                error_log("Session set for user: " . $_SESSION['username']);

                header("Location:teacher-homepage.php");
                
            } else {
                echo "<div>Invalid user type</div>";
            }
        } else {
            echo "<div>Invalid password</div>";
        }
    } else {
        echo "<div>Invalid username</div>";
    }
    //exit();
}
?>