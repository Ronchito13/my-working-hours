let keyEmail = localStorage.getItem("credentials-e");
let keyPass = localStorage.getItem("credentials-p");
let uemail = document.getElementById("inputEmail");
let errMsg = document.getElementById("errMsg");
let upass = document.getElementById("inputPassword");
const validEmail = /(?!.*\.{2})^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;   

if(keyEmail){
    uemail.value = keyEmail;
}

if(keyPass){
    upass.value = keyPass;
}

function checkFormLoginValidation(){    
    
    let customCheck = document.getElementById("customCheck").checked;
    let theEmail = uemail.value;
    let thePass = upass.value;

    if(customCheck == true){
        localStorage.setItem("credentials-e", theEmail); 
        localStorage.setItem("credentials-p", thePass);
    }
        
    uemail.addEventListener("click", ()=>{
        uemail.style.border = "";
        upass.style.border = "";        
        errMsg.innerText = "";
        errMsgOfLogin.innerText = "";
        errMsg.style.width = "0px";
    });

    
    upass.addEventListener("click", ()=>{
        upass.style.border = "";
        uemail.style.border = "";
        errMsg.innerText = "";
        errMsgOfLogin.innerText = "";
        errMsg.style.width = "0px";
    })
    
    
    
    if(uemail.value == ""){        
        uemail.style.border = "1px solid lightcoral";
        errMsg.style.width = "200px";
        setTimeout(()=>{
        errMsg.innerText = "";
        errMsg.style.width = "0px";
        },5000);
        setTimeout(()=>{
            errMsg.innerText = "Must enter email";
        },250);
        
        return false;
    }   

    if(validEmail.test(String(uemail.value).toLowerCase()) == false){
        uemail.style.border = "1px solid lightcoral";
        errMsg.style.width = "200px";
        setTimeout(()=>{
        errMsg.innerText = "";
        errMsg.style.width = "0px";
        },5000);
        setTimeout(()=>{
            errMsg.innerText = "Must enter valid email";
        },250);
        
        return false;
    }

    if(upass.value == ""){
        upass.style.border = "1px solid lightcoral";
        errMsg.style.width = "200px";
        setTimeout(()=>{
        errMsg.innerText = "";
        errMsg.style.width = "0px";
        },5000);        
        setTimeout(()=>{
            errMsg.innerText = "Must enter password";
        },250);
        return false;
    }  
      
    return true;

}



function checkFormResetValidation(){
    
       
    if(uemail.value == ""){        
        uemail.style.border = "1px solid lightcoral";
        errMsg.style.width = "200px";
        setTimeout(()=>{
        errMsg.innerText = "";
        errMsg.style.width = "0px";
        },5000);
        setTimeout(()=>{
            errMsg.innerText = "Must enter email";
        },250);
        
        return false;
    }   

    if(validEmail.test(String(uemail.value).toLowerCase()) == false){
        uemail.style.border = "1px solid lightcoral";
        errMsg.style.width = "200px";
        setTimeout(()=>{
        errMsg.innerText = "";
        errMsg.style.width = "0px";
        },5000);
        setTimeout(()=>{
            errMsg.innerText = "Must enter valid email";
        },250);
        
        return false;
    }
    
         
    return true;
}