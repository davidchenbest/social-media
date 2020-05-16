<?php  

    
require 'database/connect.php';

$sql = "SELECT * FROM user";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "email: " . $row["email"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. " Date - " .$row["reg_date"] 
        . "<form action='delete.php' method='POST'>
        <input type='hidden' name='toDelete' value='{$row["email"]}'>
        <input type='submit' value='Delete' name='delete' >
    </form>" ."<br>";
    }
} else {
    echo "0 results";
}

mysqli_free_result($result);
$conn->close();


?>