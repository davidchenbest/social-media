<?php 
    
    $parentId = $row['id'];
    $user = $_SESSION['email'];
    $sql = "select user from likes where parent_id ='{$parentId}' and user ='{$user}'"; 
    $like = $conn->query($sql);

    $count = "select count(user)  from likes where parent_id={$parentId}"; // number of likes
    $num = $conn->query($count);
    $r = $num->fetch_assoc();

    
    $str ="<div style='display:none; flex-direction:column; flex-grow:1;' id='likedUser{$parentId}' ><span>Liked by:</pan>";
    $likeUser = "select user.firstname, user.lastname, user.email from likes, user where likes.parent_id={$parentId} and likes.user = user.email";
    $out = $conn->query($likeUser);
    if ($out->num_rows > 0) {       
        while($l = $out->fetch_assoc()) {
            $str .=
            "<form action='userPage.php' method='post' >                                
                <input type='hidden' name='userPost' value='{$l['email']}'>                                
                <button class='font-weight-bold' id='userSubmit' type='submit' name='userSubmit' value='Submit' >" . ucfirst($l['firstname']) . " " . ucfirst($l['firstname']) . "</button>
            </form>";
        }
        
    }
    
    if ($like->num_rows > 0) {
        echo $str . '</div>';
        echo "<p onclick='showLike()' id='like{$parentId}' class='numLike' value='{$parentId}'>{$r['count(user)']}</p><img src='pictures/likedHeart.png' alt='liked' id='heart' value='{$parentId}' onclick='heart()'>";
    }
    else{
        echo $str . '</div>';
        echo "<p onclick='showLike()' id='like{$parentId}' class='numLike' value='{$parentId}'>{$r['count(user)']}</p><img src='pictures/heart.png' alt='notliked' id='heart' value='{$parentId}' onclick='heart()'>";
    }

    unset($r);
    mysqli_free_result($like);


    


?>