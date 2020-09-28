<?php
$dbhost = 'localhost';
$dbname = 'socnet1';
$dbuser = 'root';
$dbpass = 'mysql';


$connection = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

if ($connection->connect_error) {
    echo("Sorry ... all will be good...anywhere...maybe");
    }

function createTable ($name , $query) {
    queryMysql("CREATE TABLE IF NOT EXISTS $name($query)");
    echo "Table  '$name' has made or exist<br>";
}

function queryMysql ($query) {
    global $connection;
    $result = $connection->query($query);
    if (!$result) die("Sorry ... all will be good...anywhere...maybe");
    return $result;
}

function destroySession () {
    $_SESSION=array();
    if (session_id()!="" || isset($_COOKIE[session_name()]))
    setcookie(session_name(), "", time()-2592000, '/');
    session_destroy();
}

function sanitizeString ($var) {
    global $connection;
    $var=strip_tags($var);
    $var=htmlentities($var);
    if (get_magic_quotes_gpc()) $var = stripslashes($var);
    return $connection->real_escape_string($var);
}

function showProfilee ($user) {
    if (file_exists("user.jpg")) echo  "<img src='user.jpg' align='left'>";
    $result = queryMysql("SELECT *FROM profiles WHERE user='$user'");
    if ($result->num_rows) {
        $row = $result->fetch_array(MYSQLI_ASSOC);
        echo stripslashes($row['text'] . "<br style ='clear:left;'><br>");
    }
    else echo "<p>Here nothing yet ...</p>";
}

?>
