//get btns about content 
const btns = document.querySelectorAll(".btn"); 
const btnsdiv = document.querySelector(".btns"); 
const contents = document.querySelectorAll(".content"); 
 
 
//add eventlistener on btns 
 
btnsdiv.addEventListener("click",(e)=>{ 
     
    //get data mark 
    
    const mark = e.target.dataset.mark; 
    if (mark){ 
        btns.forEach((btn)=>{ 
              btn.classList.remove("active"); 
              e.target.classList.add("active");
        }); 
        contents.forEach((content)=>{ 
            content.classList.remove("active1"); 
            const element = document.getElementById(mark); 
            element.classList.add("active1");
        });
    }
}); 
