<?php 
    require '../session.php';

    if(isset($_POST['friend'])){
        require '../database/connect.php';
        $friend = $_POST['friend'];

        $sql = "select * from friend where user_email = '{$_SESSION['email']}' and friend_email = '{$friend}'";
        $result = $conn->query($sql);
        if($result->num_rows > 0){
            mysqli_free_result($result);
            $sql ="delete from friend where user_email = '{$_SESSION['email']}' and friend_email = '{$friend}'";
            
            if($conn->query($sql) === TRUE){
                echo 'success';
            }
            else{
                echo 'error';
            }
        }
        else{
            echo 'error';
        }

        $conn->close();
    }

?>