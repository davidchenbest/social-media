let postField = document.querySelector('#post-field');
let postBtn = document.querySelector('#post-btn');
postBtn.style.visibility = 'hidden';



postField.addEventListener('keyup', ()=>{
    if(postField.value.length > 0){
        postBtn.style.visibility = 'visible';
    }
    
})




postBtn.addEventListener('click',()=>{
    let content = postField.value;
    
    
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
    
})
