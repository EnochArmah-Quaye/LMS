<?php
  session_start();

  if(!isset($_SESSION["username"])){
    header("location:../../index.html");
  }
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../styles/student-homepage.css">
    <link rel="stylesheet" href="../../dist/css/main.css" >
    <script src="../../js/bootstrap.bundle.min.js"></script>
</head>
<body>
  <div class="">
    
    <div id="sidebar">
    <div><?php echo $_SESSION["username"]; echo $_SESSION["id"]?></div>
      <ul class="nav flex-column">
        <li class="nav-item">
         <a class="nav-link" href="#">Courses</a>
        </li>
        <li class="nav-item">
         <a class="nav-link" href="#">Courses</a>
       </li>
       <li class="nav-item">
        <a class="nav-link" href="#">Courses</a>
       </li>
       <li class="nav-item">
        <a class="nav-link" href="list-courses.php">Enroll in a Course</a>
       </li>
       <li class="nav-item">
        <a class="nav-link" href="../../chatbot/chatbot.html">General Assistant</a>
        <a class="nav-link" href="../../chatbot2/chatbot2.html">Personal Assistant</a>
       </li>
       <a href="../../scripts/logout.php" class="btn btn-primary">Logout</a>
     </ul>
    </div>
    <div id="content">
    <h1>Hello World</h1>
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorum rem sunt,<br/>
       laborum est quod tenetur porro,
        exercitationem reiciendis illo quas quisquam labore dolor earum,
               ex ullam eaque magnam nesciunt fugiat.</p> 
    </div>
  </div>  
</body>
</html>