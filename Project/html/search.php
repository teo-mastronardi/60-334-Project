<?php // search.php
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
      <title>My BookStore</title>

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
    <body class="text-center">
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
        </div>          <?php if(isset($_SESSION['user_login']) && !empty($_SESSION['user_login'])) {
                          echo <<<_END
                          <a href="profile.php" class="btn btn-primary mr-4">Profile</a>
_END;
                        }
                        else{
                          echo <<<_END
                          <a class="btn btn-light mr-4" data-toggle="modal" data-target="#signInModal">Sign In</a>
_END;
                        }
                  ?>
      </nav>
            <!-- END OF NAV BAR -->

  <!-- Sign In Modal -->
  <div class="modal fade" id="signInModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Sign in</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form role="form" action="signin.php" method="POST">
            <label for="inputEmail" class="sr-only">Email address</label>
            <input type="email" id="inputEmail" name="email" class="form-control my-1" placeholder="Email address" required autofocus>
            <label for="inputPassword" class="sr-only">Password</label>
            <input type="password" id="inputPassword" name="password" class="form-control my-1" placeholder="Password" required>
            <div class="checkbox my-1">
              <label>
                <input type="checkbox" value="remember-me"> Remember me
              </label>
            </div>
            <button type="submit" class="btn btn-outline-primary btn-lg btn-block">Log In</button>
          </form>
        </div>
        <div class="modal-footer">
				  <a data-dismiss="modal" data-target="#registerModal" data-toggle="modal" href="#">Register</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Register Modal -->
  <div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel2">Create an account</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form role="form" data-toggle="validator" action="register.php" method="POST">
          <div class="form-group row">
              <label for="inputfName" class="col-sm-2 col-form-label">First name</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="fname"id="inputfName" placeholder="First name" required>
              </div>
            </div>
            <div class="form-group row">
              <label for="inputlName" class="col-sm-2 col-form-label">Last name</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="lname" id="inputlName" placeholder="Last name" required>
              </div>
            </div>
            <div class="form-group row">
              <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
              <div class="col-sm-10">
                <input type="email" class="form-control" name="email" id="inputEmail" placeholder="Email" required>
              </div>
            </div>
            <div class="form-group row">
              <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
              <div class="col-sm-10">
                <input type="password" data-minlength="6" name="password" class="form-control" id="inputPassword" placeholder="Password" required>
              </div>
            </div>
            <fieldset class="form-group">
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="studentRadio" value="0">
                <label class="form-check-label" for="studentRadio">Student</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="teacerRadio" value="1">
                <label class="form-check-label" for="teacerRadio">Teacher</label>
              </div>
              </fieldset>
              <button type="submit" class="btn btn-outline-primary btn-lg btn-block">Sign Up!</button>
            </form>
          </div>
          <div class="modal-footer">
            <a data-dismiss="modal" data-target="#signInModal" data-toggle="modal" href"#">I already have an account</a>
          </div>
        </div>
      </div>
    </div>

    <!-- Beginning of Product Scroll-->
    <div class="container">
      <div class="card-deck my-4">


    <!-- Populate page with search related info -->
<?php
  // Stuff for dropdown
  $category = $_GET['search_type'];
  $query  = "SELECT * FROM book WHERE category = '$category'";
  $result = $conn->query($query);

  if (!$result) die ("Database access failed: " . $conn->error);
  $rows = $result->num_rows;

  for($i=0; $i<$rows; $i++) {
    $result->data_seek($i);
    $row = $result->fetch_array(MYSQLI_NUM);

    echo <<<_END
    <form method="GET" action="borrow.php">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">$row[2]</h5>
        <p class="card-text">By $row[1].</p>
        <input class="span2" type="hidden" id="booktitle" name="booktitle" value="$row[2]" >

        <button href="#" type="submit" class="btn btn-primary">Borrow!</button>
      </div>
    </div>
    </form>
_END;
  }

  // Stuff for search bar
  $search = $_GET['search_bar'];
  $query  = "SELECT * FROM book WHERE '$search' in (isbn, author, title, category)";
  $result = $conn->query($query);

  if (!$result) die ("Database access failed: " . $conn->error);
  $rows = $result->num_rows;

  for($j=0; $j<$rows; $j++) {
    $result->data_seek($j);
    $row = $result->fetch_array(MYSQLI_NUM);

    echo <<<_END
    <form method="GET" action="borrow.php">
    <div class="card my-4">
      <div class="card-body">
        <h5 class="card-title">$row[2]</h5>
        <p class="card-text">By $row[1].</p>
        <input class="span2" type="hidden" id="booktitle" name="booktitle" value="$row[2]" >

        <button href="#" type="submit" class="btn btn-primary">Borrow!</button>
      </div>
    </div>
    </form>
_END;
  }


?>
      </div>
    </div>

    <!-- FOOTER -->
    <footer class="py-2 bg-dark">
      <div class="container mt-2">
        <p class="text-white">&copy; 2018 BookStore Inc. &middot; <a href="#">Contact Us</a>
        </div>
      </footer>
    </body>
  </html>
