//I certify that this submission is my own original work
<!DOCTYPE html>
<html>
  <head>
    <title>User Registration</title>
    <style>
      .signup {
        border:1px solid #999999;
        font:  normal 14px helvetica;
        color: #444444;
      }
    </style>

    <script src='validate.js'></script>
        </head>
  <body>
    <table border="0" cellpadding="2" cellspacing="5" bgcolor="#eeeeee">
      <th colspan="2" align="center">Signup Form</th>
      <form method="post" action="adduser.php" onsubmit="return validate(this)">
        <tr><td>Username</td>
          <td><input type="text" maxlength="32" name="username"></td></tr>
        <tr><td>Email</td>
          <td><input type="text" maxlength="100" name="email"></td></tr>
        <tr><td>Password</td>
          <td><input type="password" maxlength="32" name="password"></td></tr>
        <tr><td>Confirm Password</td>
          <td><input type="password" maxlength="32" name="cpassword"></td></tr>
        <tr><td colspan="2" align="center"><input type="submit" value="Signup"></td></tr>
      </form>
    </table>
  </body>
</html>
