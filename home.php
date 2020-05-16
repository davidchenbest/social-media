<?php 
    require 'session.php';

    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style/post.css">
    <title>Home <?php echo $_SESSION['email']; ?></title>
</head>
<body>
    
    <?php include 'header.php'; ?>
    <h1>Welcome Home <?php echo $_SESSION['email']; ?></h1>
    <div class='post-form'>
        <p id='post-guide'></p>
        <input type="text" name='content' id='post-field'> </input> 
        <input type="hidden" name='user' value='<?php $_SESSION['email'] ?>'>
        <button type='submit' name='postSubmit' value='Submit' id='post-btn'>Post</button>
    </div>

    <section class = 'feed-container'>  </section>

    <?php 
        require 'database/connect.php';
        //require 'comments/getComment.php';
        //require 'comments/writeComment.php';
        

        $sql = "select firstname, lastname, content, post.reg_date, post.id  from post, user where post.user = user.email ORDER BY post.reg_date desc";
        $result = $conn->query($sql);

        
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {?>
                
                    <div class='post-container'>
                        <div class='user-date'>
                            <p class='font-weight-bold' ><?php echo $row['firstname'] ?> <?php echo $row['lastname'] ?></p>
                            <p><?php echo $row['reg_date'] ?></p>
                        </div>
                        <div class='content-container'>
                            <?php echo $row['content'] ?>
                        </div>
                        <div class='comment-section' style='display: flex; flex-direction:column;'>
                            <div>
                                <input type="hidden" name='commentParent' value='<?php echo $row['id'] ?>' >
                                <button type='submit' name='commentSubmit' value='Submit'>Comments</button>
                                
                            </div>
                            <?php require 'comments/getComment.php'; ?>
                            <div>
                                <input type="hidden" name='commentParent' value='<?php echo $row['id'] ?>' >
                                <input type="" name='commentContent' value='' >
                                <button type='submit' name='postCommentSubmit' value='Submit'>write</button>
                            </div>                        
                        </div>
                        
                    </div>

                    
                
                
            <?php }
        } 

        mysqli_free_result($result);
        $conn->close();
    ?>
    
    
</body>
<script src="javascript/home.js"></script>
</html>