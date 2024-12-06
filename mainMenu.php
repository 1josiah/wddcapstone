//I certify that this submission is my own original work
<?php
session_start();

if (!isset($_SESSION['username']))
  {
      header("location: userlogin.php");
      exit;
}
    $username = htmlspecialchars($_SESSION['username']);

    echo "You are logged in as $username.<br>";
    echo "<br> Please <a href='logout.php'>click here</a> to log out.";

echo <<<_END
<h2>Welcome to the Employee Database</h2>
<h3>What would you like to do?</h3>

<ul>
<li><a href="listRecords.php">List Records</a></li>
<li><a href="addRecords.php">Add Records</a></li>
<li><a href="searchRecords.php">Search for Records</a></li>
<li><a href="deleteRecords.php">Delete Records</a></li>
</ul>

_END;
?>