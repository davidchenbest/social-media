<?php 
    require '../database/connect.php';
    require '../session.php';
    require '../function/formatTime.php';
    

    if(isset($_POST['id'])){
        $id = $_POST['id'];
        $sql = "select firstname, lastname, comment.user, comment.content, comment.reg_date from comment, user where comment.user = user.email and comment.parent_id={$id} order by comment.reg_date asc ";

        $result = $conn->query($sql);

        
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) { ?>
                <div class='comment-container'>
                    <div id='comment-header'>
                    <form action='userPage.php' method='post'>                                
                        <input type="hidden" name='userPost' value='<?php echo $row['user'] ?>'>                                
                        <button class='font-weight-bold' id='userSubmit' type='submit' name='userSubmit' value='Submit' ><?php echo ucfirst($row['firstname']) ?> <?php echo ucfirst($row['lastname']) ?></button>
                    </form>
                        <span><?php echo  formatTime($row['reg_date']); ?></span>                        
                    </div>
                    <div id='comment-content'>
                        <span><?php echo $row['content'] ?></span>
                    </div>
                </div>

                <?php
            }
        }
        
    }
?>