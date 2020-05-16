<?php  

    
$servername = "localhost";
$dbusername = "user";
$dbpassword = "chen";
$dbname = "php";

$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


?>