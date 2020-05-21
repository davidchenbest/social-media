<div class='navbar'> 
    <p id='logo'>Social</p>
    <a href='#' id='greet'>Hello <?php  echo $_SESSION['firstname']. ' '. $_SESSION['lastname']?> </a>
    <a href="logout.php" id='logout'>Logout</a>
</div>

    <style>
        .navbar{
            color:white;
            background-color:grey;
            width:100%;
            display:flex;
            height:50px;
            align-items:center;
            position:fixed;
            top:0;
            margin:0;
            padding:0 15px;
            


        }
        #logo{
            font-size:30px;
            font-weight:700;
            padding:0;            
           
            margin:0;
            
        }
        #greet{
            padding:0;
            margin:0; 
            font-size:20px;
            font-weight:700;
            text-decoration: none;
            color:white;
            
           
            
        }
        .navbar #logout{
            color:white;
            padding:0;
            margin:0;
            text-decoration: none;
            
        }
        .navbar #logout:hover{
            color:yellow;
        }

        
    </style>