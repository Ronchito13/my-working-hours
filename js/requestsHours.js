
let hoursOfWork = document.getElementById("hoursOfWork");
let daysOfWork = document.getElementById("daysOfWork");
let hoursLeftToDo = document.getElementById("hoursLeftToDo");
let hoursIDid = document.getElementById("hoursIDid"); 
let chosenMonth = document.getElementById("months");
let chosenYear = document.getElementById("years");
let freeDaysIHave = document.getElementById("freeDaysIHave"); 
let freeDaysIDid = document.getElementById("freeDaysIDid"); 
let sickDaysIHave = document.getElementById("sickDaysIHave"); 
let sickDaysIDid = document.getElementById("sickDaysIDid");

let daysCounter, hoursCounter;
let getDaysInMonth = function(month,year) {  
 return new Date(year, month, 0).getDate();
};

let totalMonthlyWorkingHours;

let totalTimeOfWorking = localStorage.getItem("totalWorkingHours");
if(totalTimeOfWorking !== null && totalTimeOfWorking !== undefined){
  document.getElementById("updateHoursOfWork").value = totalTimeOfWorking;
  document.getElementById("updateHoursOfWork").placeholder = totalTimeOfWorking;
  totalMonthlyWorkingHours = totalTimeOfWorking;  
} else {
  document.getElementById("updateHoursOfWork").value = 186;
  document.getElementById("updateHoursOfWork").placeholder = 186;
  totalMonthlyWorkingHours = 186;  
}


let totalFreeDays = localStorage.getItem("totalFreeDays");
if(totalFreeDays !== null && totalFreeDays !== undefined){
  document.getElementById("updateFreeDays").value = totalFreeDays;
  document.getElementById("updateFreeDays").placeholder = totalFreeDays;  
} else {
  document.getElementById("updateFreeDays").value = 12;
  document.getElementById("updateFreeDays").placeholder = 12;  
}


let totalSickDays = localStorage.getItem("totalSickDays");
if(totalFreeDays !== null && totalFreeDays !== undefined){
  document.getElementById("updateSickDays").value = totalSickDays;
  document.getElementById("updateSickDays").placeholder = totalSickDays;  
} else {
  document.getElementById("updateSickDays").value = 12;
  document.getElementById("updateSickDays").placeholder = 12;  
}


function updateHoursOfWork(){
  localStorage.setItem("totalWorkingHours", document.getElementById("updateHoursOfWork").value);
  totalMonthlyWorkingHours = document.getElementById("updateHoursOfWork").value; 
  document.getElementById("hoursOfWork").innerText = document.getElementById("updateHoursOfWork").value;  
}

function updateFreeDays(){
  let totalMonthlyFreeDays = 0;
  localStorage.setItem("totalFreeDays", document.getElementById("updateFreeDays").value);
  totalMonthlyFreeDays = document.getElementById("updateFreeDays").value / 12;     
  return totalMonthlyFreeDays;
}

function updateSickDays(){
  let totalMonthlySickDays = 0;
  localStorage.setItem("totalSickDays", document.getElementById("updateSickDays").value);
  totalMonthlySickDays = document.getElementById("updateSickDays").value / 12;  
  return totalMonthlySickDays;
}

function setNewNumbers(){
  howManyFreeDaysIHave();
  howManySickDaysIHave();
}

function getWorkdaysByDates(uid, month, year){
  let theCompanyName = document.getElementById("theCompanyName").innerText;
  if(month == 0 || year == 0){
    getWorkdays(uid, chosenMonth.value, chosenYear.value, theCompanyName);
  } else {    
    getWorkdays(uid, month, year, theCompanyName);    
  }  
}

function selectOption(month, year) {    
  let months = document.getElementById("months");
  months.value = month;
  let years = document.getElementById("years");
  years.value = year;
}


function howManySickDaysIHave(){ 

  let companyName = document.getElementById("theCompanyName").innerText;   
  let uid = document.getElementById("theUserId").value;  
  let startDateOfWork = new Date(document.getElementById("startDateOfWork").innerText);
  let todayDate = new Date();
  let workingMonths = todayDate.getMonth() - startDateOfWork.getMonth() + 12 * (todayDate.getFullYear() - startDateOfWork.getFullYear());
  var xhttp = new XMLHttpRequest();  
  let url = "./functions/requests-hours.php?getInfo=get_how_many_sick_days_i_have&uid=" + uid + "&companyName=" + companyName;      
  xhttp.open("GET", url, true);
  xhttp.onreadystatechange = function() {
  if (this.readyState == 4 && this.status == 200) {             
    let numOfSickDaysUsedInTotal = parseInt(this.responseText);     
    document.getElementById("sickDaysIHave").innerText = Math.floor((workingMonths * updateSickDays())  - numOfSickDaysUsedInTotal); 
  }};  
  xhttp.send();    
}


function howManyFreeDaysIHave(){ 

  let companyName = document.getElementById("theCompanyName").innerText;   
  let uid = document.getElementById("theUserId").value;  
  let startDateOfWork = new Date(document.getElementById("startDateOfWork").innerText);
  let todayDate = new Date();
  let workingMonths = todayDate.getMonth() - startDateOfWork.getMonth() + 12 * (todayDate.getFullYear() - startDateOfWork.getFullYear());
  var xhttp = new XMLHttpRequest();  
  let url = "./functions/requests-hours.php?getInfo=get_how_many_free_days_i_have&uid=" + uid + "&companyName=" + companyName;      
  xhttp.open("GET", url, true);
  xhttp.onreadystatechange = function() {
  if (this.readyState == 4 && this.status == 200) {             
    let numOfFreeDaysUsedInTotal = parseInt(this.responseText);     
    document.getElementById("freeDaysIHave").innerText = Math.floor((workingMonths * updateFreeDays()) - numOfFreeDaysUsedInTotal); 
  }};  
  xhttp.send();    
}



function updateCounters(MontlyHours, hoursDidAlready, HoursLeft, DaysOfWorkNumber, freeDays, freeDaysUsed, sickDays, sickDaysUsed){   
  let hoursOfWork = document.getElementById("hoursOfWork");
  let daysOfWork = document.getElementById("daysOfWork");
  let hoursLeftToDo = document.getElementById("hoursLeftToDo");
  let hoursIDid = document.getElementById("hoursIDid");
  let precentOfTime = document.getElementById("precentOfTime"); 
  let freeDaysIHave = document.getElementById("freeDaysIHave"); 
  let freeDaysIDid = document.getElementById("freeDaysIDid"); 
  let sickDaysIHave = document.getElementById("sickDaysIHave"); 
  let sickDaysIDid = document.getElementById("sickDaysIDid"); 
  
  

  hoursOfWork.innerText = MontlyHours;
  daysOfWork.innerText = DaysOfWorkNumber;
  hoursLeftToDo.innerText = HoursLeft;
  hoursIDid.innerText = hoursDidAlready;  
  freeDaysIHave.innerText = freeDays;  
  freeDaysIDid.innerText = freeDaysUsed;  
  sickDaysIHave.innerText = sickDays;  
  sickDaysIDid.innerText = sickDaysUsed;  
  precentOfTime.setAttribute("style", "width:" +  Math.round(hoursDidAlready/MontlyHours * 100) + "%");
  precentOfTime.setAttribute("aria-valuenow", Math.round(hoursDidAlready/MontlyHours * 100));
  
}

// how many Sick Days I see

function howManySickDaysISee() {
  // Declare variables
  var table, tr, td, i, count = 0;  
  table = document.getElementById("myHours");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[3].innerText;
    if(td === "Sick Day"){count++};
  } 
  return count;
}


// Get Hours

function getWorkdays(u_user, month, year, companyName){  
  let myHours = document.getElementById("myHours");    
  var xhttp = new XMLHttpRequest();  
  let url = "./functions/requests-hours.php?getInfo=get_hours&uid=" + u_user + "&chosenMonth=" + month + "&chosenYear=" + year + "&companyName=" + companyName;      
  xhttp.open("GET", url, true);
  xhttp.onreadystatechange = function() {
  if (this.readyState == 4 && this.status == 200) {     
    myHours.innerHTML = '';    
    if(this.responseText !== "0 results"){ 
    let rounds = JSON.parse(this.responseText).length ;        
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
  let numOfRows = document.getElementById("myHours").rows.length - howManySickDaysISee();

  if(this.responseText === "0 results")  {    
    timeIdid = 0;
    monthlyWorkingHours = 0;
    numOfRows = 0;
  }
    
    
    updateCounters(totalMonthlyWorkingHours,  timeIdid , monthlyWorkingHours , numOfRows, howManyFreeDaysIHave(), howMuchFreeDaysIDid(), howManySickDaysIHave(), howMuchSickDaysIDid());
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
      td4.append(totalTimeYouDid);

      let td5 = document.createElement("td");
      if(totalTimeYouDid !== "Sick Day" && totalTimeYouDid !== "Free Day"){        
      td5.className = "pointer";
      td5.setAttribute("data-toggle", "modal");
      td5.setAttribute("data-target", "#theFixer");      
      td5.addEventListener("click", ()=>{
        setFixerDetails(hid, uid);
      });           
      let td5i = document.createElement("i");
      td5i.className = "fas fa-pencil-alt";      
      td5.append(td5i);
      }
      else if (totalTimeYouDid === "Sick Day") {      
        let td5i = document.createElement("i");
        td5i.className = "fas fa-head-side-cough";      
        td5.append(td5i);
      } else {
        let td5i = document.createElement("i");
        td5i.className = "far fa-smile-beam";      
        td5.append(td5i);
      }    

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


function howMuchSickDaysIDid(){
  let arrayOfSickDays = [];
  let x = 0, checkText ,sumSickDays = 0;   
  for(i = 1; i < document.getElementById("myHours").rows.length + 1; i++){
    checkText = document.getElementById("theTableOfHours").rows[i].cells[3].innerText;
  if(checkText === "Sick Day"){
    x = 1;
  } else {
    x = 0;
  }  
  arrayOfSickDays.push(x);
  }  
  sumSickDays = arrayOfSickDays.reduce((a, b) => a + b, 0);  
  return sumSickDays;  
}


function howMuchFreeDaysIDid(){
  let arrayOfFreeDays = [];
  let x = 0, checkText ,sumFreeDays = 0;   
  for(i = 1; i < document.getElementById("myHours").rows.length + 1; i++){
    checkText = document.getElementById("theTableOfHours").rows[i].cells[3].innerText;
  if(checkText === "Free Day"){
    x = 1;
  } else {
    x = 0;
  }  
  arrayOfFreeDays.push(x);
  }  
  sumFreeDays = arrayOfFreeDays.reduce((a, b) => a + b, 0);  
  return sumFreeDays;  
}



function howMuchTimeIDid(){
  let arrayOfHours = [];
  let x, splitTds,number,totalnumber = 0, sumHours;   
  for(i = 1; i < document.getElementById("myHours").rows.length + 1; i++){
  x = document.getElementById("theTableOfHours").rows[i].cells[3].innerText;
  if(x === "Sick Day"){    
    number = 0;
  } else if (x === "Free Day"){    
    number = 9 * 60 * 60;
  } else {
    splitTds = x.split(" ");    
    number = splitTds[0] * 60 * 60 + splitTds[2] * 60;
  }  
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
      
      if(hin === '0' && hout === '0'){
        return totalTimeYouDid = "Sick Day";   
      }

      if(hin === '9' && hout === '9'){
        return totalTimeYouDid = "Free Day";   
      }

      return totalTimeYouDid = secondsToHms(houtSeconds - hinSeconds); 
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
            let companyName = document.getElementById("theCompanyName").innerText;
            
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

            let params = "case=insert_hours&&hin=" + inhour + "&hout=" + outhour + "&hdate=" + dateofhours + "&huser=" + u_user + "&u_company_name=" + companyName;
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
              updateCounters(totalMonthlyWorkingHours,  howMuchTimeIDid() ,totalMonthlyWorkingHours - howMuchTimeIDid() , document.getElementById("myHours").rows.length - howManySickDaysISee(), howManyFreeDaysIHave(), howMuchFreeDaysIDid(), howManySickDaysIHave(), howMuchSickDaysIDid());
              selectOption(theMonth, theYear);
              setTimeout(()=>{
                anyMessages.innerText = "";
              }, 3000);
            }
            };      

      
            xhttp.send(params);
}

// Insert Sick Days

function insertSickDays(u_user){   
  var xhttp = new XMLHttpRequest();
  let url = "./functions/requests-hours.php";  
  let dateofSickDay = document.getElementById("dateofSickDays").value;
  let anyMessages = document.getElementById("anyMessages"); 
  let companyName = document.getElementById("theCompanyName").innerText; 
  
  let seprateDate = dateofSickDay.split("-");
  let theYear  = seprateDate[0];
  let theMonth  = seprateDate[1];              
  theMonth = parseInt(theMonth, 10);    

  let params = "case=insert_sick_days&sdate=" + dateofSickDay + "&huser=" + u_user + "&company_name=" + companyName;
  xhttp.open("POST", url, true);

  //Send the proper header information along with the request
  xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

  xhttp.onreadystatechange = function() {
  if (this.readyState == 4 && this.status == 200) {              
    
    if(this.responseText == "Sorry, date already used for this company!"){                
      anyMessages.innerText = this.responseText;
      setTimeout(()=>{
        anyMessages.innerText = "";
      }, 3000);
      return false;
    }

    anyMessages.innerText = "New Sick day added successfully!";
    setTimeout(()=>{
      anyMessages.innerText = "";
    }, 3000);  
    
    let hid = JSON.parse(this.responseText)[0];      
    let hdate = JSON.parse(this.responseText)[1];
    let hin = '0';        
    let hout = '0';            
    let uid = JSON.parse(this.responseText)[4];    
    createTable(hid, hdate, hin, hout, uid);               
    updateCounters(totalMonthlyWorkingHours,  howMuchTimeIDid() ,totalMonthlyWorkingHours - howMuchTimeIDid() , document.getElementById("myHours").rows.length - howManySickDaysISee(), howManyFreeDaysIHave(), howMuchFreeDaysIDid(), howManySickDaysIHave(), howMuchSickDaysIDid());
    selectOption(theMonth, theYear);
    setTimeout(()=>{
      anyMessages.innerText = "";
    }, 3000);
  }
  };      


  xhttp.send(params);
}



// Insert Free Days

function insertFreeDays(u_user){   
  var xhttp = new XMLHttpRequest();
  let url = "./functions/requests-hours.php";  
  let dateofFreeDay = document.getElementById("dateofFreeDays").value;
  let anyMessages = document.getElementById("anyMessages");
  let companyName = document.getElementById("theCompanyName").innerText;  
  
  let seprateDate = dateofFreeDay.split("-");
  let theYear  = seprateDate[0];
  let theMonth  = seprateDate[1];              
  theMonth = parseInt(theMonth, 10);    

  let params = "case=insert_free_days&sdate=" + dateofFreeDay + "&huser=" + u_user + "&company_name=" + companyName;
  xhttp.open("POST", url, true);

  //Send the proper header information along with the request
  xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

  xhttp.onreadystatechange = function() {
  if (this.readyState == 4 && this.status == 200) {              
    
    if(this.responseText == "Sorry, date already used for this company!"){                
      anyMessages.innerText = this.responseText;
      setTimeout(()=>{
        anyMessages.innerText = "";
      }, 3000);
      return false;
    }

    anyMessages.innerText = "New Free day added successfully!";
    setTimeout(()=>{
      anyMessages.innerText = "";
    }, 3000);  
    
    let hid = JSON.parse(this.responseText)[0];      
    let hdate = JSON.parse(this.responseText)[1];
    let hin = '9';        
    let hout = '9';            
    let uid = JSON.parse(this.responseText)[4];    
    createTable(hid, hdate, hin, hout, uid);               
    updateCounters(totalMonthlyWorkingHours,  howMuchTimeIDid() ,totalMonthlyWorkingHours - howMuchTimeIDid() , document.getElementById("myHours").rows.length - howManySickDaysISee(), howManyFreeDaysIHave(), howMuchFreeDaysIDid(), howManySickDaysIHave(), howMuchSickDaysIDid());
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
  let theCompanyName = document.getElementById("theCompanyName").innerText; 
  var xhttp = new XMLHttpRequest();
  let url = "./functions/requests-hours.php";
  let params = "case=update_hours&&hid=" + hid + "&hin=" + fixInHour + "&hout=" + fixOutHour + "&company_name=" + theCompanyName;
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
      theTds[3].innerText = totalTimeYouDid;
      updateCounters(totalMonthlyWorkingHours,  howMuchTimeIDid() ,totalMonthlyWorkingHours - howMuchTimeIDid() , document.getElementById("myHours").rows.length - howManySickDaysISee(), howManyFreeDaysIHave(), howMuchFreeDaysIDid(), howManySickDaysIHave(), howMuchSickDaysIDid());      
    }
  }}  
  xhttp.send(params);    
}




// Add new comapny
function addNewCompany(userId){    
  let newCompanyName = document.getElementById("newCompanyName").value;
  let addCompanyStartDate = document.getElementById("addCompanyStartDate").value;  
  var xhttp = new XMLHttpRequest();
  let url = "./functions/requests-hours.php";
  let params = "case=add_new_company&&huser=" + userId + "&company_name=" + newCompanyName + "&company_start_date=" + addCompanyStartDate;
  xhttp.open("POST", url, true);  
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {      
      if(xhttp.responseText){  
      document.getElementById("theCompanyName").innerText = JSON.parse(this.responseText)[0]; 
      document.getElementById("theChoosenSelectedCompnay").value = JSON.parse(this.responseText)[0]; 
      document.getElementById("theChoosenSelectedCompnay").innerText = JSON.parse(this.responseText)[0];      
      updateCounters(totalMonthlyWorkingHours,  howMuchTimeIDid() ,totalMonthlyWorkingHours - howMuchTimeIDid() , document.getElementById("myHours").rows.length, 0, 0, 0, howMuchSickDaysIDid());      
    }
  }}  
  xhttp.send(params);    
}


// Set Company
function setCompany(userId, companyName){  
  var xhttp = new XMLHttpRequest();
  let url = "./functions/requests-hours.php";
  let params = "case=update_company&&huser=" + userId + "&company_name=" + companyName;
  xhttp.open("POST", url, true);  
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {      
      if(xhttp.responseText){  
      document.getElementById("theCompanyName").innerText = companyName;
      setTimeout(()=>{
        document.getElementById("startDateOfWork").innerText = document.getElementById("selectCompanyName").querySelector("[selected=true]").id;                 
        document.getElementById("editCompanyStartDate").value = document.getElementById("selectCompanyName").querySelector("[selected=true]").id;
      },100);             
      getWorkdaysByDates(userId, (new Date().getMonth() + 1).toString(), new Date().getFullYear().toString());       
      updateCounters(totalMonthlyWorkingHours,  howMuchTimeIDid() ,totalMonthlyWorkingHours - howMuchTimeIDid() , document.getElementById("myHours").rows.length - howManySickDaysISee(), howManyFreeDaysIHave(), howMuchFreeDaysIDid(), howManySickDaysIHave(), howMuchSickDaysIDid());                  
      window.location.reload();
    }
  }}  
  xhttp.send(params);
}


// Set Company
function setNewCompanyStartDate(userId, comapnyStartDate){ 
  let thecomapny = document.getElementById("selectCompanyName").querySelector("[selected=true]").value;  
  var xhttp = new XMLHttpRequest();
  let url = "./functions/requests-hours.php";
  let params = "case=update_company_start_date&&huser=" + userId + "&company_name=" + thecomapny + "&company_start_date=" + comapnyStartDate;
  xhttp.open("POST", url, true);  
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {      
      if(xhttp.responseText){                     
        getWorkdaysByDates(userId, (new Date().getMonth() + 1).toString(), new Date().getFullYear().toString());       
      updateCounters(totalMonthlyWorkingHours,  howMuchTimeIDid() ,totalMonthlyWorkingHours - howMuchTimeIDid() , document.getElementById("myHours").rows.length, 0, howMuchFreeDaysIDid(), 0, howMuchSickDaysIDid());                        
    }
  }}  
  xhttp.send(params);
}

// Get all Companies
function getAllCompanies(userId){
  
  let selectCompanyName = document.getElementById("selectCompanyName");  
  let selectCompanyNameCurrentValue = document.getElementById("theCompanyName").innerText;  
  var xhttp = new XMLHttpRequest();
  let url = "./functions/requests-hours.php";
  let params = "case=get_all_companies&&huser=" + userId;
  xhttp.open("POST", url, true);  
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {      
      if(this.responseText){ 
        selectCompanyName.innerHTML = "";
        
        for(let i = 0; i < xhttp.responseText.length ; i++){
          let option = document.createElement("option");
          option.setAttribute("value", JSON.parse(this.responseText)[i][1]);
          option.innerText = JSON.parse(this.responseText)[i][1];                    
          if(selectCompanyNameCurrentValue === JSON.parse(this.responseText)[i][1]){
            option.setAttribute("selected", true);
            document.getElementById("startDateOfWork").innerText = JSON.parse(this.responseText)[i][2];
            document.getElementById("editCompanyStartDate").value = JSON.parse(this.responseText)[i][2];            
          }
          selectCompanyName.appendChild(option);
        }     

      updateCounters(totalMonthlyWorkingHours,  howMuchTimeIDid() ,totalMonthlyWorkingHours - howMuchTimeIDid() , document.getElementById("myHours").rows.length - howManySickDaysISee(), howManyFreeDaysIHave(), howMuchFreeDaysIDid(), howManySickDaysIHave(), howMuchSickDaysIDid());      
    }
  }}  
  xhttp.send(params);    
}







// Delete Hours


function deleteWorkday(did){     
  if(confirm("Are you sure you want to delete this?")){
  let theCompanyName = document.getElementById("theCompanyName").innerText;  
  let xhttp = new XMLHttpRequest();
  let url = "./functions/requests-hours.php";        
  let params = "case=delete_hours&&h_id=" + did + "&company_name=" + theCompanyName;
  document.getElementById(did).remove();
  xhttp.open("POST", url, true);
  //Send the proper header information along with the request
  xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');  
  xhttp.send(params);
  updateCounters(totalMonthlyWorkingHours,  howMuchTimeIDid() ,totalMonthlyWorkingHours - howMuchTimeIDid() , document.getElementById("myHours").rows.length - howManySickDaysISee(), howManyFreeDaysIHave(), howMuchFreeDaysIDid(), howManySickDaysIHave(), howMuchSickDaysIDid());
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



// Download PDF

// Set Company
function downloadPDF(){ 

  let userName = document.getElementById("userName").innerText; 
  let theCompanyName = document.getElementById("theCompanyName").innerText;  
  let months = document.getElementById("months").value;  
  let years = document.getElementById("years").value;  
  let hoursOfWork = document.getElementById("hoursOfWork").innerText; 
  let hoursIDid = document.getElementById("hoursIDid").innerText; 
  let hoursLeftToDo = document.getElementById("hoursLeftToDo").innerText;
  let daysOfWork = document.getElementById("daysOfWork").innerText; 
  let freeDaysIHave = document.getElementById("freeDaysIHave").innerText; 
  let freeDaysIDid = document.getElementById("freeDaysIDid").innerText; 
  let sickDaysIHave = document.getElementById("sickDaysIHave").innerText; 
  let sickDaysIDid = document.getElementById("sickDaysIDid").innerText; 
  
  

  
  var xhttp = new XMLHttpRequest();
  let url = "./functions/downloadReport.php";
  let params = "user_name=" + userName + "&company_name=" + theCompanyName + "&the_month=" + months + "&the_yaer=" + years + "&hours_of_work=" + hoursOfWork + "&hours_i_did=" + hoursIDid + "&hours_missing=" + hoursLeftToDo + "&how_many_days_i_worked=" + daysOfWork + "&free_days_i_have=" + freeDaysIHave + "&free_days_i_did=" + freeDaysIDid + "&sick_days_i_have=" + sickDaysIHave + "&sick_days_i_have=" + sickDaysIDid;
  xhttp.open("POST", url, true);  
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {      
      if(xhttp.responseText){                     
        window.location = `./functions/downloadReport.php?user_name=${userName}&company_name=${theCompanyName}&the_month=${months}&the_year=${years}&hours_of_work=${hoursOfWork}&hours_i_did=${hoursIDid}&hours_missing=${hoursLeftToDo}&how_many_days_i_worked=${daysOfWork}&free_days_i_have=${freeDaysIHave}&free_days_i_did=${freeDaysIDid}&sick_days_i_have=${sickDaysIHave}&sick_days_i_did=${sickDaysIDid}`;
    }
  }}  
  xhttp.send(params);
}

















