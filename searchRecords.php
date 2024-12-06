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
  
  echo "<h2>Select a category to search in and enter your desired data:</h2>";
  
  echo <<<_END
   <label for="search">Category:</label>
   <select id="search" name="search" size="1">
   <option value="eid">EID</option>
   <option value="firstname">FirstName</option>
   <option value="lastname">LastName</option>
   <option value="phone">Phone</option>
   <option value="email">Email</option>
   <option value="department">Department</option>
   <option value="hiredate">HireDate</option>
</select>
    <form action = "searchRecords_process.php" method="post">
    Search <input type="text" name="criteria">
    <input type="submit" value="Search">
    </form>
_END; 
 
?>