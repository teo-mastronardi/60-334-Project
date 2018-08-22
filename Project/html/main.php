<?php // admin.php
  require_once 'login.php';
  if ($conn->connect_error) die($conn->connect_error);

  // Get the row of the highest rated book
  $query  = "SELECT * FROM book WHERE rating = (SELECT MAX(rating) from book)";
  $result = $conn->query($query);

  if (!$result) die ("Database access failed: " . $conn->error);
  $row = $result->fetch_array(MYSQL_BOTH);

  $highestRatedBookTitle  = $row[2];
  $highestRatedBookAuthor = $row[1];
  $highestRatedBookISBN   = $row[0];
  $highestRatedBookTimes  = $row[3];
  $highestRatedBookCateg  = $row[4];


    // Get the row of the most borrowed book
  $query  = "SELECT * FROM book WHERE times_borrowed = (SELECT MAX(times_borrowed) from book)";
  $result = $conn->query($query);

  if (!$result) die ("Database access failed: " . $conn->error);
  $row = $result->fetch_array(MYSQL_BOTH);

  $mostBorrowedBookTitle  = $row[2];
  $mostBorrowedBookAuthor = $row[1];
  $mostBorrowedBookISBN   = $row[0];
  $mostBorrowedBookRating  = $row[5];
  $mostBorrowedBookCateg  = $row[4];


  $result->close();
  $conn->close();

  function get_post($conn, $var)
  {
    return $conn->real_escape_string($_POST[$var]);
  }
?>
