<?php
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
                            <?php require 'post/getLikes.php' ?>
                            <button type='submit' name='commentSubmit' id='commentSubmitBtn' value='<?php echo $row['id'] ?>' onclick='commentSubmit()' class='btn btn-info '>Comments</button>
                            <?php 
                                $sql= "select count(*) as total from comment where comment.parent_id={$row['id']} ";
                                $c = $conn->query($sql);
                                if($c->num_rows >0){
                                    $t = $c->fetch_assoc();
                                    echo "<span class = 'comment-num'>{$t['total']}</span>";
                                }
                            ?>
                        </div>
                        
                        
                            
                        <form class='comment-input preventRefresh' >                                
                            <input type="" name='commentContent' value='' id='write<?php echo $row['id'] ?>' class='form-control'>
                            <button type='submit' name='postCommentSubmit' value='<?php echo $row['id'] ?>' onclick='writeComment()'class='btn btn-primary'>Write</button>
                        </form> 
                        
                        
                                                
                    </div>
                    
                </div>

                
            
            
        <?php }
    } 
    
    mysqli_free_result($result);

?>