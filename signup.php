<?php
require_once 'header.php';

echo <<<_END
<script>
function checkUser() {
  if (user.value=="") {
      $('#used').html('&nbsp')
      return
  }
  $.post
  (
      'checkuser.php',
      {user : user.value},
      function(data) {
        $('#used').html(data)
      }
  )
}
</script>
_END;

$error = $user = $pass= "";
if (isset($_SESSION['user'])) destroySession();

if (isset($_POST['user']))
{
    $user = sanitizeString($_POST['user']);
    $pass = sanitizeString($_POST['pass']);
}

if ($user == "" || $pass == "") $error= "Not all fields entered <br> <br>  ";

else
    {
    $result = queryMysql("SELECT  * FROM members WHERE user='$user'");
        if ($result->num_rows) $error="Name already exisit <br><br> ";
        else
        {
            queryMysql("INSERT INTO members VALUES('$user' , '$pass')");
            die('<h4>Account created.</h4> Please <a href="login.php">log in.</a> </div></body></html>');
        }
}

echo <<<_END
<form method='post' action='signup.php'>$error
<div data-role="fieldcontain">
<label></label>
Please enter your details to sign up
</div>

<div data-role="fieldcontain"> 
<label>Username</label>
<input type="text" maxlength="16" name="user" value="$user"
onblur="checkUser(this)">
<label></label> <div id="used">&nbsp;</div>
</div>

<div data-role="fieldcontain"> 
<label>Password</label>
<input type="text" maxlength="16" name="pass" value="$pass">
</div>

<div data-role="fieldcontain">
<label></label>
<input data-transition ='slide' type="submit"  value="Sign Up">
</div>
</form>
</body>
</html>
_END;
?>


