<?php 
    require 'database/connect.php';

    if(isset($_POST['commentSubmit'])){
        $commentParent = $_POST['commentParent'];

        $sql = "SELECT * FROM comment where parent_id = {$commentParent}";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) { ?>
                 <h1> user:   <?php echo $row["user"] ?>  content:  <?php echo $row["content"] ?> </h1>
            <?php    
            }
        }


        unset($_POST['commentSubmit']);
    }
?>