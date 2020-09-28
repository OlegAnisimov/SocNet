<?php
session_start();

echo <<<_INIT
<!DOCTYPE html>
    <html>
        <head>
            <meta charset='utf-8'>
            <meta name="'viewport" content="width=device-width, initial-scale=1">
            <link href="https://fonts.googleapis.com/css2?family=PT+Sans:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
            
            <link rel="stylesheet" href="styles.css">
            <script src="javascript.js"></script>
            <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jquerymobile/1.4.5/jquery.mobile.min.css">
            <script src="https://ajax.googleapis.com/ajax/libs/jquerymobile/1.4.5/jquery.mobile.min.js"></script>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

_INIT;

require_once 'functions.php';
$loggedin = "";

$userstr ='Welcome guest';
if (isset($_SESSION['user'])) {
    $user=$_SESSION['user'];
    $loggedin = TRUE;
    $userstr="Logged in as: $user";
}
else $loggedin=FALSE;

echo <<<_MAIN
 <title>SocNet : $userstr</title>
</head>
<body>
    <div data-role='page'>
    <div data-role='header'>
    <div id='logo'
        class="center"> SocNet</div>
       <div class="username">$userstr</div>
       </div>
       <div data-role="content">
_MAIN;
if ($loggedin)
{
    echo <<<_LOGGEDIN
<div class="center"> 
<a data-role="button" data-inline="true" data-icon="home" 
        data-transition="slide" href="">Home</a>
 <a data-role="button" data-inline="true" 
        data-transition="slide" href="members.php">Members</a>
<a data-role="button" data-inline="true" 
        data-transition="slide" href="">Friends</a>
<a data-role="button" data-inline="true" 
        data-transition="slide" href="messages.php">Messages</a>
<a data-role="button" data-inline="true" 
        data-transition="slide" href="profile.php">Edit profile</a>
<a data-role="button" data-inline="true" 
        data-transition="slide" href="logout.php">Log out</a>       
        

</div> 

_LOGGEDIN;
}
else {
    echo <<<_GUEST
<div class="center">
<a data-role="button" data-inline="true" data-icon="home" 
        data-transition="slide" href="">Home</a>
 <a data-role="button" data-inline="true" 
        data-transition="slide" href="signup.php">Sign-Up</a>
 <a data-role="button" data-inline="true"
        data-transition="slide" href="login.php">Log-In</a>              
</div>
<p class="info">(You must logged in to use App)</p>
_GUEST;
}
?>



