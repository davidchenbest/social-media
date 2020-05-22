<?php
    $email = $first = $last = $password = $confirmPassword = '';
    $error = array('email'=>'', 'first'=>'', 'last'=>'', 'password'=>'', 'confirmPassword'=>'');
    if(isset($_POST['submit'])){
        $email = strtolower($_POST['email']);
        $first = strtolower($_POST['first']);
        $last = strtolower($_POST['last']);
        $password = $_POST['password'];
        $confirmPassword = $_POST['confirmPassword'];
        
        if(empty($_POST['email'])){
            $error['email'] = ' Email Required';
        }
        else {
            if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
                $error['email'] = ' Not an email';
            }
            else{
                if(empty($_POST['first'])){
                    $error['first'] = ' First Name Required';
                }
                else{
                    if(empty($_POST['last'])){
                        $error['last'] = ' Last Name Required';
                    }
                    else{
                        if(empty($_POST['password'])){
                            $error['password'] = ' Password Required';
                        }
                        elseif($confirmPassword !== $password ){
                            $error['password'] = ' Do no match';
                            $error['confirmPassword'] = ' Do not match';
                        }
                        else{
                            require 'database/connect.php';
                        $sql = "SELECT email FROM user where email = '{$email}'";
                            $result = $conn->query($sql);
                
                            if ($result->num_rows > 0) {
                                // output data of each row
                                $row = $result->fetch_assoc(); 
                            } 
                            
                            if(!empty($row)){
                                $error['email'] = 'Email already exist';
                            }
                            mysqli_free_result($result);
                            
                        }
                    }
                }
            }
            
        }
        
        
        

        if(!array_filter($error)){
            require 'database/insert.php';
            session_start();
            $_SESSION['email'] = $email;
            header("Location: signupSuccess.php");

            
            
        }
        
    }


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style/form.css">
    <title>Document</title>
</head>
<body style=''>
<form action="" method='post' >
    <div class='form-group'>
        <label for="email">Email: </label> <span id= 'error-msg'><?php echo $error['email'] ?></span> <br>
        <input  type="text" name='email' value=<?php echo htmlspecialchars($email) ?> >
    </div>
    
    <div class='form-group'>
        <label for="first">First Name: </label> <span id= 'error-msg'><?php echo $error['first'] ?></span> <br>
        <input type="text" name ='first'value=<?php echo htmlspecialchars($first) ?>>
    </div>
    
    <div class='form-group'>
        <label for="last">Last Name: </label> <span id= 'error-msg'><?php echo $error['last'] ?></span> <br>
        <input type="text" name='last'value=<?php echo htmlspecialchars($last) ?>>
    </div>
    <div class='form-group'>
        <label for="password">Password: </label> <span id= 'error-msg'><?php echo $error['password'] ?></span> <br>
        <input type="password" name='password'value=<?php echo htmlspecialchars($password) ?>>
    </div>
    <div class='form-group'>
        <label for="confirmPassword">confirmPassword: </label> <span id= 'error-msg'><?php echo $error['confirmPassword'] ?></span> <br>
        <input type="password" name='confirmPassword'value=<?php echo htmlspecialchars($confirmPassword) ?>>
    </div>
    
    <div class='form-group'>
    <input type='submit' name='submit' value='Submit' class="btn btn-success" > 
    
    </div>
    <a href="login.php" id='login-link'  >Login</a>
    
</form>
</body>
</html>
