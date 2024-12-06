<?php
//I certify that this submission is my own original work
echo <<<_ABC

<h3>User Log In</h3>

<form method = "post" action = "authenticate.php">
	Username: <input type = "text" name = "username"><br>
	Password: <input type = "password" name = "password"><br>
	<input type = "submit" value = "Log In">
</form>

_ABC;

?>