<?php
    require 'session.php';
    
    if(isset($_POST['content'])){
        
        $content = $_POST['content'];
        $user = $_SESSION['email'];
        if(strlen($content) > 1){
            require 'database/connect.php';

            $sql = "INSERT INTO post (content, user)
            VALUES ('{$content}', '{$user}')";

            if ($conn->query($sql) === TRUE) { 
                
                $q = "select post.id,  post.reg_date, content, firstname, lastname from post, user 
                where post.user='{$user}' and post.id=(select max(id) from post) and post.user = user.email;
                ";
                $result = $conn->query($q);

                
                if ($result->num_rows > 0) {
                    // output data of each row
                    while($row = $result->fetch_assoc()) { ?>
                        
                        <div class='post-container'>
                            <div class='user-date'>
                                <p class='font-weight-bold' ><?php echo $row['firstname'] ?> <?php echo $row['lastname'] ?></p>
                                <p><?php echo $row['reg_date'] ?></p>
                            </div>
                            <div class='content-container'>
                                <?php echo $row['content'] ?>
                            </div>
                            <div class='comment-section' style='display: flex; flex-direction:column;'>
                                <div >
                                    <input type="hidden" name='commentParent' value='<?php echo $row['max(id)'] ?>' >
                                    <button type='submit' name='commentSubmit' value='Submit'>Comments</button>
                                    
                                </div>
                                <?php require 'comments/getComment.php'; ?>
                                <div  >
                                    <input type="hidden" name='commentParent' value='<?php echo $row['max(id)'] ?>' >
                                    <input type="" name='commentContent' value='' >
                                    <button type='submit' name='postCommentSubmit' value='Submit'>write</button>
                                </div>                        
                            </div>                            
                        </div>
                        
                    <?php
                    }
                }
            } 
            mysqli_free_result($result);
            $conn->close();
            
            
        }
        
    
        unset($_POST['content']);
        unset($_POST['postSubmit']);
       
    }
    
    
?>