<?php //register.php
  //connecting to database
  require_once "login.php";
  if ($conn->connect_error) die("Connection failed" . $conn->connect_error);

  // et names from form inputs from form
  $fname = $_POST['fname'];
  $lname = $_POST['lname'];
  $type = $_POST['inlineRadioOptions'];
  $email = $_POST['email'];
  $password = $_POST['password'];


  //salts to encrypt sensitive information
  $salt1 = "qm&h*";
  $salt2 = "pg!@";

  //using the ripemd128 hash function to encrypt  email and passwords with specified salts
  $hashemail = hash('ripemd128', "$salt1$email$salt2");
  $hashpass = hash('ripemd128', "$salt1$password$salt2");


  //query to insert hashed information along with form information

  $query = "INSERT INTO users VALUES" .
            "(default, '$fname', '$lname', '$email', '$password', '$type')";
  $result   = $conn->query($query);

  if (!$result) echo "INSERT failed: $query<br>" .
      $conn->error . "<br><br>";
  //closing prepare query and connection

  if (!$result->execute()) {
    echo "<p></br>Username already active, please <a href='http://mastr11i.myweb.cs.uwindsor.ca/60334/project/html/index.php'>try again</a></p>";
    //output if the user registration is complete
    //will email all account information to email specified in login
  }
   else {
      echo "<p>Registration complete! Go to <a href='http://mastr11i.myweb.cs.uwindsor.ca/60334/project/html/index.php'>BookStore </a>to log in!</p>";
      $subject = "BookStore Account Information";
      $header  = "Account information: ";
      $account = "First Name: "     . $fname. "</br>".
                 "Last name: " . $lname. "</br>".
                 "Email: " . $_POST['email']. "</br>".
                 "User level: "    . $type. "</br>".
                 "Encrypted Password: " . $hashpassword;
      mail($_POST['email'], $subject, $account, $header);
    }
  $query->close();
  $conn->close();
?>
