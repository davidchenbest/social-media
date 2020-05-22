<?php 
    
    $parentId = $row['id'];
    $user = $_SESSION['email'];
    $sql = "select user from likes where parent_id ='{$parentId}' and user ='{$user}'";

    $like = $conn->query($sql);

    if ($like->num_rows > 0) {
        echo "<img src='pictures/likedHeart.png' alt='liked' style='height:2em ; color:red;' value='{$parentId}' onclick='heart()'>";

    }
    else{
        echo "<img src='pictures/heart.png' alt='notliked' style='height:2em ; color:red;' value='{$parentId}' onclick='heart()'>";
    }


?>