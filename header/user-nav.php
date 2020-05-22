<div class='user-nav'>
    <div class='icon-nav'>
        <a href="home.php"><img src="pictures/home.png" alt="Home"></a>
        <a href="userPage.php"><img src="pictures/user.png" alt="User"></a>
        <a href=""><img src="pictures/notification.png" alt="Notif"></a>
    </div>
    <a href="logout.php" id='logout'>Logout</a>
</div>

<style>
    .user-nav{
        display:flex;
        justify-content:space-between;
        align-items:center;
        height: 30px;
        margin:0;
        padding:0;
        width:33%
    }
    a img{
        background-color:white;
        border-radius:50%;
        height:2em;
    }

    .icon-nav{
        height:100%;
        width:25%;
        margin:0;
        padding:0;
        display:flex;
        justify-content:space-between;
    }

    #logout{
            color:white;
            padding:0;
            margin:0;
            width:75%;
            display:flex;
            justify-content:flex-end;
            
            
            
    }
    #logout:hover{
        color:yellow;
    }

</style>