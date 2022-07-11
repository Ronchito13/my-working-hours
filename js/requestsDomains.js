let ourDomains = document.getElementById("ourDomains");
let ourExpiredDomains = document.getElementById("ourExpiredDomains");
let newDomain = document.getElementById("newDomain");



newDomain.addEventListener("click",()=>{    
  insertDomain();
})

// Get Notes

function getDomains(){ 

  let tmpDate = new Date(); 
  let oneMonthBefore = tmpDate.setMonth(tmpDate.getMonth() - 1);  
  let pfd = 0;
  let ado = 0;
  let soex = 0;  
  let actb = 0;
  let genb = 0;

    var xhttp = new XMLHttpRequest();
    let url = "./functions/requests-domains.php?getInfo=get_domains";      
    xhttp.open("GET", url, true);
    xhttp.onreadystatechange = function() {      
    if (this.readyState == 4 && this.status == 200) {      
      ourDomains.innerHTML = '';
      let rounds = JSON.parse(this.responseText).length; 
      for(k = 0; k < rounds; k++){      
        let did = JSON.parse(this.responseText)[k][0];      
        let dname = JSON.parse(this.responseText)[k][1];
        let durl = JSON.parse(this.responseText)[k][2];        
        let dprice = parseInt(JSON.parse(this.responseText)[k][3]);
        let dsupplier = JSON.parse(this.responseText)[k][4];        
        let dserver = JSON.parse(this.responseText)[k][5];
        let dpurpose = JSON.parse(this.responseText)[k][6];
        let dexpiryDate = JSON.parse(this.responseText)[k][7];
        let drenew = JSON.parse(this.responseText)[k][8];
        let dprotected = JSON.parse(this.responseText)[k][9];

        pfd += dprice;
        
        if(dpurpose == "brand"){
          actb += 1;
        }

        if(dpurpose == "general"){
          genb += 1;
        }        

        if((Date.parse(dexpiryDate) - 2591999946) <=  oneMonthBefore){
          soex += 1;
          createExpiredDomain(did, dname, durl, dprice, dsupplier, dserver, dpurpose, dexpiryDate, drenew, dprotected);        
        } else {
          ado += 1;
          createDomain(did, dname, durl, dprice, dsupplier, dserver, dpurpose, dexpiryDate, drenew, dprotected);        
        }      
        
      }

      // updateDomainsTopBoxes();   
    }}; 
    
    xhttp.send();
  }

  function createDomain(did, dname, durl, dprice, dsupplier, dserver, dpurpose, dexpiryDate, drenew, dprotected){      
      let tr = document.createElement("tr");      
      tr.id = "dr" + did;
                    
      let td1 = document.createElement("td");
      td1.append(dname);

      let td2 = document.createElement("td");
      let td2a = document.createElement("a");
      td2a.setAttribute("href", "http://" + durl);    
      td2a.innerText = durl;    
      td2.append(td2a);

      let td3 = document.createElement("td");
      td3.append(dprice);      
      
      let td4 = document.createElement("td");
      td4.append(dsupplier);

      let td5 = document.createElement("td");
      td5.append(dserver);

      let td6 = document.createElement("td");
      td6.append(dpurpose);

      let td7 = document.createElement("td");
      td7.append(dexpiryDate);

      let td8 = document.createElement("td");
      td8.append(drenew);

      let td9 = document.createElement("td");
      td9.append(dprotected);

      let td10 = document.createElement("td");
      td10.className = "pointer";
      td10.setAttribute("data-toggle", "modal");
      td10.setAttribute("data-target", "#domainSettings");
      td10.addEventListener("click", ()=>{
        setModalDetails(did, dname, durl, dprice, dsupplier, dserver, dpurpose, dexpiryDate, drenew, dprotected);
      });
      let td10i = document.createElement("i");
      td10i.className = "fas fa-cog large";      
      td10.append(td10i);     

      
      tr.append(td2);            
      tr.append(td7);      
      tr.append(td10);
      ourDomains.appendChild(tr); 
      // updateDomainsTopBoxes(pfd, ado, soex, sera, actb, genb);   
  }

  function createExpiredDomain(did, dname, durl, dprice, dsupplier, dserver, dpurpose, dexpiryDate, drenew, dprotected){      
    let tr = document.createElement("tr");      
    tr.id = "dr" + did;
                  
    let td1 = document.createElement("td");
    td1.append(dname);

    let td2 = document.createElement("td");
      let td2a = document.createElement("a");
      td2a.setAttribute("href", "http://" + durl);    
      td2a.innerText = durl;    
      td2.append(td2a);

    let td3 = document.createElement("td");
    td3.append(dprice);      
    
    let td4 = document.createElement("td");
    td4.append(dsupplier);

    let td5 = document.createElement("td");
    td5.append(dserver);

    let td6 = document.createElement("td");
    td6.append(dpurpose);

    let td7 = document.createElement("td");
    td7.append(dexpiryDate);

    let td8 = document.createElement("td");
    td8.append(drenew);

    let td9 = document.createElement("td");
    td9.append(dprotected);

    let td10 = document.createElement("td");
    td10.className = "pointer";
    td10.setAttribute("data-toggle", "modal");
    td10.setAttribute("data-target", "#domainSettings");
    td10.addEventListener("click", ()=>{
      setModalDetails(did, dname, durl, dprice, dsupplier, dserver, dpurpose, dexpiryDate, drenew, dprotected);
    });     
    let td10i = document.createElement("i");
    td10i.className = "fas fa-cog large";    
    td10.append(td10i);     

    tr.append(td2);         
    tr.append(td7);      
    tr.append(td10);
    ourExpiredDomains.appendChild(tr); 

}

  function cleanInputs(){
    document.getElementById("dTitle").value = "";
    document.getElementById("dUrl").value = "";
    document.getElementById("dPrice").value = "";
    document.getElementById("dSupplier").value = 0;
    document.getElementById("dServer").value = 0;
    document.getElementById("dCategory").value = 0;    
    document.getElementById("dRenew").value = 0;
    document.getElementById("dProtected").value = 0;
  }

  
  function insertDomain(){   
    var xhttp = new XMLHttpRequest();
    let url = "./functions/requests-domains.php";
    let dTitle = document.getElementById("dTitle").value;
    let dUrl = document.getElementById("dUrl").value;
    let dPrice = document.getElementById("dPrice").value;
    let dSupplier = document.getElementById("dSupplier").value;
    let dServer = document.getElementById("dServer").value;
    let dCategory = document.getElementById("dCategory").value;
    let dExpirationDate = document.getElementById("dExpirationDate").value;
    let dRenew = document.getElementById("dRenew").value;
    let dProtected = document.getElementById("dProtected").value;
    let todayDate = Date.parse(new Date());    
    let fourYearsFromNow = Date.parse(new Date().getFullYear() + 4); 
    

    if(dTitle == ""){      
      document.getElementById("dTitle").style.border = "2px solid red";
      setTimeout(()=>{
        document.getElementById("dTitle").style.border = "";
      },3000)
      return false;
    }

    

    if(dUrl == ""){
      document.getElementById("dUrl").style.border = "2px solid red";
      setTimeout(()=>{
        document.getElementById("dUrl").style.border = "";
      },3000)
      return false;
    }

    

    if(dPrice == ""){
      document.getElementById("dPrice").style.border = "2px solid red";
      setTimeout(()=>{
        document.getElementById("dPrice").style.border = "";
      },3000)
      return false;
    }

    

    if(dSupplier == "0"){
      document.getElementById("dSupplier").style.border = "2px solid red";
      setTimeout(()=>{
        document.getElementById("dSupplier").style.border = "";
      },3000)
      return false;
    }

   

    if(dServer == "0"){
      document.getElementById("dServer").style.border = "2px solid red";
      setTimeout(()=>{
        document.getElementById("dServer").style.border = "";
      },3000)
      return false;
    }

    
    if(dCategory == "0"){
      document.getElementById("dCategory").style.border = "2px solid red";
      setTimeout(()=>{
        document.getElementById("dCategory").style.border = "";
      },3000)
      return false;
    }

    

    if(dExpirationDate == ""){
      document.getElementById("dExpirationDate").style.border = "2px solid red";
      setTimeout(()=>{
        document.getElementById("dExpirationDate").style.border = "";
      },3000)
      return false;
    }
    
    if(Date.parse(dExpirationDate) < todayDate){
      document.getElementById("dExpirationDate").style.border = "2px solid red";
      setTimeout(()=>{
        document.getElementById("dExpirationDate").style.border = "";
      },3000)
      return false;
    }

    if(Date.parse(dExpirationDate) > fourYearsFromNow){
      document.getElementById("dExpirationDate").style.border = "2px solid red";
      setTimeout(()=>{
        document.getElementById("dExpirationDate").style.border = "";
      },3000)
      return false;
    }
    
    if(dRenew == "0"){
      document.getElementById("dRenew").style.border = "2px solid red";
      setTimeout(()=>{
        document.getElementById("dRenew").style.border = "";
      },3000)
      return false;
    }

    

    if(dProtected == "0"){
      document.getElementById("dProtected").style.border = "2px solid red";
      setTimeout(()=>{
        document.getElementById("dProtected").style.border = "";
      },3000)
      return false;
    }

    let params = "case=insert_domains&&dname=" + dTitle + "&durl=" + dUrl + "&dprice=" + dPrice + "&dsupplier=" + dSupplier + "&dserver=" + dServer + "&dpurpose=" + dCategory + "&dexpirydate=" + dExpirationDate + "&drenew=" + dRenew + "&dprotected=" + dProtected;
    xhttp.open("POST", url, true);

    //Send the proper header information along with the request
    xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {              
      
      if(this.responseText == "Domain already exist in system!"){                
        alert(this.responseText);        
        return false;
      }
      
      let did = JSON.parse(this.responseText)[0];      
      let dname = JSON.parse(this.responseText)[1];
      let durl = JSON.parse(this.responseText)[2];        
      let dprice = JSON.parse(this.responseText)[3];
      let dsupplier = JSON.parse(this.responseText)[4];        
      let dserver = JSON.parse(this.responseText)[5];
      let dpurpose = JSON.parse(this.responseText)[6];
      let dexpiryDate = JSON.parse(this.responseText)[7];      
      let drenew = JSON.parse(this.responseText)[8];
      let dprotected = JSON.parse(this.responseText)[9];     
      createDomain(did, dname, durl, dprice, dsupplier, dserver, dpurpose, dexpiryDate, drenew, dprotected);
      cleanInputs();
    }
    };

    xhttp.send(params);
}

function setModalDetails(did, dname, durl, dprice, dsupplier, dserver, dpurpose, dexpiryDate, drenew, dprotected) { 
  
  let closeDomain = document.createElement("button");
  closeDomain.setAttribute("type", "button");  
  closeDomain.className = "btn btn-success";
  closeDomain.setAttribute("data-dismiss", "modal");   
  closeDomain.innerText = "Ok";
  closeDomain.addEventListener("click", ()=>{
    updateDomain(did, dname, durl);
  })

  let deleteDomain = document.createElement("button");
  deleteDomain.setAttribute("type", "button");
  deleteDomain.id = did;
  deleteDomain.className = "btn btn-danger";
  deleteDomain.setAttribute("data-dismiss", "modal");   
  deleteDomain.innerText = "Delete Domain";
  deleteDomain.addEventListener("click", ()=>{
    if(confirm("Are you sure?")){      
      deleteDomainNowPlease(did);
    }
  })
  document.getElementById("domainSettingHeader").innerText = durl;
  document.getElementById("modalFooter").innerText = "";  
  document.getElementById("modalFooter").append(deleteDomain);
  document.getElementById("modalFooter").append(closeDomain);  
  document.getElementById("dimp").value = dpurpose;
  document.getElementById("dipa").value = dprice;
  document.getElementById("dsup").value = dsupplier;
  document.getElementById("dser").value = dserver;
  document.getElementById("dexp").value = dexpiryDate;
  
  if(drenew == "yes"){
    document.getElementById("drenewChecker").checked = true;
  } else {
    document.getElementById("drenewChecker").checked = false;
  }
  if(dprotected == "yes"){
  document.getElementById("dprotectedChecker").checked = true;    
  } else {
    document.getElementById("dprotectedChecker").checked = false;
  }
}



function updateDomainsTopBoxes(){
  let payDom = document.getElementById("payDom");
  let actDom = document.getElementById("actDom");
  let expDom = document.getElementById("expDom");
  let serDom = document.getElementById("serDom");
  let braDom = document.getElementById("braDom");  
  let genDom = document.getElementById("genDom"); 

  var xhttp = new XMLHttpRequest();  
  let url = "./functions/requests-domains.php?getInfo=get_boxes";      
  xhttp.open("GET", url, true);
  xhttp.onreadystatechange = function() {      
  if (this.readyState == 4 && this.status == 200) {

    console.log(this.responseText);

  // payDom.innerText = paymentForDomains;
  // actDom.innerText = activeDomains;
  // expDom.innerText = soonExpire;
  // serDom.innerText = serverAccounts;  
  // braDom.innerText = activeBrands;  
  // genDom.innerText = GeneralBlogs; 

  }};
  xhttp.send();  
}

  



function deleteDomainNowPlease(did){  
  var xhttp = new XMLHttpRequest();
  let url = "./functions/requests-domains.php";        
  let params = "case=delete_domains&&d_id=" + did;   
  document.getElementById("dr" + did).remove();  
  xhttp.open("POST", url, true);  
  xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');  
  xhttp.send(params);  
}


function updateDomain(did, dname, durl){   
  let drenew, dprotected;
  let dimp = document.getElementById("dimp").value;
  let dipa = document.getElementById("dipa").value;
  let dsup = document.getElementById("dsup").value;
  let dser = document.getElementById("dser").value;
  let dexp = document.getElementById("dexp").value; 
  

  document.getElementById("drenewChecker").checked ? drenew = "yes" : drenew = "no";
  document.getElementById("dprotectedChecker").checked ? dprotected = "yes" : dprotected = "no";

  
  var xhttp = new XMLHttpRequest();
  let url = "./functions/requests-domains.php";
  let params = "case=update_domains&&did=" + did + "&&dimp=" + dimp + "&&dipa=" + dipa + "&&dsup=" + dsup + "&&dser=" + dser + "&&dexp=" + dexp + "&&drenew=" + drenew + "&&dprotected=" + dprotected;
  xhttp.open("POST", url, true);  
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {       
      if(xhttp.responseText){      
      let theDomainRowUpdate = document.getElementById("dr" + JSON.parse(this.responseText)[0]);
      let theTds = [].slice.call(theDomainRowUpdate.querySelectorAll("td"));      
      theTds[1].innerText = JSON.parse(this.responseText)[5];
      theTds[2].addEventListener("click",()=>{
        setModalDetails(JSON.parse(this.responseText)[0], dname, durl, JSON.parse(this.responseText)[2], JSON.parse(this.responseText)[3], JSON.parse(this.responseText)[4], JSON.parse(this.responseText)[1], JSON.parse(this.responseText)[5], JSON.parse(this.responseText)[6], JSON.parse(this.responseText)[7]);
      });      
      }      
    }
  }  
  xhttp.send(params);   
}


getDomains();
updateDomainsTopBoxes();