<?php 
    require 'session.php';
    $out='';
    if(isset($_POST['searchValue'] ) ){
        $out = $_POST['searchValue'];
        
        
    }
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="style/searchResults.css">
    <title>Search Results</title>
</head>
<?php include 'header/header.php'; ?>



<body>
    <div class = 'result-con'>
    <?php 
        if(strlen($out) > 0){
            echo "<h3>Results for {$out}:<h3>";
            $segments = explode(' ',$out);
            $sql='';
            if (sizeof($segments) > 1){
                $sql = "select firstname, lastname, email from user where (firstname like '{$segments[0]}%') and (lastname like '{$segments[1]}%')  ";
            }
            else{                
                $sql = "select firstname, lastname, email from user where (firstname like '{$out}%') or (lastname like '{$out}%')  ";
            }
            require 'database/connect.php';
            
            $result = $conn->query($sql);
            if( $result->num_rows > 0){
                while($row = $result->fetch_assoc()){ ?>
                    <form action='userPage.php' method='post'>                                
                        <input type="hidden" name='userPost' value='<?php echo $row['email'] ?>'>                                
                        <button class='font-weight-bold' id='userSubmit' type='submit' name='userSubmit' value='Submit' ><?php echo ucfirst($row['firstname']) ?> <?php echo ucfirst($row['lastname']) ?></button>
                    </form> <?php
                }
            }

        }
        else{
            echo '<h3>No Result<h3>';
        }
    ?>
    </div>
    
</body>
</html>