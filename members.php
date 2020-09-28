<?php
require_once 'header.php';

if (!$loggedin) die("</div></body></html>");

if (isset($_GET['view']))
{
    $view = sanitizeString($_GET['view']);
    if ($view == $user) $name = "Your";
        else $name = "$view 's";

        echo "<h3>$name Profile</h3>";
        showProfilee($view);

        echo "<a class='button' data-transition='slide'
                href='messages.php?view=$view'>View $name messages</a>";
        die("</div></body></html>");
}

if (isset($_GET['add']))
{
    $add = sanitizeString($_GET['add']);

    $result = queryMysql("SELECT *FROM friends WHERE user='$add' AND friend = '$user'");
    if ($result->num_rows)
        queryMysql("INSERT INTO friends VALUES ('$add' , '$user')");
}

elseif (isset($_GET['remove']))
{
    $remove = sanitizeString($_GET['remove']);
    queryMysql("DELETE FROM friends WHERE user = '$remove' AND friend = '$user'");
}

$result = queryMysql("SELECT user FROM members ORDER BY user");
$num = $result->num_rows;
echo "<h3>Other Members</h3><ul></ul>";

for ($j = 0 ; $j < $num; ++$j)
{
    $row = $result->fetch_array(MYSQLI_ASSOC);
    if ($row['user']==$user) continue;

    echo "<li><a data-transition = 'slide' href = 'members.php?view=" . $row['user'] ."' >" . $row['user'] . '</a>';
}
