<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    <?php 
        require 'session.php';
        
    ?>
    <?php include 'header.php'; ?>
    <p>Success signup <?php echo $_SESSION['email'] ?>.</p>
    <a href="home.php">Home</a>
    
</body>
</html>