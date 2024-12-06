<?php //I certify that this submission is my own original work
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

  if (isset($_POST['eid'])   &&
      isset($_POST['firstname'])    &&
      isset($_POST['lastname']) &&
      isset($_POST['email'])     &&
      isset($_POST['phone'])     &&
      isset($_POST['department'])     &&
      isset($_POST['hiredate']))
  {
    $eid   = get_post($pdo, 'eid');
    $firstname    = get_post($pdo, 'firstname');
    $lastname = get_post($pdo, 'lastname');
    $email     = get_post($pdo, 'email');
    $phone     = get_post($pdo, 'phone');
    $department     = get_post($pdo, 'department');
    $hiredate     = get_post($pdo, 'hiredate');
    
       $query    = "INSERT INTO employees VALUES" .
      "($eid, $firstname, $lastname, $phone, $email, $department, $hiredate)";
    $result = $pdo->query($query);
	echo <<<_END
	"Entry successfully added!"<br>
	"View the updated records <a href="listRecords.php">here</a>."
	_END;
  }

  echo <<<_END
  <form action="addRecords.php" method="post"><pre>
      EID <input type="text" name="eid">
      FirstName <input type="text" name="firstname">
      LastName <input type="text" name="lastname">
      Email <input type="text" name="email">
      Phone <input type="text" name="phone">
      Department <input type="text" name="department">
      HireDate (YYYY-MM-DD Format) <input type="text" name="hiredate">
      <input type="submit" value="ADD RECORD">
  </pre></form>
_END;

  function get_post($pdo, $var)
  {
    return $pdo->quote($_POST[$var]);
  }

?>