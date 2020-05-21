<?php
    $email = $password = $confirmPassword ='';
    $error = array('email'=>'', 'password'=>'');
    if(isset($_POST['submit'])){
        $email = $_POST['email'];
        $password = $_POST['password'];
        
        if(empty($_POST['email'])){
            $error['email'] = ' Email Required';
        }
        else {
            if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
                $error['email'] = ' Not an email';
            }
            else{
                if(empty($_POST['password'])){
                    $error['password'] = ' Password Required'; 
                }
                else{
                    require 'database/connect.php';
                    $sql = "SELECT email,password FROM user where email ='{$email}' AND password='{$password}'";
                    $result = $conn->query($sql);
        
                    if ($result->num_rows > 0) {
                        // output data of each row
                        $row = $result->fetch_assoc(); 
                        if($row["email"]==$email && $row["password"]==$password){
                            echo 'logged in <br>';
                        }
                        else {
                            $error['email'] = 'Wrong email/password';
                        }
                    } 
                
                    
                    else {
                        $error['email'] = 'Wrong email/password';
                    }
                }
            }
            
        }
       
        if(!array_filter($error)){
            session_start();
            $_SESSION['email'] = $email;
            $sql = "select firstname, lastname from user where user.email ='{$_SESSION['email']}' ";
            $result = $conn->query($sql);
        
                if ($result->num_rows > 0) {                
                    $row = $result->fetch_assoc();
                    $_SESSION['firstname'] = $row['firstname'];
                    $_SESSION['lastname'] = $row['lastname'];
                }        

            $conn->close();
            
            header('Location: home.php');
        }
        
    }


?>
<form action="" method='post'>
    <div class='form-group'>
        <label for="email">Email: </label> <span id='error-msg'><?php echo $error['email'] ?></span> <br>
        <input type="text" name='email' value=<?php echo htmlspecialchars($email) ?> >
        
        
    </div>    
    <div class='form-group'>
        <label for="password">Password: </label> <span id='error-msg'> <?php echo $error['password'] ?> </span> <br>
        <input type="text" name='password'value=<?php echo htmlspecialchars($password) ?>>
    </div>
    
    <div class='form-group'>
        <input type='submit' name='submit' value='Submit' class="btn btn-success" id='submit-btn'> 
        
    </div>
    <a href="signup.php"  id='signup-link'>Sign Up</a>
    
</form>
