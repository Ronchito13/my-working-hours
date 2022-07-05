
let hoursOfWork = document.getElementById("hoursOfWork");
let daysOfWork = document.getElementById("daysOfWork");
let hoursLeftToDo = document.getElementById("hoursLeftToDo");
let hoursIDid = document.getElementById("hoursIDid"); 
let chosenMonth = document.getElementById("months");
let chosenYear = document.getElementById("years");
let daysCounter, hoursCounter;
let getDaysInMonth = function(month,year) {  
 return new Date(year, month, 0).getDate();
};

let totalMonthlyWorkingHours = Math.floor((getDaysInMonth(parseInt(chosenMonth.value), parseInt(chosenYear.value)) - 8) * 8);

function getWorkdaysByDates(uid, month, year){
  if(month == 0 || year == 0){
    getWorkdays(uid, chosenMonth.value, chosenYear.value);
  } else {    
    getWorkdays(uid, month, year);    
  }  
}

function selectOption(month, year) {    
  let months = document.getElementById("months");
  months.value = month;
  let years = document.getElementById("years");
  years.value = year;
}



function updateCounters(MontlyHours, hoursDidAlready, HoursLeft, DaysOfWorkNumber){   
  let hoursOfWork = document.getElementById("hoursOfWork");
  let daysOfWork = document.getElementById("daysOfWork");
  let hoursLeftToDo = document.getElementById("hoursLeftToDo");
  let hoursIDid = document.getElementById("hoursIDid");
  let precentOfTime = document.getElementById("precentOfTime");  

  hoursOfWork.innerText = MontlyHours;
  daysOfWork.innerText = DaysOfWorkNumber;
  hoursLeftToDo.innerText = HoursLeft;
  hoursIDid.innerText = hoursDidAlready;  
  precentOfTime.setAttribute("style", "width:" +  Math.round(hoursDidAlready/MontlyHours * 100) + "%");
  precentOfTime.setAttribute("aria-valuenow", Math.round(hoursDidAlready/MontlyHours * 100));
  
}




// Get Hours

function getWorkdays(u_user, month, year){  
  let myHours = document.getElementById("myHours");    
  var xhttp = new XMLHttpRequest();
  let url = "./functions/requests-hours.php?getInfo=get_hours&uid=" + u_user + "&chosenMonth=" + month + "&chosenYear=" + year;      
  xhttp.open("GET", url, true);
  xhttp.onreadystatechange = function() {
  if (this.readyState == 4 && this.status == 200) { 
    myHours.innerHTML = '';    
    if(this.responseText !== "0 results"){ 
    let rounds = JSON.parse(this.responseText).length ;    
    console.log(JSON.parse(this.responseText));
    for(k = 0; k < rounds; k++){      
      let hid = JSON.parse(this.responseText)[k][0];      
      let hdate = JSON.parse(this.responseText)[k][1];
      let hin = JSON.parse(this.responseText)[k][2];        
      let hout = JSON.parse(this.responseText)[k][3];
      let uid = JSON.parse(this.responseText)[k][4];      
      createTable(hid, hdate, hin, hout, uid);      
    }    
  }  

  let timeIdid = howMuchTimeIDid();
  let monthlyWorkingHours = totalMonthlyWorkingHours - howMuchTimeIDid();
  let numOfRows = document.getElementById("myHours").rows.length;

  if(this.responseText === "0 results")  {    
    timeIdid = 0;
    monthlyWorkingHours = 0;
    numOfRows = 0;
  }
    
    
    updateCounters(totalMonthlyWorkingHours,  timeIdid , monthlyWorkingHours , numOfRows);
  }}; 
  
  xhttp.send();
}




function createTable(hid, hdate, hin, hout, uid){
      let tr = document.createElement("tr");      
      tr.id = hid;
                    
      let td1 = document.createElement("td");
      td1.append(hdate);

      let td2 = document.createElement("td");
      td2.append(hin);

      let td3 = document.createElement("td");
      td3.append(hout);      

                  
      calculateHours(hin, hout);     
      
      let td4 = document.createElement("td");
      td4.append(totleTimeYouDid);

      let td5 = document.createElement("td");
      td5.className = "pointer";
      td5.setAttribute("data-toggle", "modal");
      td5.setAttribute("data-target", "#theFixer");      
      td5.addEventListener("click", ()=>{
        setFixerDetails(hid, uid);
      });           
      let td5i = document.createElement("i");
      td5i.className = "fas fa-pencil-alt";      
      td5.append(td5i);

      let td6 = document.createElement("td");
      td6.className = "pointer";
      td6.addEventListener("click",()=>{
        deleteWorkday(hid);        
      })
      let td6i = document.createElement("i");
      td6i.className = "fas fa-trash-alt";
      td6i.id = "delete" + hid;
      td6.append(td6i);

      tr.append(td1);
      tr.append(td2);
      tr.append(td3);
      tr.append(td4);
      tr.append(td5);
      tr.append(td6);
      myHours.appendChild(tr); 

}



function howMuchTimeIDid(){
  let arrayOfHours = [];
  let x, splitTds,number,totalnumber = 0, sumHours;   
  for(i = 1; i < document.getElementById("myHours").rows.length + 1; i++){
  x = document.getElementById("theTableOfHours").rows[i].cells[3].innerText;
  splitTds = x.split(" ");
  number = splitTds[0] * 60 * 60 + splitTds[2] * 60;
  arrayOfHours.push(number);
  }  
  totalnumber = arrayOfHours.reduce((a, b) => a + b, 0);
  sumHours = Math.floor((totalnumber / 60) / 60);
  return sumHours;  
}

function calculateHours(hin, hout){
      let hinHowMuchTime = hin.split(":");      
      let hinSeconds = (parseInt(hinHowMuchTime[0]) * 60 * 60) + (parseInt(hinHowMuchTime[1]) * 60);
      let houtHowMuchTime = hout.split(":");
      let houtSeconds = (parseInt(houtHowMuchTime[0]) * 60 * 60) + (parseInt(houtHowMuchTime[1]) * 60);      
      return totleTimeYouDid = secondsToHms(houtSeconds - hinSeconds); 
}

function secondsToHms(d) {
  d = Number(d);
  var h = Math.floor(d / 3600);
  var m = Math.floor(d % 3600 / 60);
  // var s = Math.floor(d % 3600 % 60);

  var hDisplay = h > 0 ? h + (h == 1 ? " hour, " : " hours, ") : 0 + " Hours";
  var mDisplay = m > 0 ? m + (m == 1 ? " minute " : " minutes ") : 0 + " Minutes";
  
  // var sDisplay = s > 0 ? s + (s == 1 ? " second" : " seconds") : "";
  return hDisplay + mDisplay; 
}

// Insert Hours

function insertWorkday(u_user){   
            var xhttp = new XMLHttpRequest();
            let url = "./functions/requests-hours.php";
            let inhour = document.getElementById("inhour").value;
            let outhour = document.getElementById("outhour").value;
            let dateofhours = document.getElementById("dateofhours").value;
            let anyMessages = document.getElementById("anyMessages");
            let myHours = document.getElementById("myHours");
            
            let seprateDate = dateofhours.split("-");
            let theYear  = seprateDate[0];
            let theMonth  = seprateDate[1];              
            theMonth = parseInt(theMonth, 10);            

            // For Valid

            let inhourHowMuchTime = inhour.split(":");      
            let inhourSeconds = (parseInt(inhourHowMuchTime[0]) * 60 * 60) + (parseInt(inhourHowMuchTime[1]) * 60);
            let outhourHowMuchTime = outhour.split(":");      
            let outhourSeconds = (parseInt(outhourHowMuchTime[0]) * 60 * 60) + (parseInt(outhourHowMuchTime[1]) * 60);

            if(inhourSeconds > outhourSeconds){
            anyMessages.innerText = "Start time can't be later then the End Time!";
            setTimeout(()=>{
              anyMessages.innerText = "";
            }, 3000); 
            return false;
            }

            let params = "case=insert_hours&&hin=" + inhour + "&hout=" + outhour + "&hdate=" + dateofhours + "&huser=" + u_user;
            xhttp.open("POST", url, true);


            

            //Send the proper header information along with the request
            xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

            xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {              
              
              if(this.responseText == "Sorry, date already exist!"){                
                anyMessages.innerText = this.responseText;
                setTimeout(()=>{
                  anyMessages.innerText = "";
                }, 3000);
                return false;
              }

              anyMessages.innerText = "New Workday added successfully!";
              setTimeout(()=>{
                anyMessages.innerText = "";
              }, 3000);  
              
              let hid = JSON.parse(this.responseText)[0];      
              let hdate = JSON.parse(this.responseText)[1];
              let hin = JSON.parse(this.responseText)[2];        
              let hout = JSON.parse(this.responseText)[3];            
              let uid = JSON.parse(this.responseText)[4];
              createTable(hid, hdate, hin, hout, uid);               
              updateCounters(totalMonthlyWorkingHours,  howMuchTimeIDid() ,totalMonthlyWorkingHours - howMuchTimeIDid() , document.getElementById("myHours").rows.length);
              selectOption(theMonth, theYear);
              setTimeout(()=>{
                anyMessages.innerText = "";
              }, 3000);
            }
            };      

      
            xhttp.send(params);
}


// Update Hours


function setFixerDetails(hid, uid) {
  let theRowFixer = document.getElementById(hid);
  let theTds = [].slice.call(theRowFixer.querySelectorAll("td"));
  let theDate = theTds[0].innerText;  
  let inTime = theTds[1].innerText;  
  let outTime = theTds[2].innerText;   

  let fixDate = document.getElementById("fixDate");
  let fixInHour = document.getElementById("fixInHour");
  let fixOutHour = document.getElementById("fixOutHour");  
  let updateWorkdayBtn = document.getElementById("updateWorkdayBtn");   
  fixDate.innerText = "You want to fix this date: " + theDate;
  fixInHour.value = inTime;
  fixOutHour.value = outTime;    
  updateWorkdayBtn.setAttribute('onclick','updateWorkday(' + hid + ',' +  uid + ')');
    
}

function updateWorkday(hid, uid){    
  let fixInHour = document.getElementById("fixInHour").value;
  let fixOutHour = document.getElementById("fixOutHour").value;  
  var xhttp = new XMLHttpRequest();
  let url = "./functions/requests-hours.php";
  let params = "case=update_hours&&hid=" + hid + "&hin=" + fixInHour + "&hout=" + fixOutHour;
  xhttp.open("POST", url, true);  
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) { 
      if(xhttp.responseText){      
      let theRowUpdate = document.getElementById(JSON.parse(this.responseText)[0]);
      let theTds = [].slice.call(theRowUpdate.querySelectorAll("td"));      
      theTds[1].innerText = JSON.parse(this.responseText)[1];
      theTds[2].innerText = JSON.parse(this.responseText)[2];
      calculateHours(JSON.parse(this.responseText)[1], JSON.parse(this.responseText)[2]); 
      theTds[3].innerText = totleTimeYouDid;
      updateCounters(totalMonthlyWorkingHours,  howMuchTimeIDid() ,totalMonthlyWorkingHours - howMuchTimeIDid() , document.getElementById("myHours").rows.length);      
    }
  }}  
  xhttp.send(params);    
}




// Delete Hours


function deleteWorkday(did){     
  if(confirm("Are you sure you want to delete this?")){
  var xhttp = new XMLHttpRequest();
  let url = "./functions/requests-hours.php";        
  let params = "case=delete_hours&&h_id=" + did;
  document.getElementById(did).remove();
  xhttp.open("POST", url, true);
  //Send the proper header information along with the request
  xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');  
  xhttp.send(params);
  updateCounters(totalMonthlyWorkingHours,  howMuchTimeIDid() ,totalMonthlyWorkingHours - howMuchTimeIDid() , document.getElementById("myHours").rows.length);
};
  
}



// Extra codes


// Sort Table

let tableStatus = "up";

function sortByDate() {
  let dateTitle = document.getElementById("sortDateButton");    
  var tbody = document.querySelector("#myHours");
  var listOfRows = [];
  
  var rows = [].slice.call(tbody.querySelectorAll("tr"));
  for(i=0; i < rows.length; i++){
  let rowDate = (rows[i].innerText.split(" ")[0]).substring(8, 10);
  listOfRows.push([rowDate, rows[i]]);
  }

  if(tableStatus == "up"){
  dateTitle.innerText = "↑ Date";
  listOfRows.sort(function(a, b){return b[0] - a[0]});
  tbody.innerHTML = "";
  for(i=0; i < rows.length; i++){
    tbody.append(listOfRows[i][1]);
  }      
  tableStatus = "down"; 
 } else {
  dateTitle.innerText = "↓ Date";
  listOfRows.sort(function(a, b){return a[0] - b[0]});
  tbody.innerHTML = "";
  for(i=0; i < rows.length; i++){
    tbody.append(listOfRows[i][1]);
  }      
  tableStatus = "up"; 
 }
 
}


















