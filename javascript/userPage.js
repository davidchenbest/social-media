function addFriend(){
    let addFriendBtn = document.getElementById('add-friend-btn');
    let friend = addFriendBtn.value
    let xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {   
                if(this.responseText.trim() === 'success')  {
                    document.querySelector('#add-friend-btn').style.display = 'none';
                    document.querySelector('#friend-badge').style.display = 'inline';
                    document.querySelector('#remove-friend-btn').style.display = 'inline';
                }  
                else{
                    document.querySelector('.add-friend-con').innerHTML = '<p>Not Successful</p>';
                }                
      }
    };
    xhttp.open("POST", "friend/addFriend.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send(`friend=${friend}`);
}

removeFriend=()=>{
    let removeFriendBtn = document.getElementById('remove-friend-btn');
    let friend = removeFriendBtn.value
    let xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {   
                if(this.responseText.trim() === 'success')  {
                    document.querySelector('#remove-friend-btn').style.display = 'none';
                    document.querySelector('#friend-badge').style.display = 'none';
                    document.querySelector('#add-friend-btn').style.display = 'inline';
                }  
                else{
                    document.querySelector('.add-friend-con').innerHTML = '<p>Not Successful</p>';
                }                
      }
    };
    xhttp.open("POST", "friend/removeFriend.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send(`friend=${friend}`);
    
}
