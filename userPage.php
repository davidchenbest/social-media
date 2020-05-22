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
    <title><?php echo "{$profile['firstname']} {$profile['lastname']} Page" ?></title>
</head>
<?php include 'header/header.php'; ?>
<body>
    <h1><?php echo "{$profile['firstname']} {$profile['lastname']}" ?></h1>
</body>
</html>