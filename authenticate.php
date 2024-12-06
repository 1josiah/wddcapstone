<?php //I certify that this submission is my own original work
  require_once 'dblogin.php';

  try
  {
    $pdo = new PDO($attr, $user, $pass, $opts);
  }
  catch (\PDOException $e)
  {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
  }

  if (isset($_POST['username']) &&
      isset($_POST['password']))
  {
    $un_temp = $_POST['username'];
    $pw_temp = $_POST['password'];
    $stmt = $pdo->prepare('SELECT * FROM user WHERE username=?');
    $stmt->bindParam(1, $un_temp);
    $stmt->execute();

    if (!$stmt->rowCount()) die("User not found<br> <a href='userlogin.php'>Return to login</a>.");

    $row = $stmt->fetch();
    $un  = $row['username'];
    $em = $row['email'];
    $pw  = $row['password'];

    if (password_verify(str_replace("'", "", $pw_temp), $pw))
    {
      session_start();
	  
	  $_SESSION['username'] = $un;

      echo htmlspecialchars("$un : Hi $un,
        you are now logged in as '$un'");
      die ("<p><a href='mainMenu.php'>Enter the Employee Database</a></p>");
    }
    else die("Invalid username/password combination.<br> <a href='userlogin.php'>Return to login</a>.");
  }
  else
  {
    echo "Please <a href='userlogin.php'>Click Here</a> to log in.";
  }
?>
