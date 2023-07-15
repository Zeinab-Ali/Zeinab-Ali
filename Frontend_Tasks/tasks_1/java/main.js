let openBtn = document.querySelector(".banner .open-btn") 
let closeBtn = document.querySelector(".show .close-btn") 
let show = document.querySelector(".show")  

//add event lithiner 

openBtn.addEventListener('click',()=>{ 
    show.classList.add("open-show");
}); 
closeBtn.addEventListener('click',function(){ 
    show.classList.remove("open-show");

});