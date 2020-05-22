<div class='navbar'> 
    <a href='home.php' id='logo'>Social</a>
    <a href='#' id='greet'>Hello <?php  echo $_SESSION['firstname']. ' '. $_SESSION['lastname']?> </a>
    <?php require 'user-nav.php' ?>
    
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
            justify-content: space-between;
            


        }
        #logo{
            font-size:30px;
            font-weight:700;
            padding:0;            
            color:white;
            margin:0;
            width:33%;
            
        }
        #greet{
            padding:0;
            margin:0; 
            font-size:20px;
            font-weight:700;
            text-decoration: none;
            color:white;
            text-align: center !important;
            
            width:33%;
           
            
        }

        a{
            text-decoration: none !important;
        }

        
    </style>