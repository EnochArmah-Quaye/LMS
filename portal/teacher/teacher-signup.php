<?php
    require_once('../../scripts/conn.php');

   /* if(isset($_POST['submit'])){
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $date_of_birth = $_POST['Dob'];
        $username = $_POST['username'];
        $password = $_POST['password1'];
        $email = $_POST['email'];
        $contact = $_POST['contact'];
        $description = $_POST['description'];

        echo "<div>This part works fine</div>";
       
       if(isset($_FILES['Cert']))
       {
        //Check if the Cert field has an attachment
          $file_name = $_FILES['Cert'];
          $file_tmp = $_FILES['Cert']['tmp_name'];

          //Move the uploaded file into the pdf folder
          move_uploaded_file($file_tmp,"../../pdf/".$file_name);

          $insertquery = "INSERT INTO teacher (firstName,lastName,dob,userName,password2,email,contact,description1,file1)
           VALUES('$firstname','$lastname','$date_of_birth','$username','$password','$email','$contact','$description','$file_name')";

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

    }*/

    if(isset($_POST['submit'])){
      $firstname = $_POST['firstname'];
      $lastname = $_POST['lastname'];
      $date_of_birth = $_POST['Dob'];
      $username = $_POST['username'];
      $password = $_POST['password1'];
      $email = $_POST['email'];
      $contact = $_POST['contact'];
      $description = $_POST['description'];

      echo "<div>This part works fine</div>";

      if(isset($_FILES['Cert']) && $_FILES['Cert']['error'] === UPLOAD_ERR_OK) {
          $file_name = $_FILES['Cert']['name'];
          $file_tmp = $_FILES['Cert']['tmp_name'];
          $file_size = $_FILES['Cert']['size'];
          $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

          // Check if file is a PDF
          if ($file_ext !== 'pdf') {
              echo "<div class='alert alert-danger' role='alert'>
                      <a class='close' data-dismiss='alert' aria-label='close'>x</a>
                      <strong>Failed!</strong> File must be in PDF format!
                    </div>";
          } else {
              // Move the uploaded file into the pdf folder
              $target_path = "../../pdf/" . basename($file_name);
              if (move_uploaded_file($file_tmp, $target_path)) {
                  // Prepare and execute the SQL query
                  $stmt = $conn->prepare("INSERT INTO teacher (firstName, lastName, dob, userName, password2, email, contact, description1, file1) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
                  $stmt->bind_param("sssssssss", $firstname, $lastname, $date_of_birth, $username, $password, $email, $contact, $description, $file_name);

                  if ($stmt->execute()) {
                      echo "<html lang='en'>
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
                  } else {
                      echo "<div class='alert alert-danger' role='alert'>
                              <a class='close' data-dismiss='alert' aria-label='close'>x</a>
                              <strong>Failed!</strong> SQL Error: " . $stmt->error . "
                            </div>";
                  }

                  $stmt->close();
              } else {
                  echo "<div class='alert alert-danger' role='alert'>
                          <a class='close' data-dismiss='alert' aria-label='close'>x</a>
                          <strong>Failed!</strong> File upload error.
                        </div>";
              }
          }
      } else {
          echo "<div class='alert alert-danger' role='alert'>
                  <a class='close' data-dismiss='alert' aria-label='close'>x</a>
                  <strong>Failed!</strong> File must be uploaded.
                </div>";
      }
  }
?>