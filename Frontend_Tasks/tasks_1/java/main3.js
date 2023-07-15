//set months and weekdays 
 
const months =['jan' ,'feb' ,'mar','april' ,'may' 
,'june', 'july' ,'aug' , 
'sep' ,'oct' ,'nov' ,'des'] 
 
const weekdays =['sun', 'mon', 'wen' ,'thus', 'fri', 'sat'] 
 
//get element 
 
let giveaway = document.querySelector('.giveaway'); 
let deadline = document.querySelector('.deadline'); 
let items = document.querySelectorAll('.deadline h4'); 
 
//set future time 
 
let futureDate = new Date(2021,3,15,12,50,20) 
//console.log(futureData);  
 
let year =futureDate.getFullYear(); 
let month =futureDate.getMonth(); 
month = months[month]; 
let day = futureDate.getDate(); 
let hours = futureDate.getHours(); 
let minutes =futureDate.getMinutes(); 
let weekday = futureDate.getDay(); 
weekday =weekdays[weekday]; 
 
giveaway.innerHTML =`giveaway end on ${weekday},${day},${month}, 
${year},${hours}:${minutes} am`; 
 
//future time in ms 
 
let futureTime = futureDate.getTime(); 
 
//make function to get remaing 
 
function getRemain(){ 
    //get the today date  
     
    let today = new Date ().getTime(); 
     
    let diff = futureTime - today; 
     
    let oneDay = 24*60*60*1000; 
    let oneHr = 60*60*1000; 
    let oneMin = 60*1000; 
    let oneSec =1000; 
     
     
    //diff in days  
     
    let days =diff/oneDay; 
    days =Math.floor(days); 
     
    let hours = (diff % oneDay)/oneHr;  
    hours = Math.floor(hours);
    let minutes = (diff % oneHr)/oneMin; 
    minutes = Math.floor(minutes); 
    let seconds = Math.floor((diff % oneMin)/oneSec); 
   // console.log(seconds); 
    
   //create values array 
   const values =[days,hours,minutes,seconds]; 
    
   //format 
    
   function format(x){ 
       if(x<10){ 
           return x=`0${x}`;
       } 
       return x;
   } 
    
   items.forEach(function(item,index){ 
         item.innerHTML =format(values[index]);
   }); 
  
    if(diff<0){ 
         clearInterval(cutDown); 
         deadline.innerHTML =`(<h2>sorry item has expired</h2>)`;
     }
}  
let cutDown =setInterval(getRemain,1000);
getRemain(); 

 
