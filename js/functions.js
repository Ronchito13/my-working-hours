function showTimeAndDate(){
    let tad = document.getElementById("timeAndDate");

    options = {
        year: 'numeric', month: 'numeric', day: 'numeric',
        hour: 'numeric', minute: 'numeric', second: 'numeric',
        hour12: false        
      };

    const d = new Date();
    let theDate = new Intl.DateTimeFormat('default', options).format(d); 
    tad.innerText = theDate;   
}

showTimeAndDate();
setInterval(()=>{
showTimeAndDate();
},1000); 













