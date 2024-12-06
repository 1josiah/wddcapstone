<?php //I certify that this submission is my own original work
  session_start();

  if (isset($_SESSION['username']))
  {
    $username = $_SESSION['username'];

    destroy_session_and_data();
	
    echo htmlspecialchars("You are now logged out of $username");
		echo "<br>";
	echo("If you would like to log back in, <a href='userlogin.php'>click here</a>");
  }
  else echo "Please <a href='authenticate.php'>click here</a> to log in.";

  function destroy_session_and_data()
  {
    $_SESSION = array();
    setcookie(session_name(), '', time() - 2592000, '/');
    session_destroy();
  }
?>
