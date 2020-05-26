<?php 
    require 'session.php';
    require 'database/connect.php';

    $profile = array('email'=>'', 'firstname'=>'', 'lastname'=>'');

    if(isset($_POST['userSubmit'])){
        
        $profile['email'] = $_POST['userPost'];
        $sql = "select * from user where email = '{$profile['email']}'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0){
            $row = $result->fetch_assoc();
            $profile['firstname'] = ucfirst($row['firstname']);
            $profile['lastname'] = ucfirst($row['lastname']);
        }
        mysqli_free_result($result);
        $conn->close();

    }
    else{
        $profile['email'] = $_SESSION['email'];
        $profile['firstname'] = ucfirst($_SESSION['firstname']);
        $profile['lastname'] = ucfirst($_SESSION['lastname']);
    }  

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="style/userPage.css">
    <link rel="stylesheet" href="style/post.css">
    <title><?php echo "{$profile['firstname']} {$profile['lastname']} Page" ?></title>
</head>
<?php include 'header/header.php'; ?>
<body>
    <div class='grid-con'>
        <div class='head-con'>
            <h1 id='name-header'><?php echo "{$profile['firstname']} {$profile['lastname']}" ?></h1>
            <div class='add-friend-con'>
            <?php 
            if( $profile['email'] !== $_SESSION['email'] ){
                require 'database/connect.php';
                $sql = "select * from friend where user_email = '{$_SESSION['email']}' and friend_email = '{$profile['email']}'";
                $result = $conn->query($sql);           
                if( $result->num_rows == 0 ){ ?>        
                    <span class='badge badge-primary' id='friend-badge' style='display:none'>Friends</span>
                    <button value="<?php echo $profile['email'] ?>" onclick='addFriend()' id='add-friend-btn' class='btn btn-success'>Add Friend</button>
                    <button value="<?php echo $profile['email'] ?>" onclick='removeFriend()' id='remove-friend-btn' style='display:none' class='btn btn-success'>Remove</button>            
            <?php }
                else{ ?>
                    <span class='badge badge-primary' id='friend-badge'>Friends</span>
                    <button value="<?php echo $profile['email'] ?>" onclick='addFriend()' id='add-friend-btn' style='display:none' class='btn btn-success'>Add Friend</button>
                    <button value="<?php echo $profile['email'] ?>" onclick='removeFriend()' id='remove-friend-btn' class='btn btn-success'>Remove</button>
    
                <?php } 
                mysqli_free_result($result);
                $conn->close();
            }
            else{
                echo "<span class='badge badge-primary' id='friend-badge' >Admin</span>";
            }
            ?>
            </div>
        </div>

        <div class='mutual-friends'>
            <?php 
                if( $profile['email'] !== $_SESSION['email'] ){
                    echo '<h6>Mutual Friends</h6>';
                }
                else{
                    echo '<h6>Friends</h6>';
                }
            ?>
            
            <?php  
                require 'database/connect.php';
                $sql = "select user.firstname, user.lastname, user.email from friend, user where user_email='{$profile['email']}' and friend_email = user.email";
                
                $mt = $conn->query($sql);
                if( $mt->num_rows > 0 ){
                    while ($row = $mt->fetch_assoc() ){ ?>
                        <form action='userPage.php' method='post'>                                
                            <input type='hidden' name='userPost' value='<?php echo $row['email'] ?>'>                                
                            <button class='font-weight-bold' id='userSubmit' type='submit' name='userSubmit' value='Submit' ><?php echo ucfirst($row['firstname']) ?> <?php echo ucfirst($row['lastname']) ?></button>
                        </form> <?php
                    }   
                } 
                else{
                    echo "<p>0</p>";
                } 
                mysqli_free_result($mt); 
                $conn->close();
            ?>
        </div>
    
        <div class='main-con'>
            <div class='user-body'>
                <h3>Posts</h3>
                <?php require 'post/getUserPost.php'; ?>
            </div>
        </div>
    
        <div style='margin-right:20px;'>
            <h6></h6>
        </div>
    
    </div>
    
</body>
<script src="javascript/userPage.js"></script>
<script src="javascript/post.js"></script>
</html>