<?php // borrow.php
    require_once 'login.php';
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="description" content="">
      <meta name="author" content="">
      <link rel="icon" href="../../../../favicon.ico">
      <title>My Profile</title>

      <!-- Bootstrap Slim Js -->
      <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>

      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
      <!-- Bootstrap core CSS -->
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
      <!-- Custom styles for this template -->
      <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/examples/sign-in/signin.css" rel="stylesheet">
      <!-- Font Awesome icons -->
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">


      <!-- My stylesheet for big picture -->
      <link href="../css/landing.css" rel="stylesheet">
    </head>
  </head>
    <body>
      <!-- Navbar specific to landing- without search -->
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark static-top">
        <!-- Navbar content -->
        <a class="navbar-brand" href="index.php" style="color: white">BookStore</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNavDropdown">
          <ul class="navbar-nav">
            <form name="dropdownForm" id="dropdownForm" method="GET" action="search.php">
              <li class="nav-item dropdown">
                <input class="span2" id="search_type" name="search_type" type="hidden">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Categories
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                  <li><a class="dropdown-item" href="#" onclick="$('#search_type').val('Fiction'); $('#dropdownForm').submit()">Fiction</a></li>
                  <li><a class="dropdown-item" href="#" onclick="$('#search_type').val('non-fiction'); $('#dropdownForm').submit()">Non-Fiction</a></li>
                  <li><a class="dropdown-item" href="#" onclick="$('#search_type').val('documentary'); $('#dropdownForm').submit()">Documentary</a></li>
                  <li><a class="dropdown-item" href="#" onclick="$('#search_type').val('action & adventure'); $('#dropdownForm').submit()">Action & Adventure</a></li>
                  <li><a class="dropdown-item" href="#" onclick="$('#search_type').val('biography'); $('#dropdownForm').submit()">Biographies</a></li>
                  <li><a class="dropdown-item" href="#" onclick="$('#search_type').val('comedy'); $('#dropdownForm').submit()">Comedy</a></li>
                  <li><a class="dropdown-item" href="#" onclick="$('#search_type').val('drama'); $('#dropdownForm').submit()">Drama</a></li>
                </ul>
              </li>
            </form>
          </ul>
        </div>
          <a class="btn btn-light mr-4" href="logout.php">Sign out</a>
      </nav>
            <!-- END OF NAV BAR -->


<!-- Populate page with profile related info -->
<?php
// Show total books Borrowed, ask to rate book. Say how long this book can be borrowed for

  // Lazy way to get user type as string
  if (($_SESSION['user_level']) == 1) {
    $level = 'teacher';
  }
  if (($_SESSION['user_level']) == 0) {
    $level = 'student';
  }

  // Get User info
  $query  = "SELECT * FROM users WHERE email = '".($_SESSION['user_login'])."'";
  $result = $conn->query($query);
  if (!$result) die ("Database access failed: " . $conn->error);
  $row = $result->fetch_array(MYSQLI_NUM);

  // Get user's book_record
  $bookQuery  = "SELECT * FROM book_record WHERE userID =  '".$row[0]."'";
  $bookResult = $conn->query($bookQuery);
  if (!$bookResult) die ("Database access failed: " . $conn->error);
  $numBorrowed = $bookResult->num_rows;

  echo <<<_END
  <pre>
                     Your ID: $row[0]
                   Your Name: $row[1] $row[2]
                       Email: $row[3]
                       Level: $level
    Number of Books Borrowed: $numBorrowed
  </pre>
_END;

// For loop to get the ISBNs of books Borrowed
for ($j = 0 ; $j < $numBorrowed ; ++$j){
  $bookResult->data_seek($j);
  $bookrow = $bookResult->fetch_array(MYSQLI_NUM);
  $isbn = $bookrow[1];

   // Get User's Title books
  $booksQuery  = "SELECT * FROM book WHERE isbn = '$isbn'";
  $booksResult = $conn->query($booksQuery);
  if (!$booksResult) die ("Database access failed at book: " . $conn->error);
  $booksRow = $booksResult->fetch_array(MYSQLI_NUM);

  $title = $booksRow[2];
  $author = $booksRow[1];

  echo <<<_END
  <pre>
  You Borrowed: $title By $author.
  Rate this book from 1-5:
  <form action="profile.php" method="post">
  <input type="text" name="rate">
  <input type="hidden" name="isbn" value="$isbn">
  <input type="submit" value="Rate">
  </form>
  </pre>
_END;
}

  $bookResult->close();
  $booksResult->close();
  $result->close();
  $conn->close();

  if (isset($_POST['rate']))  {
    $rating   = get_post($conn, 'rate');
    $query1  = "UPDATE book SET rating = (rating + '$rating') / times_borrowed WHERE isbn='$isbn'";
    $result1 = $conn->query($query1);
    if (!$result1) echo "DELETE failed: $query<br>" .
      $conn->error . "<br><br>";
  }


  function get_post($conn, $var)
  {
    return $conn->real_escape_string($_POST[$var]);
  }
?>

    <!-- FOOTER -->
    <footer class="py-2 bg-dark text-center">
      <div class="container mt-2">
        <p class="text-white">&copy; 2018 BookStore Inc. &middot; <a href="#">Contact Us</a>
        </div>
      </footer>
    </body>
  </html>
