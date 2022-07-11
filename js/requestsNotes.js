let notesZone = document.getElementById("notesZone");
let writeNote = document.getElementById("writeNote");

writeNote.addEventListener("click",()=>{    
    cleanNoteInputs();
})
// Get Notes

function getNotes(u_user){    
    var xhttp = new XMLHttpRequest();
    let theCompanyName = document.getElementById("theCompanyName").innerText;  
    let url = "./functions/requests-notes.php?getInfo=get_notes&uid=" + u_user + "&company_name=" + theCompanyName;      
    xhttp.open("GET", url, true);
    xhttp.onreadystatechange = function() {      
    if (this.readyState == 4 && this.status == 200) {
        notesZone.innerHTML = '';
        let rounds = JSON.parse(this.responseText).length;        
      for(k = 0; k < rounds; k++){      
        let nid = JSON.parse(this.responseText)[k][0];      
        let nicon = JSON.parse(this.responseText)[k][1];
        let ndesc = JSON.parse(this.responseText)[k][2];        
        let nuploaduser = JSON.parse(this.responseText)[k][3];
        let cname = JSON.parse(this.responseText)[k][4];        
        let ndate = JSON.parse(this.responseText)[k][5];
        createNote(nid, nicon, ndesc, u_user, ndate, cname);        
      }      
    
    }}; 
    
    xhttp.send();
  }
  
  function createNote(nid, nicon, ndesc, nuploaduser){
    let icon;    

    let noteDiv = document.createElement("div");
    noteDiv.className = "row notes";
    noteDiv.id = nid;

    let noteIcon = document.createElement("div");
    noteIcon.className = "col-xl-1 col-md-1 text-center medium";

    if(nicon == "n1"){
        icon = "fas fa-exclamation-triangle";
        noteIcon.style.color = "red";
    } else if (nicon == "n2"){
        icon = "fas fa-exclamation-circle";
        noteIcon.style.color = "black";
    } else if (nicon == "n3"){
        icon = "fas fa-exclamation";
        noteIcon.style.color = "cornflowerblue";
    } else if (nicon == "n4"){
        icon = "fas fa-sticky-note";
        noteIcon.style.color = "deepskyblue";
    } else if (nicon == "n5"){
        icon = "fas fa-star";
        noteIcon.style.color = "yellowgreen";
    }

    let theIcon = document.createElement("i");
    theIcon.className = icon;

    noteIcon.append(theIcon);

    let noteText = document.createElement("div");
    noteText.className = "col-xl-10 col-md-10 medium";
    let theText = document.createElement("p");
    theText.innerText = ndesc;

    noteText.append(theText);

    let iconRead = document.createElement("div");
    iconRead.className = "col-xl-1 col-md-1 large pointer";
    let theIconRead = document.createElement("i");
    theIconRead.className = "fas fa-check-circle";
    iconRead.addEventListener("click",()=>{
        iconRead.style.color = "lightgreen";
        markAsWatchedAndDelete(nid, nuploaduser);        
    })

    iconRead.append(theIconRead);    

    noteDiv.append(noteIcon);
    noteDiv.append(noteText);
    noteDiv.append(iconRead);

    notesZone.append(noteDiv);

  }

  function cleanNoteInputs(){
    let nicon = document.getElementById("nicon").value;
    let ndesc = document.getElementById("ndesc").value;
    nicon = "";
    ndesc = "";
  }



  function insertNote(u_user){   
    var xhttp = new XMLHttpRequest();
    let url = "./functions/requests-notes.php";
    let nicon = document.getElementById("nicon").value;
    let ndesc = document.getElementById("ndesc").value;
    let theCompanyName = document.getElementById("theCompanyName").innerText;  

    let params = "case=insert_notes&&ndesc=" + ndesc + "&nicon=" + nicon + "&nuser=" + u_user + "&company_name=" + theCompanyName;
    xhttp.open("POST", url, true);

    //Send the proper header information along with the request
    xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {       
      let nid = JSON.parse(this.responseText)[0];      
      let nicon = JSON.parse(this.responseText)[1];
      let ndesc = JSON.parse(this.responseText)[2];      
      let n_user_id = JSON.parse(this.responseText)[3];
      let ndate = JSON.parse(this.responseText)[4];      
      let cname = JSON.parse(this.responseText)[5];      
      createNote(nid, nicon, ndesc, n_user_id, ndate, cname);
    }
    };

    xhttp.send(params);
}

  
  


function markAsWatchedAndDelete(nid, nuser, allUser){  
  var xhttp = new XMLHttpRequest();
  let url = "./functions/requests-notes.php";        
  let params = "case=delete_notes&&n_id=" + nid + "&n_user=" + nuser + "&n_all_users=" + allUser;  
  setTimeout(()=>{
    fadeOutEffect(nid);
  },500); 
  setTimeout(()=>{
    document.getElementById(nid).remove();
  },1000); 
  xhttp.open("POST", url, true);  
  xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');  
  xhttp.send(params);  
}

function fadeOutEffect(nid) {
    var fadeTarget = document.getElementById(nid);
    var fadeEffect = setInterval(function () {
        if (!fadeTarget.style.opacity) {
            fadeTarget.style.opacity = 1;
        }
        if (fadeTarget.style.opacity > 0) {
            fadeTarget.style.opacity -= 0.1;
        } else {
            clearInterval(fadeEffect);
        }
    }, 10);
}