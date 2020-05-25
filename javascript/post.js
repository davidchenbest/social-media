commentSubmit=()=>{
    let xhttp;
    let parentId= event.target.value;
    let commentSection = document.getElementById(`${parentId}`);
    
    
    if(commentSection.children.length != 0){
      commentSection.innerHTML ="";
    }
    else{
      xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {        
              
          if(this.responseText.trim() == ''){
            commentSection.innerHTML = "<p>Be the first to comment</p>";
            
          }
          commentSection.innerHTML += this.responseText;
          
                
        }
      };
      xhttp.open("POST", "comments/getComment.php", true);
      xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xhttp.send(`id=${parentId}`);
    }
    
    
  }
  
  writeComment=()=>{
    let id = event.target.value;
    let input = document.getElementById('write'+id);
    if(input.value.trim().length = 0) return; 
    
    let commentSection = document.getElementById(`${id}`);
    let xhttp;
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {        
             
        commentSection.innerHTML += this.responseText;
               
      }
    };
    xhttp.open("POST", "comments/writeComment.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send(`id=${id}&content=${input.value.trim()}`);
    input.value='';
    
    
  }
  
  let arr = document.querySelectorAll('.preventRefresh');
  arr.forEach((current)=>{
    current.addEventListener('submit', 
    (event)=>{event.preventDefault();});
  })
  
  function likePost(){
   let id = event.target;
   let action;
   let xhttp = new XMLHttpRequest();
     xhttp.onreadystatechange = async function() {
      if (this.readyState == 4 && this.status == 200) {        
         action = await  this.responseText.trim();
         if(action =='liked'){
          
           id.style.color='red'
           
         }
         else{id.style.color='grey'}   
             
       
               
      }
    };
    xhttp.open("POST", "post/likePost.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send(`id=${id.value}`);
  }
  
  function heart(){
    let id = event.target;
    
    let action;
    let xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = async function() {
        if (this.readyState == 4 && this.status == 200) {        
          action = await  this.responseText.trim();
          if(action =='deleted') {
            id.src='pictures/heart.png' ;
            document.getElementById('like'+id.getAttribute('value')).innerText-=1;
          }
          else {
            id.src='pictures/likedHeart.png'
            let num = document.getElementById('like'+id.getAttribute('value'));
            num.innerText = Number(num.innerText)+1
          }
            
        }
      };
      xhttp.open("POST", "post/likePost.php", true);
      xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xhttp.send(`id=${id.getAttribute('value')}`);
      
  }
  
  showLike=()=>{  
    let parentId = event.target.getAttribute('value');
    let selected = document.getElementById('likedUser'+parentId);
    if(selected.style.display == 'flex'){
      selected.style.display='none'
    }
    else{
      selected.style.display='flex';
    }
    
    
    
  }