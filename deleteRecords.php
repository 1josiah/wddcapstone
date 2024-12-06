<?php //I certify that this submission is my own original work
session_start();

if (!isset($_SESSION['username']))
  {
      header("location: userlogin.php");
      exit;
}

$username = htmlspecialchars($_SESSION['username']);
	
echo <<<_END
<h3><a href='mainMenu.php'>Return to menu</a></h3>
<h2>Select a record to delete:</h2>
_END;

require_once 'dblogin.php';

try
  {
    $pdo = new PDO($attr, $user, $pass, $opts);
  }
  catch (PDOException $e)
  {
    throw new PDOException($e->getMessage(), (int)$e->getCode());
  }
  
  if (isset($_POST['delete']) && isset($_POST['eid']))
  {
    $eid   = get_post($pdo, 'eid');
    $query  = "DELETE FROM employees WHERE eid=$eid";
    $result = $pdo->query($query);
  }

  $query  = "SELECT * FROM employees";
  $result = $pdo->query($query);

  while ($row = $result->fetch())
  {
    $r0 = htmlspecialchars($row['eid']);
    $r1 = htmlspecialchars($row['firstname']);
    $r2 = htmlspecialchars($row['lastname']);
    $r3 = htmlspecialchars($row['email']);
    $r4 = htmlspecialchars($row['phone']);
    $r5 = htmlspecialchars($row['department']);
    $r6 = htmlspecialchars($row['hiredate']);
    
    echo <<<_END
  <pre>
    EID $r0
    FirstName $r1
    LastName $r2
    Email $r3
    Phone $r4
    Department $r5
    HireDate $r6
  </pre>
  <form action='deleteRecords.php' method='post'>
  <input type='hidden' name='delete' value='yes'>
  <input type='hidden' name='eid' value='$r0'>
  <input type='submit' value='DELETE RECORD'></form>
_END;
}

function get_post($pdo, $var)
  {
    return $pdo->quote($_POST[$var]);
  }

?>