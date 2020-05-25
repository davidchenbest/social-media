<?php 
    
    require 'database/connect.php';
    include 'function/formatTime.php';
    
    $email='';
    if(isset($profile['email'])){
        $email = $profile['email'];
    }
    else{$email = $_SESSION['email'];}

    $sql = "select firstname, lastname, content, post.reg_date, post.id, user.email  from post, user where user.email='{$email}' and post.user = user.email ORDER BY post.reg_date desc";
    require 'post/getPost.php';
    $conn->close();
?>
