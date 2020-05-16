<?php
require 'connect.php';

$sql = "INSERT INTO user (email, firstName, lastName, password)
VALUES ('{$email}', '{$first}', '{$last}','{$password}')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

?>