<?php 
    require '../database/connect.php';
    require '../session.php';
    require '../function/formatTime.php';
    

    if(isset($_POST['id'])){
        $id = $_POST['id'];
        $sql = "select firstname, lastname, content, comment.reg_date from comment, user where comment.user = user.email and comment.parent_id={$id} ";

        $result = $conn->query($sql);

        
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) { ?>
                <div class='comment-container'>
                    <div id='comment-header'>
                        <span id='bold' ><?php echo $row['firstname'] ?> <?php echo $row['lastname'] ?></span>
                        <span><?php echo  formatTime($row['reg_date']); ?></span>                        
                    </div>
                    <div id='comment-content'>
                        <span><?php echo $row['content'] ?></span>
                    </div>
                </div>

                <?php
            }
        }
        else{
            echo 'No comments.';
        }
    }
?>