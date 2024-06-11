///display data to table
function changePatientDetails(){
   
    const display = document.querySelector(".main-patient-card"),
    urlParams = new URLSearchParams(window.location.search),
   paramValue = urlParams.get('HSPN'),
   paramValue1 = urlParams.get('ODPIDP');
 
   var xmlhttp = new XMLHttpRequest();
   xmlhttp.open("GET", "displayPatientCard.php?HSPN=" + paramValue + "&ODPIDP=" + paramValue1, false);
    xmlhttp.send(null);
    display.innerHTML=xmlhttp.responseText;
    data = xmlhttp.responseText;
 
    if(data == "No Data!" || data == "not Set"){
        window.location.href = "patient.php";
    }
  
 }
   
function changePatientDetailsbtns(){
     
const display = document.querySelector(".patient-btn-opps"),
urlParams = new URLSearchParams(window.location.search),
paramValue = urlParams.get('HSPN'),
paramValue1 = urlParams.get('ODPIDP');

var xmlhttp = new XMLHttpRequest();
xmlhttp.open("GET", "displayPatientCardopbtn.php?HSPN=" + paramValue + "&ODPIDP=" + paramValue1, false);
xmlhttp.send(null);
display.innerHTML=xmlhttp.responseText;

}
 
function changePatientDetailsupdatebtns(){
    
    const display = document.querySelector("#Edit-pat-card .field-form .main-container"),
    urlParams = new URLSearchParams(window.location.search),
    paramValue = urlParams.get('HSPN'),
    paramValue1 = urlParams.get('ODPIDP');
    
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET", "displayPatienttoUpdate.php?HSPN=" + paramValue + "&ODPIDP=" + paramValue1, false);
    xmlhttp.send(null);
    display.innerHTML=xmlhttp.responseText;
    
    }

    //////update patients

    function UpdatePatient(){
        //sendBtn = form.querySelector("#Add-pat-card .field-form .main-container form .btn-wrapper button"),// sendBtn.onclick = ()=>{
    const form = document.querySelector("#Edit-pat-card .field-form .main-container form"),
        messagedis = document.querySelector(".message-dis p"),
        messagecont = document.querySelector(".message-dis"),
        messagediserr=document.querySelector(".message-dis-err p"),
        messageconterr= document.querySelector(".message-dis-err"),
        loader = document.getElementById("loader"),
        urlParams = new URLSearchParams(window.location.search),
        paramValue = urlParams.get('HSPN'),
        paramValue1 = urlParams.get('ODPIDP');
    
    
    form.onsubmit = (e)=>{
       e.preventDefault();
      //prevent form  submitting
    } 
    
    
     
      loader.style.display = "initial";
     
    //Ajax code
    let xhr = new XMLHttpRequest();
    //create Xml oject
    xhr.open("POST", "UpdatePatient.php?HSPN=" + encodeURIComponent(paramValue) + "&ODPIDP=" + encodeURIComponent(paramValue1), true);
    xhr.onload = ()=>{
    if(xhr.readyState === XMLHttpRequest.DONE){
        if(xhr.status === 200){
         
     loader.style.display = "none";
    
      let data = xhr.response;
      console.log(data);
    
    
    
    if(data == "empty"){
    messagediserr.innerHTML="Please fill the field with *";
    messageconterr.style.display = "flex";
    messagecont.style.display = "none";  
    }
    
    if(data == "Odp Exist"){
        messagediserr.innerHTML="ODP or IDP No. Exists Please enter Another Number.";
        messageconterr.style.display = "flex";
        messagecont.style.display = "none";  
    }
    
    if(data == "success"){
        messagedis.innerHTML="Patient Updated Successfully!";
        messagecont.style.display = "flex";
        messageconterr.style.display = "none";  
    }
    
    if(data == "failed"){
        messagediserr.innerHTML="Failed to add Patient Please Try Again";
        messageconterr.style.display = "flex";
        messagecont.style.display = "none";  
    }
    
    // 
    changePatientDetails();
    changePatientDetailsupdatebtns();
        }
    }
    }
    //send the form data throught ajax to php
    let formData = new FormData(form); 
    //new formData object
    
    xhr.send(formData);
    }


 //add new visit

function AddNewPatientVisit(){
    const form = document.querySelector("#Add-pat-visit-card .field-form .main-container form"),
    messagedis = document.querySelector("#Add-pat-visit-card .field-form .message-dis p"),
    messagecont = document.querySelector("#Add-pat-visit-card .field-form .message-dis"),
    messagediserr=document.querySelector("#Add-pat-visit-card .field-form .message-dis-err p"),
    messageconterr= document.querySelector("#Add-pat-visit-card .field-form .message-dis-err"),
    loader = document.getElementById("loader"),
    urlParams = new URLSearchParams(window.location.search),
    paramValue = urlParams.get('HSPN'),
    paramValue1 = urlParams.get('ODPIDP');


form.onsubmit = (e)=>{
   e.preventDefault();
  //prevent form  submitting
} 



  loader.style.display = "initial";
 
//Ajax code
let xhr = new XMLHttpRequest();
//create Xml oject
xhr.open("POST", "AddSubVisit.php?HSPN=" + encodeURIComponent(paramValue) + "&ODPIDP=" + encodeURIComponent(paramValue1), true);
xhr.onload = ()=>{
if(xhr.readyState === XMLHttpRequest.DONE){
    if(xhr.status === 200){
     
 loader.style.display = "none";

  let data = xhr.response;
  console.log(data);



if(data == "empty"){
messagediserr.innerHTML="Please fill the field with *";
messageconterr.style.display = "flex";
messagecont.style.display = "none";  
}

if(data == "visit exist"){
    messagediserr.innerHTML="Today's Visit Already Added!.";
    messageconterr.style.display = "flex";
    messagecont.style.display = "none";  
}

if(data == "success"){
    messagedis.innerHTML="Patient Visit Added Successfully!";
    messagecont.style.display = "flex";
    messageconterr.style.display = "none";  
}

if(data == "failed"){
    messagediserr.innerHTML="Failed to add Patient Visit Please Try Again";
    messageconterr.style.display = "flex";
    messagecont.style.display = "none";  
}

if(data == "not set" || data == "not valid"){ 
    window.location.href="patient.php";
}

changePatientHISTDetails();
    }
}
}
//send the form data throught ajax to php
let formData = new FormData(form); 
//new formData object

xhr.send(formData);
}


///display data to table
function changePatientHISTDetails(){
   
const display = document.querySelector("#outer-table .table-container"),
urlParams = new URLSearchParams(window.location.search),
paramValue = urlParams.get('HSPN'),
paramValue1 = urlParams.get('ODPIDP');
 
   var xmlhttp = new XMLHttpRequest();
   xmlhttp.open("GET", "displayVisitHist.php?HSPN=" + paramValue + "&ODPIDP=" + paramValue1, false);
    xmlhttp.send(null);
    display.innerHTML=xmlhttp.responseText;
    data = xmlhttp.responseText;
 
    if(data == "No Data!" || data == "not Set"){
        window.location.href = "patient.php";
    }
  
 } 
   
 function SearchPatientVisitHist(){

    const searchBar = document.getElementById("searchPatVisitHist"),
     displayCont = document.querySelector("#outer-table .table-container"),
     urlParams = new URLSearchParams(window.location.search),
     paramValue = urlParams.get('HSPN'),
     paramValue1 = urlParams.get('ODPIDP');
    
       
    searchBar.addEventListener("focus", () =>{
      searchBar.onkeyup = ()=>{
    
    
          let searchTerm = searchBar.value;
          if(searchTerm != ""){
              searchBar.classList.add("active");
          }else{ 
              searchBar.classList.remove("active");
          }
     
          //Ajax code
      let xhr = new XMLHttpRequest();//create Xml oject
      xhr.open("POST", "searchPatientVisit.php?HSPN=" + encodeURIComponent(paramValue) + "&ODPIDP=" + encodeURIComponent(paramValue1), true);
      xhr.onload = ()=>{
      if(xhr.readyState === XMLHttpRequest.DONE){
          if(xhr.status === 200){
        let data = xhr.response;
          // proList.innerHTML = data;
             displayCont.innerHTML = data;
          }
      }
      }
      xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xhr.send("searchTerm=" + searchTerm);
      }
      });
    }