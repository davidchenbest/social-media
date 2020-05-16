<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deleted</title>
</head>
<body>
    
</body>
</html>
<?php 
    //require 'session.php';
    if(isset($_POST['delete'])){
        $email = $_POST['toDelete'];
        

        require 'database/connect.php';
        $sql = "DELETE FROM user WHERE email='{$email}' ";

        if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully";
        } else {
        echo "Error deleting record: " . $conn->error;
        }
        ?>
        
        <form action="home.php">
        <button type='submit'>Home</button>
        </form>

        <?php

        $conn->close();
        



    }

    

?>