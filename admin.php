<?php // admin.php
  require_once 'login.php';
  $conn = new mysqli($hn, $un, $pw, $db);
  if ($conn->connect_error) die($conn->connect_error);

  if (isset($_POST['delete']) && isset($_POST['isbn']))
  {
    $isbn   = get_post($conn, 'isbn');
    $query  = "DELETE FROM book WHERE isbn='$isbn'";
    $result = $conn->query($query);
  	if (!$result) echo "DELETE failed: $query<br>" .
      $conn->error . "<br><br>";
  }

  if (isset($_POST['isbn'])           &&
      isset($_POST['author'])         &&
      isset($_POST['title'])          &&
      isset($_POST['times_borrowed']) &&
      isset($_POST['category'])       &&
      isset($_POST['rating'])         &&
      isset($_POST['borrowed']))
  {
    $isbn     = get_post($conn, 'isbn');
    $author   = get_post($conn, 'author');
    $title    = get_post($conn, 'title');
    $times_borrowed = get_post($conn, 'times_borrowed');
    $category = get_post($conn, 'category');
    $rating   = get_post($conn, 'rating');
    $borrowed = get_post($conn, 'borrowed');


    $query    = "INSERT INTO book VALUES" .
      "('$isbn', '$author', '$title', '$times_borrowed', '$category', '$rating', '$borrowed' )";
    $result   = $conn->query($query);

  	if (!$result) echo "INSERT failed: $query<br>" .
      $conn->error . "<br><br>";
  }

  echo <<<_END
  <form action="admin.php" method="post"><pre>
    Author <input type="text" name="author">
     Title <input type="text" name="title">
  Category <input type="text" name="category">
      ISBN <input type="text" name="isbn">
  Borrowed <input type="text" name="borrowed">
    Rating <input type="text" name="rating">
# Borrowed <input type="text" name="times_borrowed">
           <input type="submit" value="ADD RECORD">
  </pre></form>
_END;

  $query  = "SELECT * FROM book";
  $result = $conn->query($query);
  if (!$result) die ("Database access failed: " . $conn->error);

  $rows = $result->num_rows;

  for ($j = 0 ; $j < $rows ; ++$j)
  {
    $result->data_seek($j);
    $row = $result->fetch_array(MYSQLI_NUM);

    echo <<<_END
  <pre>
    Author $row[1]
     Title $row[2]
  Category $row[4]
      ISBN $row[0]
    Rating $row[5]
# Borrowed $row[3]
  Borrowed $row[6]
  </pre>
  <form action="admin.php" method="post">
  <input type="hidden" name="delete" value="yes">
  <input type="hidden" name="isbn" value="$row[4]">
  <input type="submit" value="DELETE RECORD"></form>
_END;
  }

  $result->close();
  $conn->close();

  function get_post($conn, $var)
  {
    return $conn->real_escape_string($_POST[$var]);
  }
?>
