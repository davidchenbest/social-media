<?php 
    
    $parentId = $row['id'];
    $user = $_SESSION['email'];
    $sql = "select user from likes where parent_id ='{$parentId}' and user ='{$user}'";
    $like = $conn->query($sql);

    $count = "select count(user)  from likes where parent_id={$parentId}";
    $num = $conn->query($count);
    $r = $num->fetch_assoc();
    
    
    
    
    if ($like->num_rows > 0) {
        echo "<p id='like{$parentId}' class='numLike' >{$r['count(user)']}</p><img src='pictures/likedHeart.png' alt='liked' id='heart' value='{$parentId}' onclick='heart()'>";

    }
    else{
        echo "<p id='like{$parentId}' class='numLike'>{$r['count(user)']}</p><img src='pictures/heart.png' alt='notliked' id='heart' value='{$parentId}' onclick='heart()'>";
    }

    


?>