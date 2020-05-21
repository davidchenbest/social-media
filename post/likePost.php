<?php 
    require '../session.php';

    if(isset($_POST['id'])){
        $parentId = $_POST['id'];
        $user = $_SESSION['email'];

        require '../database/connect.php';

        $sql = "select * from likes where user='{$user}' and parent_id={$parentId};";

        $result = $conn->query($sql);

        if ($result->num_rows === 0) {
            $sql = "INSERT INTO likes (parent_id, user)
            VALUES ('{$parentId}', '{$user}')";
            $conn->query($sql);   
            echo 'liked'; 
                
            
        }
        else{
            $sql = "delete from likes where user='{$user}' and parent_id={$parentId};";
            $conn->query($sql); 
            echo 'deleted';
        }
        
        
        

        

        $conn->close();

    }
?>