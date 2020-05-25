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
    <link rel="stylesheet" href="style/home.css">
    <title>Home <?php echo $_SESSION['firstname']; echo ' ' . $_SESSION['lastname'];?></title>
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
        

        $sql = "select distinct firstname, lastname, content, post.reg_date, post.id, user.email  from post, friend, user 
        where (post.user = '{$_SESSION['email']}' or (user_email='{$_SESSION['email']}' and friend_email = post.user)) 
        and post.user = user.email ORDER BY post.reg_date desc ";
        require 'post/getPost.php';
        $conn->close();
    ?>
    
    
</body>
<script src="javascript/home.js"></script>
<script src="javascript/post.js"></script>
</html>