<?php 
    require 'session.php';

    // remove all session variables
    session_unset();
    

    // destroy the session
    //session_destroy();
?>
<p>Logged Out</p>
<a href="login.php">Login</a>

