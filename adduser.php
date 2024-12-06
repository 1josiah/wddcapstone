//I certify that this submission is my own original work
<?php // adduser.php
	require_once 'dblogin.php';

 $username = $email = $password = $cpassword = "";

  if (isset($_POST['username']))
    $username = fix_string($_POST['username']);
  if (isset($_POST['email']))
    $email    = fix_string($_POST['email']);
  if (isset($_POST['password']))
    $password = fix_string($_POST['password']);
  if (isset($_POST['cpassword']))
    $cpassword    = fix_string($_POST['cpassword']);

  $fail = "";
  $fail .= validate_username($username);
  $fail .= validate_email($email);
  $fail .= validate_password($password);
  $fail .= validate_cpassword($password, $cpassword); 

  echo "<!DOCTYPE html>\n<html><head><title>User Registration</title>";

  if ($fail == "")
  {
    echo "</head><body>Form data successfully validated.</body></html>";

  try
  {
    $pdo = new PDO($attr, $user, $pass, $opts);
  }
  catch (\PDOException $e)
  {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
  }

    $hash = password_hash($password, PASSWORD_DEFAULT);
    add_user($pdo, $username, $email, $hash);
    echo <<<_END
    "User $username successfully created!"<br>
    <a href="userlogin.php">Login to database</a>
    _END;

	}

	function add_user($pdo, $username, $email, $password)
	{
    $stmt = $pdo->prepare('INSERT INTO user VALUES(?,?,?)');

    $stmt->bindParam(1, $username, PDO::PARAM_STR,  32);
    $stmt->bindParam(2, $email, PDO::PARAM_STR,  32);
    $stmt->bindParam(3, $password, PDO::PARAM_STR,  255);

    $stmt->execute([$username, $email, $password]);
	}

  echo <<<_END

    <!-- The HTML/JavaScript section -->

    <style>
      .signup {
        border: 1px solid #999999;
      font:   normal 14px helvetica; color:#444444;
      }
    </style>

    <script>
     function validate(form)
      {
        fail += validateUsername(form.username.value)
        fail += validateEmail(form.email.value)
        fail += validatePassword(form.password.value)
        fail += validateConfirmPassword(form.cpassword.value)

        if   (fail == "")   return true
        else { alert(fail); return false }
      }

      function validateUsername(field)
      {
        if (field == "") return "No Username was entered.\n"
        else if (field.length < 5)
          return "Usernames must be at least 5 characters.\n"
        else if (/[^a-zA-Z0-9_-]/.test(field))
          return "Only a-z, A-Z, 0-9, - and _ allowed in Usernames.\n"
        return ""
      }
      
      function validateEmail(field)
      {
        if (field == "") return "No Email was entered.\n"
          else if (!((field.indexOf(".") > 0) &&
                     (field.indexOf("@") > 0)) ||
                     /[^a-zA-Z0-9.@_-]/.test(field))
            return "The Email address is invalid.\n"
        return ""
      }

      function validatePassword(field)
      {
        if (field == "") return "No Password was entered.\n"
        else if (field.length < 6)
          return "Passwords must be at least 6 characters.\n"
        else if (! /[a-z]/.test(field) ||
                 ! /[A-Z]/.test(field) ||
                 ! /[0-9]/.test(field))
          return "Passwords require one each of a-z, A-Z and 0-9.\n"
        return ""
      }
      
      function validateConfirmPassword(field)
      {
          if(field = "") return "Please confirm your password.\n"
          else if(field != password) return "The passwords are not equal. Please re-type your password.\n";
      }
    </script>
  </head>
  <body>

    <table border="0" cellpadding="2" cellspacing="5" bgcolor="#eeeeee">
      <th colspan="2" align="center">Signup Form</th>

        <tr><td colspan="2">Sorry, the following errors were found<br>
          in your form: <p><font color=red size=1><i>$fail</i></font></p>
        </td></tr>

      <form method="post" action="adduser.php" onSubmit="return validate(this)">
        <tr><td>Username</td>
          <td><input type="text" maxlength="32" name="username" value="$username">
		</td></tr><tr><td>Email</td>
          <td><input type="text" maxlength="100" name="email"    value="$email">
        </td></tr><tr><td>Password</td>
          <td><input type="password" maxlength="32" name="password" value="$password">
        </td></tr><tr><td>Confirm Password</td>
          <td><input type="password" maxlength="32"  name="cpassword" value="$cpassword">
        
        </td></tr><tr><td colspan="2" align="center"><input type="submit"
          value="Signup"></td></tr>
      </form>
    </table>
  </body>
</html>

_END;

  // The PHP functions
  
  function validate_username($field)
  {
    if ($field == "") return "No Username was entered<br>";
    else if (strlen($field) < 5)
      return "Usernames must be at least 5 characters<br>";
    else if (preg_match("/[^a-zA-Z0-9_-]/", $field))
      return "Only letters, numbers, - and _ in usernames<br>";
    return "";		
  }
  
  function validate_email($field)
  {
    if ($field == "") return "No Email was entered<br>";
      else if (!((strpos($field, ".") > 0) &&
                 (strpos($field, "@") > 0)) ||
                  preg_match("/[^a-zA-Z0-9.@_-]/", $field))
        return "The Email address is invalid<br>";
    return "";
  }
  
  function validate_password($field)
  {
    if ($field == "") return "No Password was entered<br>";
    else if (strlen($field) < 6)
      return "Passwords must be at least 6 characters<br>";
    else if (!preg_match("/[a-z]/", $field) ||
             !preg_match("/[A-Z]/", $field) ||
             !preg_match("/[0-9]/", $field))
      return "Passwords require 1 each of a-z, A-Z and 0-9<br>";
    return "";
  }
   
  function validate_cpassword($field1, $field2)
      {
          if($field1 != $field2) return "The passwords are not equal. Please re-type your password.\n";
      }
  
  function fix_string($string)
  {
    return htmlentities ($string);
  }
?>
