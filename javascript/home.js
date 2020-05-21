let postField = document.querySelector('#post-field');
let postBtn = document.querySelector('#post-btn');
let commentSubmit = document.querySelector('#comment-submit');
let writeBtn = document.querySelector('#write-btn');


postBtn.style.visibility = 'hidden';



postField.addEventListener('keyup', ()=>{
    if(postField.value.length > 0){
        postBtn.style.visibility = 'visible';
    }    
})

postBtn.addEventListener('click',()=>{
    let content = postField.value.trim(); 
    if(content.length = 0) return;    
    let xhttp;
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {        
        let feed =  document.querySelector(".feed-container").innerHTML ;
        document.querySelector(".feed-container").innerHTML = this.responseText + feed;        
      }
    };
    xhttp.open("POST", "writePost.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send(`content=${content}`);
    postField.value='';
})

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

let arr = document.querySelectorAll('form');
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
        if(action =='liked'){
          
          id.style.backgroundColor='red'
          
        }
        else{id.style.backgroundColor='grey'}   
            
      
              
      }
    };
    xhttp.open("POST", "post/likePost.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send(`id=${id.getAttribute('value')}`);
    
}
