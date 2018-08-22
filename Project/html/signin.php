<?php // signin.php
    require_once 'login.php';
    if ($conn->connect_error) die("Connection Failed: " . $conn->connect_error);

      //Getting users input from login form
      $email    = $_POST['email'];
      $password = $_POST['password'];
      // Escape to prevent sql inject
      $email    = stripcslashes($email);
      $password = stripcslashes($password);
      $email    = $conn->real_escape_string($email);
      $password = $conn->real_escape_string($password);

      // Get Users access level via type
      $typeQuery  = "SELECT type FROM users WHERE email = '$email'";
      $typeResult = $conn->query($typeQuery);
      $level = mysqli_fetch_array($typeResult);

      // Validate
      $checkQuery = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
      $checkResult = mysqli_query($conn, $checkQuery);
      $checkResult = $conn->query($checkQuery);
      $rows = mysqli_fetch_array($checkResult);

      if ($rows['email'] == $email && $rows['password'] == $password) {
        echo "Welcome <b>" . $rows['firstName'] . "</b></p>";
        session_start();
        $_SESSION['user_login'] = $email;
        $_SESSION['user_level'] = $level['type'];
        header("Location: http://mastr11i.myweb.cs.uwindsor.ca/60334/project/html/index.php");

      }

      else{
        echo "<p>Username or password invalid, please <a href='http://mastr11i.myweb.cs.uwindsor.ca/60334/project/html/index.php'>try again</a></p>";
      }
?>
