<?php 
    require 'database/connect.php';

    if(isset($_POST['postCommentSubmit'])){
        $user = $_SESSION['email'];
        $commentParent = $_POST['commentParent'];
        $commentContent = $_POST['commentContent'];

        if(strlen($commentContent) > 0){
            $sql = "INSERT INTO comment (parent_id, content, user)
            VALUES ('{$commentParent}','{$commentContent}', '{$user}')";

            if ($conn->query($sql) === TRUE) {
                echo 'sucess';
            } else {
                echo "Error: ";
            }
            
            
            
        }


        unset($_POST['postCommentSubmit']);
        
    }
?>