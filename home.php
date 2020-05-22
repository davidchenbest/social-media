<?php 
    require 'session.php';

    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    
    <link rel="stylesheet" href="style/post.css">
    <title>Home <?php echo $_SESSION['email']; ?></title>
</head>
<?php include 'header/header.php'; ?>
<body>
    
    
    <form class='post-form preventRefresh'>
        <p id='post-guide'></p>
        <textarea type="text" name='content' id='post-field' class='post-form' placeholder="What is on your mind <?php echo $_SESSION['firstname'] ?>?"></textarea> 
        <button type='submit' name='postSubmit' value='Submit' id='post-btn' class='btn btn-primary'>Post</button>
    </form>

    <section class = 'feed-container'>  </section>

    <?php 
        require 'database/connect.php';
        include 'function/formatTime.php';
        

        $sql = "select firstname, lastname, content, post.reg_date, post.id, user.email  from post, user where post.user = user.email ORDER BY post.reg_date desc";
        $result = $conn->query($sql);

        
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {?>
                
                    <div class='post-container' >
                        <div class='user-date'>
                            <form action='userPage.php' method='post'>                                
                                <input type="hidden" name='userPost' value='<?php echo $row['email'] ?>'>                                
                                <button class='font-weight-bold' id='userSubmit' type='submit' name='userSubmit' value='Submit' ><?php echo ucfirst($row['firstname']) ?> <?php echo ucfirst($row['lastname']) ?></button>
                            </form>
                            <p><?php echo  formatTime($row['reg_date']); ?></p>
                        </div>
                        <div class='content-container'><p><?php echo $row['content'] ?></p>
                        </div>
                        
                        <div  class='main-comment-container'>
                            <div id='<?php echo $row['id'] ?>'  class='comment-gen'>                                
                                
                            </div>
                            <div class='like-comment'>
                                <!-- <span class="heart" value='<?php echo $row['id'] ?>' onclick='heart()' id='<?php echo $row['id'] ?>'></span>
                                <button type='submit' name='commentSubmit' value='<?php echo $row['id'] ?>' onclick='likePost()' class='btn btn-primary ' id=''>Like</button> -->
                                <!-- <img src='pictures/heart.png' alt='liked' style='height:2em ; color:red;' value='<?php echo $row['id'] ?>' onclick='heart()'> -->
                                <?php require 'post/getLikes.php' ?>
                                <button type='submit' name='commentSubmit' value='<?php echo $row['id'] ?>' onclick='commentSubmit()' class='btn btn-info ' id='comment-btn'>Comments</button>
                            </div>
                            
                           
                                
                            <form class='comment-input preventRefresh' >                                
                                <input type="" name='commentContent' value='' id='write<?php echo $row['id'] ?>' class='form-control'>
                                <button type='submit' name='postCommentSubmit' value='<?php echo $row['id'] ?>' onclick='writeComment()'class='btn btn-primary'>Write</button>
                            </form> 
                            
                            
                                                   
                        </div>
                        
                    </div>

                    
                
                
            <?php }
        } 
        unset($r);
        mysqli_free_result($like); //in getLikes.php
        mysqli_free_result($result);
        $conn->close();
    ?>
    
    
</body>
<script src="javascript/home.js"></script>
</html>