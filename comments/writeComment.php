<?php 
    require '../database/connect.php';
    require '../session.php';

    if(isset($_POST['content']) && isset($_POST['id'])){
        $content = $_POST['content'];        
        $id = $_POST['id'];
        if(strlen(trim($content)) > 0){        

            $sql = "INSERT INTO comment (content, parent_id, user)
            VALUES ('{$content}', '{$id}', '{$_SESSION['email']}')";

            if ($conn->query($sql) === TRUE) {
                $sql="select firstname, lastname, comment.reg_date, comment.content from comment, user where comment.id=(select max(id) from comment where user = '{$_SESSION['email']}') && comment.user= user.email;";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) { ?>
                        <div class='comment-container'>
                            <div id='comment-header'>
                                <span ><?php echo $row['firstname'] ?> <?php echo $row['lastname'] ?></span>
                                <span><?php echo $row['reg_date'] ?></span>                        
                            </div>
                            <div id='comment-content'>
                                <span><?php echo $row['content'] ?></span>
                            </div>
                        </div>

                        <?php
                    }

                }
                mysqli_free_result($result);
                $conn->close();
            }
        }
    }
?>