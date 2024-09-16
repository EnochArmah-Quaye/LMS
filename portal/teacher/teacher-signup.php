<?php
    require_once('../../scripts/conn.php');

    if(isset($_POST['submit'])){
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $date_of_birth = $_POST['Dob'];
        $username = $_POST['username'];
        $password = $_POST['password1'];
        $email = $_POST['email'];
        $contact = $_POST['contact'];
        $description = $_POST['description'];
       
       if(isset($_FILES['Cert']['firstname']))
       {
        //Check if the Cert field has an attachment
          $file_name = $_FILES['Cert']['firstname'];
          $file_tmp = $_FILES['Cert']['tmp_name'];

          //Move the uploaded file into the pdf folder
          move_uploaded_file($file_tmp,'../../pdf/'.$file_name);

          $insertquery = "INSERT INTO teacher(firstName,lastName,dob,userName,password2,email,contact,description1,file1)
           VALUES('$firstname','$lastname','$date_of_birth','$username','$password','$email','$contact','$description')";

           $result = mysqli_query($conn,$insertquery);

           if($result){
            echo"<html lang='en'>
            <head>
                <meta charset='UTF-8'>
                <meta http-equiv='X-UA-Compatible' content='IE=edge'>
                <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                <title>Document</title>
                <link rel='stylesheet' href='../../dist/css/main.css'>
                <script src='../../js/bootstrap.bundle.min.js'></script>
            </head>
            <body>
               <div class='alert alert-success' role='alert'>
                 <a class='close' data-dismiss='alert' aria-label='close'>x</a>
                 <strong>Success!</strong> Data submitted successfully.
               </div>
            </body>
            </html>";
           }
           else{
            echo "<div class='alert alert-danger' role='alert'>
                    <a class='close' data-dismiss='alert' araia-label='close'>x</a>
                    <strong>Failed!</strong> Try Again
            </div>";
           }
       } 
       else{
         echo "<div class='alert alert-danger' role='alert'>
               <a class='close' data-dismiss='alert' aria-label='close'>x</a>
               <strong>Failed!</strong> File must be uploaded in PDF Format!
         </div>";
       }

    }
?>