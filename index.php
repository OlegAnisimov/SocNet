<?php
session_start();
require_once 'header.php';
echo "<div class='center'> Welcome to SocNet";

if ($loggedin) echo "$user , yor are logged in";

else echo 'Please sign up or log in';

echo <<<_END
</div> <br>
</div>
<div data-role="footer">
<h4>ScoNet App</h4>
</div>
</body>
</html>
_END;
?>
