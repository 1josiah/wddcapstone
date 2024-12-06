//I certify that this submission is my own original work
<?php
session_start();

if (!isset($_SESSION['username']))
  {
      header("location: userlogin.php");
      exit;
}

$username = htmlspecialchars($_SESSION['username']);
	
echo("<h3><a href='mainMenu.php'>Return to menu</a></h3>");

require_once 'dblogin.php';

  try
  {
    $pdo = new PDO($attr, $user, $pass, $opts);
  }
  catch (PDOException $e)
  {
    throw new PDOException($e->getMessage(), (int)$e->getCode());
  }
  
  if(isset($_POST['search']) && (isset($_POST['criteria'])))
  {
	  $search = $_POST['search'];
	  $criteria = $_POST['criteria'];
	  
	  $query = "SELECT * FROM employees WHERE $search = $criteria";
	  $result = $pdo->query($query);
	  
	  echo "<table><tr> <th>EID</th> <th>FirstName</th> <th>LastName</th> <th>Email</th> <th>Phone</th> <th>Department</th> <th>HireDate</th>";

while($row = $result->fetch(PDO::FETCH_NUM))
{
	echo "<tr>";
	for($k = 0; $k < 7; ++$k)
		echo "<td>" . htmlspecialchars($row[$k]) . "</td>";
	echo "</tr>";
}

echo "</table";
  }
  
  else {
	  echo <<<_END
	"An error occured"<br>
	"Click <a href="searchRecords.php">here</a> to try again."
	_END;
  }
?>