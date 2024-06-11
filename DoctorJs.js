
///display data to card
function changedoctPatientCardDetails(){
   
    const display = document.querySelector(".main-patient-card"),
    urlParams = new URLSearchParams(window.location.search),
   paramValue = urlParams.get('HSPN'),
   paramValue1 = urlParams.get('ODPIDP');
 
   var xmlhttp = new XMLHttpRequest();
   xmlhttp.open("GET", "displaydocPatientCard.php?HSPN=" + paramValue + "&ODPIDP=" + paramValue1, true);
   xmlhttp.onreadystatechange = function () {
    if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
      display.innerHTML=xmlhttp.responseText;
      data = xmlhttp.responseText;
   
      if(data == "No Data!" || data == "not Set"){
          window.location.href = "doctor.php";
      }
    }
};
    xmlhttp.send(null);

  
 }

 
 //display Visit card
 function displayVisitCard(){
       
    const display = document.querySelector(".patient-Visit-card"),
    urlParams = new URLSearchParams(window.location.search),
   paramValue = urlParams.get('HSPN'),
   paramValue1 = urlParams.get('ODPIDP');
 
   var xmlhttp = new XMLHttpRequest();
   xmlhttp.open("GET", "displayVisitCard.php?HSPN=" + paramValue + "&ODPIDP=" + paramValue1, true);
   xmlhttp.onreadystatechange = function () {
    if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
      display.innerHTML=xmlhttp.responseText;
      data = xmlhttp.responseText;
   
      if(data == "not Set"){
          window.location.href = "doctor.php";
      }
    }
};
    xmlhttp.send(null);

  
 } 


///add services
 function AddServiceBeforeInvoice(){
   const form = document.querySelector("#Add-pat-bill-card .field-form .main-container .table-cont form"),
    messagedis = document.querySelector("#Add-pat-bill-card .field-form .message-dis p"),
    messagecont = document.querySelector("#Add-pat-bill-card .field-form .message-dis"),
    messagediserr=document.querySelector("#Add-pat-bill-card .field-form .message-dis-err p"),
    messageconterr= document.querySelector("#Add-pat-bill-card .field-form .message-dis-err"),
    loader = document.getElementById("loader"),
    urlParams = new URLSearchParams(window.location.search),
    paramValue = urlParams.get('HSPN'),
    paramValue1 = urlParams.get('ODPIDP'),
    paramValue2 = urlParams.get('V_ID');

form.onsubmit = (e)=>{
   e.preventDefault();
  //prevent form  submitting
} 
 

  loader.style.display = "initial";
 
//Ajax code
let xhr = new XMLHttpRequest();
//create Xml oject
xhr.open("POST", "AddServiceBill.php?HSPN=" + encodeURIComponent(paramValue) + "&ODPIDP=" + encodeURIComponent(paramValue1) + "&V_ID=" + encodeURIComponent(paramValue2), true);
xhr.onload = ()=>{
if(xhr.readyState === XMLHttpRequest.DONE){
    if(xhr.status === 200){
     
 loader.style.display = "none";

  let data = xhr.response;
  console.log(data);



if(data == "already added"){
messagediserr.innerHTML="It Seems invoice has been added Check Billing & Payment page to add more!";
messageconterr.style.display = "flex";
messagecont.style.display = "none";  
}

if(data == "empty"){
messagediserr.innerHTML="Please fill all fields";
messageconterr.style.display = "flex";
messagecont.style.display = "none";  
}

if(data == "not set"){
    messagediserr.innerHTML="Cannot add at this time exit page Try Again";
    messageconterr.style.display = "flex";
    messagecont.style.display = "none";  
}

if(data == "success"){
    messagedis.innerHTML="Added Successfully! Check invoice Page to view";
    messagecont.style.display = "flex";
    messageconterr.style.display = "none";  
}

if(data == "failed"){
    messagediserr.innerHTML="Failed to add Please Try Again";
    messageconterr.style.display = "flex";
    messagecont.style.display = "none";  
}

if(data == "failed 1"){
    messagediserr.innerHTML="Technical error Output might be incorrect";
    messageconterr.style.display = "flex";
    messagecont.style.display = "none";  
}

 
    }
}
}
//send the form data throught ajax to php
let formData = new FormData(form); 
//new formData object

xhr.send(formData);
}



//display medical hist
function displayWindowAddMedical(){
     
    const display = document.querySelector("#Edit-pat-medHist-card .field-form .main-container"),
    urlParams = new URLSearchParams(window.location.search),
   paramValue = urlParams.get('HSPN'),
   paramValue1 = urlParams.get('ODPIDP');
 
   var xmlhttp = new XMLHttpRequest();
   xmlhttp.open("GET", "displayMedicalHistory.php?HSPN=" + paramValue + "&ODPIDP=" + paramValue1, true);
   xmlhttp.onreadystatechange = function () {
    if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
      display.innerHTML=xmlhttp.responseText;
    }
};
    xmlhttp.send(null);
  

 }



 ///edit med hist
 function EditMedicalHistory(){
    const form = document.querySelector("#Edit-pat-medHist-card .field-form .main-container form"),
     messagedis = document.querySelector("#Edit-pat-medHist-card .field-form .message-dis p"),
     messagecont = document.querySelector("#Edit-pat-medHist-card .field-form .message-dis"),
     messagediserr=document.querySelector("#Edit-pat-medHist-card .field-form .message-dis-err p"),
     messageconterr= document.querySelector("#Edit-pat-medHist-card .field-form .message-dis-err"),
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
 xhr.open("POST", "EditMedicalHist.php?HSPN=" + encodeURIComponent(paramValue) + "&ODPIDP=" + encodeURIComponent(paramValue1), true);
 xhr.onload = ()=>{
 if(xhr.readyState === XMLHttpRequest.DONE){
     if(xhr.status === 200){
      
  loader.style.display = "none";
 
   let data = xhr.response;
   console.log(data);
 
    
 
 if(data == "failed"){
 messagediserr.innerHTML="Failed to add Medical History Please try again!";
 messageconterr.style.display = "flex";
 messagecont.style.display = "none";  
 }

    if(data == "field empty"){
        messagediserr.innerHTML="Please fill up the field";
        messageconterr.style.display = "flex";
        messagecont.style.display = "none";  
        }

        if(data == "success"){
            messagedis.innerHTML="Added Successfully!";
            messageconterr.style.display = "none";
            messagecont.style.display = "flex";  
            }
 

  
     }
 }
 }
 //send the form data throught ajax to php
 let formData = new FormData(form); 
 //new formData object
 
 xhr.send(formData);
 }





//display more det on med hist
 function displaymoreDetMedHist(){
     
    const display = document.querySelector("#View-pat-medHist-card .field-form .main-container .main-par"),
    urlParams = new URLSearchParams(window.location.search),
   paramValue = urlParams.get('HSPN'),
   paramValue1 = urlParams.get('ODPIDP');
 
   var xmlhttp = new XMLHttpRequest();
   xmlhttp.open("GET", "displayMedicalHistoryDet.php?HSPN=" + paramValue + "&ODPIDP=" + paramValue1, true);
   xmlhttp.onreadystatechange = function () {
    if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
      display.innerHTML=xmlhttp.responseText;
    }
};
    xmlhttp.send(null);
   

 }



//displays window to add new medical history
 function displayWindowAddMedicalHistNew(){
     
    const display = document.querySelector("#Add-pat-medHist-card .field-form .main-container"),
    urlParams = new URLSearchParams(window.location.search),
   paramValue = urlParams.get('HSPN'),
   paramValue1 = urlParams.get('ODPIDP');
 
   var xmlhttp = new XMLHttpRequest();
   xmlhttp.open("GET", "DisplayFieldToaddMedHist.php?HSPN=" + paramValue + "&ODPIDP=" + paramValue1, true);
   xmlhttp.onreadystatechange = function () {
    if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
      display.innerHTML=xmlhttp.responseText;
    }
};
    xmlhttp.send(null);
   

 }


 ///add med hist
 function AddMedicalHistory(){
    const form = document.querySelector("#Add-pat-medHist-card .field-form .main-container form"),
     messagedis = document.querySelector("#Add-pat-medHist-card .field-form .message-dis p"),
     messagecont = document.querySelector("#Add-pat-medHist-card .field-form .message-dis"),
     messagediserr=document.querySelector("#Add-pat-medHist-card .field-form .message-dis-err p"),
     messageconterr= document.querySelector("#Add-pat-medHist-card .field-form .message-dis-err"),
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
 xhr.open("POST", "AddMedicalHist.php?HSPN=" + encodeURIComponent(paramValue) + "&ODPIDP=" + encodeURIComponent(paramValue1), true);
 xhr.onload = ()=>{
 if(xhr.readyState === XMLHttpRequest.DONE){
     if(xhr.status === 200){
      
  loader.style.display = "none";
 
   let data = xhr.response;
   console.log(data);
 
 
 
 if(data == "failed"){
 messagediserr.innerHTML="Failed to add Medical History Please try again!";
 messageconterr.style.display = "flex";
 messagecont.style.display = "none";  
 }

 if(data == "not empty"){
    messagediserr.innerHTML="Medical History already added Click edit button to update!";
    messageconterr.style.display = "flex";
    messagecont.style.display = "none";  
    }

    if(data == "field empty"){
        messagediserr.innerHTML="Please fill up the field";
        messageconterr.style.display = "flex";
        messagecont.style.display = "none";  
        }

        if(data == "success"){
            messagedis.innerHTML="Added Successfully!";
            messageconterr.style.display = "none";
            messagecont.style.display = "flex";  
            }
 
 
  
     }
 }
 }
 //send the form data throught ajax to php
 let formData = new FormData(form); 
 //new formData object
 
 xhr.send(formData);
 }


 //load btns

 function makebtnsReady(){
     
    const display = document.querySelector(".patient-btn-opps"),
    urlParams = new URLSearchParams(window.location.search),
    paramValue = urlParams.get('HSPN'),
    paramValue1 = urlParams.get('ODPIDP');
    
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET", "patientDocBtnsOp.php?HSPN=" + paramValue + "&ODPIDP=" + paramValue1, true);
    xmlhttp.onreadystatechange = function () {
      if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
        display.innerHTML=xmlhttp.responseText;
      }
  };
    xmlhttp.send(null);
  
    
    }
        

     ///add lab test order
 function orderLabTest(){
    const form = document.querySelector("#Order-pat-labtest-card .field-form .main-container form"),
     messagedis = document.querySelector("#Order-pat-labtest-card .field-form .message-dis p"),
     messagecont = document.querySelector("#Order-pat-labtest-card .field-form .message-dis"),
     messagediserr=document.querySelector("#Order-pat-labtest-card .field-form .message-dis-err p"),
     messageconterr= document.querySelector("#Order-pat-labtest-card .field-form .message-dis-err"),
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
 xhr.open("POST", "OrderLabTest.php?HSPN=" + encodeURIComponent(paramValue) + "&ODPIDP=" + encodeURIComponent(paramValue1), true);
 xhr.onload = ()=>{
 if(xhr.readyState === XMLHttpRequest.DONE){
     if(xhr.status === 200){
      
  loader.style.display = "none";
 
   let data = xhr.response;
   console.log(data);
 
 
 
 if(data == "failed"){
 messagediserr.innerHTML="Failed to send Loboratory Test Order Please try again!";
 messageconterr.style.display = "flex";
 messagecont.style.display = "none";  
 }

 if(data == "empty"){
    messagediserr.innerHTML="Please fill up the field! with *";
    messageconterr.style.display = "flex";
    messagecont.style.display = "none";  
    }

    if(data == "no visit id"){
        messagediserr.innerHTML="This patient Today's Visit not added";
        messageconterr.style.display = "flex";
        messagecont.style.display = "none";  
        }

        if(data == "success"){
            messagedis.innerHTML="Added Successfully! You'll Get results once tests are done";
            messageconterr.style.display = "none";
            messagecont.style.display = "flex";  
            }
            if(data == "no det found"){
                messagediserr.innerHTML="Patient details not Found!";
                messageconterr.style.display = "flex";
                messagecont.style.display = "none";  
                }
 
                if(data == "test already added"){
                    messagediserr.innerHTML="Lab test Already Sent!";
                    messageconterr.style.display = "flex";
                    messagecont.style.display = "none";  
                    }
            
                if(data == "not set"){
                    messagediserr.innerHTML="Technical Error Quit this window and open it again!";
                    messageconterr.style.display = "flex";
                    messagecont.style.display = "none";  
                    } 
  
     }
 }
 }
 //send the form data throught ajax to php
 let formData = new FormData(form); 
 //new formData object
 
 xhr.send(formData);
 }

 
 //display patient det to add
 function displaypatientDetinField(){
     
    const display = document.querySelector("#Edit-pat-det-card .field-form .main-container"),
    urlParams = new URLSearchParams(window.location.search),
   paramValue = urlParams.get('HSPN'),
   paramValue1 = urlParams.get('ODPIDP');
 
   var xmlhttp = new XMLHttpRequest();
   xmlhttp.open("GET", "displaypatientDetToadd.php?HSPN=" + paramValue + "&ODPIDP=" + paramValue1, true);
   xmlhttp.onreadystatechange = function () {
    if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
      display.innerHTML=xmlhttp.responseText;
    }
};
    xmlhttp.send(null);
   

 }


      ///add lab test order
      function UpdatePatientDetsDoc(){
        const form = document.querySelector("#Edit-pat-det-card .field-form .main-container form"),
         messagedis = document.querySelector("#Edit-pat-det-card .field-form .message-dis p"),
         messagecont = document.querySelector("#Edit-pat-det-card .field-form .message-dis"),
         messagediserr=document.querySelector("#Edit-pat-det-card .field-form .message-dis-err p"),
         messageconterr= document.querySelector("#Edit-pat-det-card .field-form .message-dis-err"),
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
     xhr.open("POST", "UpdatePatientDoc.php?HSPN=" + encodeURIComponent(paramValue) + "&ODPIDP=" + encodeURIComponent(paramValue1), true);
     xhr.onload = ()=>{
     if(xhr.readyState === XMLHttpRequest.DONE){
         if(xhr.status === 200){
          
      loader.style.display = "none";
     
       let data = xhr.response;
       console.log(data);
     
     
     
     if(data == "failed"){
     messagediserr.innerHTML="Failed to Update Please try again!";
     messageconterr.style.display = "flex";
     messagecont.style.display = "none";  
     }
    
     if(data == "empty"){
        messagediserr.innerHTML="Please fill up the field! with *";
        messageconterr.style.display = "flex";
        messagecont.style.display = "none";  
        }
    

    
            if(data == "success"){
                messagedis.innerHTML="Updated Successfully!";
                messageconterr.style.display = "none";
                messagecont.style.display = "flex";  
                }


                    if(data == "not set"){
                        messagediserr.innerHTML="Technical Error Quit this window and open it again!";
                        messageconterr.style.display = "flex";
                        messagecont.style.display = "none";  
                        } 
      
         }
     }
     }
     //send the form data throught ajax to php
     let formData = new FormData(form); 
     //new formData object
     
     xhr.send(formData);
     }


 //display patient det to add
 function displaypatientMedicalNoteinField(){
     
    const display = document.querySelector("#Add-pat-medNotes-card .field-form .main-container"),
    urlParams = new URLSearchParams(window.location.search),
   paramValue = urlParams.get('HSPN'),
   paramValue1 = urlParams.get('ODPIDP');
 
   var xmlhttp = new XMLHttpRequest();
   xmlhttp.open("GET", "displaypatientMedicalNotesToadd.php?HSPN=" + paramValue + "&ODPIDP=" + paramValue1, true);
   xmlhttp.onreadystatechange = function () {
    if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
      display.innerHTML=xmlhttp.responseText;
    }
};
    xmlhttp.send(null);


 }


    ///add medical notes
    function AddPatientMedicalNotesDoc(){
        const form = document.querySelector("#Add-pat-medNotes-card .field-form .main-container form"),
         messagedis = document.querySelector("#Add-pat-medNotes-card .field-form .message-dis p"),
         messagecont = document.querySelector("#Add-pat-medNotes-card .field-form .message-dis"),
         messagediserr=document.querySelector("#Add-pat-medNotes-card .field-form .message-dis-err p"),
         messageconterr= document.querySelector("#Add-pat-medNotes-card .field-form .message-dis-err"),
         loader = document.getElementById("loader"),
         urlParams = new URLSearchParams(window.location.search),
         paramValue = urlParams.get('HSPN'),
         paramValue1 = urlParams.get('ODPIDP'),
         paramValue2 = urlParams.get('V_ID');
     
     form.onsubmit = (e)=>{
        e.preventDefault();
       //prevent form  submitting
     } 
      
     
       loader.style.display = "initial";
      
     //Ajax code
     let xhr = new XMLHttpRequest();
     //create Xml oject
     xhr.open("POST", "AddPatientMedNotes.php?HSPN=" + encodeURIComponent(paramValue) + "&ODPIDP=" + encodeURIComponent(paramValue1) + "&V_ID=" + encodeURIComponent(paramValue2), true);
     xhr.onload = ()=>{
     if(xhr.readyState === XMLHttpRequest.DONE){
         if(xhr.status === 200){
          
      loader.style.display = "none";
     
       let data = xhr.response;
       console.log(data);
     
     
     
     if(data == "failed"){
     messagediserr.innerHTML="Failed to Update Please try again!";
     messageconterr.style.display = "flex";
     messagecont.style.display = "none";  
     }
    
     if(data == "empty"){
        messagediserr.innerHTML="Please fill up the field! with *";
        messageconterr.style.display = "flex";
        messagecont.style.display = "none";  
        }
    

    
            if(data == "success"){
                messagedis.innerHTML="Updated Successfully!";
                messageconterr.style.display = "none";
                messagecont.style.display = "flex";  
                }


                    if(data == "not set"){
                        messagediserr.innerHTML="Technical Error Quit this window and open it again!";
                        messageconterr.style.display = "flex";
                        messagecont.style.display = "none";  
                        } 
      
         }
     }
     }
     //send the form data throught ajax to php
     let formData = new FormData(form); 
     //new formData object
     
     xhr.send(formData);
     }
 
//discharge patient
 function dischargePatientToday(){
// display = document.querySelector(".visit-card"),

   const urlParams = new URLSearchParams(window.location.search),
   paramValue = urlParams.get('HSPN'),
   paramValue1 = urlParams.get('ODPIDP'),
   paramValue2 = urlParams.get('V_ID');

   var xmlhttp = new XMLHttpRequest();
   xmlhttp.open("GET", "dischargePatient.php?HSPN=" + paramValue + "&ODPIDP=" + paramValue1 + "&V_ID=" + paramValue2, false);
    xmlhttp.send(null);
    // display.innerHTML=xmlhttp.responseText;
    data = xmlhttp.responseText;
 
    if(data == "success"){
       alert("Patient has been Discharged!");
       changedoctPatientCardDetails();
       displayVisitCard();
       makebtnsReady();
       displaypatientVisitHistorytoFacility();
    }
      
    if(data == "failed"){
        alert("Failed Please Try Again!");
        changedoctPatientCardDetails();
        displayVisitCard();
        makebtnsReady();
        displaypatientVisitHistorytoFacility();
     }

     if(data == "doc notes lack"){
      alert("Doctor's notes Has not been added please add Then you can discharge the patient!");
      changedoctPatientCardDetails();
      displayVisitCard();
      makebtnsReady();
      displaypatientVisitHistorytoFacility();
   }


   if(data == "invoice lack"){
    alert("Invoice details has not been added! Please generate invoice before discharging the patient");
    changedoctPatientCardDetails();
    displayVisitCard();
    makebtnsReady();
    displaypatientVisitHistorytoFacility();
 }


 } 

 //discharge patient incomplete
 function dischargePatientInco(){

   const urlParams = new URLSearchParams(window.location.search),
   paramValue = urlParams.get('HSPN'),
   paramValue1 = urlParams.get('ODPIDP'),
   paramValue2 = urlParams.get('V_ID');

   var xmlhttp = new XMLHttpRequest();
   xmlhttp.open("GET", "dischargePatientInco.php?HSPN=" + paramValue + "&ODPIDP=" + paramValue1 + "&V_ID=" + paramValue2, false);
    xmlhttp.send(null);
    // display.innerHTML=xmlhttp.responseText;
    data = xmlhttp.responseText;
 
    if(data == "success"){
       alert("Patient has been Discharged!");
       changedoctPatientCardDetails();
       displayVisitCard();
       makebtnsReady();
       displaypatientVisitHistorytoFacility();
    }
      
    if(data == "failed"){
        alert("Failed Please Try Again!");
        changedoctPatientCardDetails();
        displayVisitCard();
        makebtnsReady();
        displaypatientVisitHistorytoFacility();
     }


 }


  //display patient visit hist
  function displaypatientVisitHistorytoFacility(){
        
    const display = document.querySelector("#outer-table .hist-patient"),
    urlParams = new URLSearchParams(window.location.search),
   paramValue = urlParams.get('HSPN'),
   paramValue1 = urlParams.get('ODPIDP');
 
   var xmlhttp = new XMLHttpRequest();
   xmlhttp.open("GET", "displaypatientVisitHistToFacility.php?HSPN=" + paramValue + "&ODPIDP=" + paramValue1, true);
   xmlhttp.onreadystatechange = function () {
    if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
      display.innerHTML=xmlhttp.responseText;
    }
};
    xmlhttp.send(null);


 }



  //display patient visit hist
  function displaypatientVisitHistorytoFacilityMoreDet(){
    const display = document.querySelector("#ViewMorHist-card .field-form .main-container"),
    urlParams = new URLSearchParams(window.location.search),
   paramValue = urlParams.get('HSPN'),
   paramValue1 = urlParams.get('V_ID');
 
   var xmlhttp = new XMLHttpRequest();
   xmlhttp.open("GET", "displaypatientVisitHistToFacilityMoredet.php?HSPN=" + paramValue + "&V_ID=" + paramValue1, true);
   xmlhttp.onreadystatechange = function () {
    if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
      display.innerHTML=xmlhttp.responseText;
    }
};
    xmlhttp.send(null);


 }

   //display patient visit discharge
   function displaypatientVisitDischarge(){
    const display = document.querySelector("#View-discharge-card .field-form .main-container"),
    urlParams = new URLSearchParams(window.location.search),
   paramValue = urlParams.get('HSPN'),
   paramValue1 = urlParams.get('V_ID');
 
   var xmlhttp = new XMLHttpRequest(); 
   xmlhttp.open("GET", "displaypatientVisitDischarge.php?HSPN=" + paramValue + "&V_ID=" + paramValue1, true);
   xmlhttp.onreadystatechange = function () {
    if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
      display.innerHTML=xmlhttp.responseText;
    }
};
    xmlhttp.send(null);


 }


    //display patient labtests
    function displaypatientVisitLabTestRes(){
      const display = document.querySelector("#View-lab-card .field-form .main-container #discharge"),
      urlParams = new URLSearchParams(window.location.search),
     paramValue = urlParams.get('HSPN'),
     paramValue1 = urlParams.get('V_ID');
   
     var xmlhttp = new XMLHttpRequest();
     xmlhttp.open("GET", "displaypatientVisitLabTest.php?HSPN=" + paramValue + "&V_ID=" + paramValue1, true);
     xmlhttp.onreadystatechange = function () {
      if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
        display.innerHTML=xmlhttp.responseText;
      }
  };
      xmlhttp.send(null);
  
  
   }
   
   
    
   function SearchPatientVisitHistory(){

      const searchBar = document.getElementById("searchPatVisitHist"),
       displayCont = document.querySelector("#outer-table .hist-patient"),
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
        xhr.open("POST", "searchPatientVisitToFacility.php?HSPN=" + encodeURIComponent(paramValue) + "&ODPIDP=" + encodeURIComponent(paramValue1), true);
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

     // add appointment

     function AddApointMent(){
      const form = document.querySelector("#Add-pat-appointment-card .field-form .main-container form"),
       messagedis = document.querySelector("#Add-pat-appointment-card .field-form .message-dis p"),
       messagecont = document.querySelector("#Add-pat-appointment-card .field-form .message-dis"),
       messagediserr=document.querySelector("#Add-pat-appointment-card .field-form .message-dis-err p"),
       messageconterr= document.querySelector("#Add-pat-appointment-card .field-form .message-dis-err"),
       loader = document.getElementById("loader"),
       urlParams = new URLSearchParams(window.location.search),
       paramValue = urlParams.get('HSPN');
   
   form.onsubmit = (e)=>{
      e.preventDefault();
     //prevent form  submitting
   } 
    
   
     loader.style.display = "initial";
       
   //Ajax code
   let xhr = new XMLHttpRequest();
   //create Xml oject
   xhr.open("POST", "AddApointment.php?HSPN=" + encodeURIComponent(paramValue), true);
   xhr.onload = ()=>{
   if(xhr.readyState === XMLHttpRequest.DONE){
       if(xhr.status === 200){
        
    loader.style.display = "none";
   
     let data = xhr.response;
     console.log(data);
   
   
   
   if(data == "failed"){
   messagediserr.innerHTML="Failed to add Appointment Please try again!";
   messageconterr.style.display = "flex";
   messagecont.style.display = "none";  
   }
  
   if(data == "empty"){
      messagediserr.innerHTML="Please fill up the field! with *";
      messageconterr.style.display = "flex";
      messagecont.style.display = "none";  
      }
  
  
          if(data == "success"){
              messagedis.innerHTML="Added Successfully!";
              messageconterr.style.display = "none";
              messagecont.style.display = "flex";  
              }
              if(data == "no data"){
                  messagediserr.innerHTML="Patient details not Found!";
                  messageconterr.style.display = "flex";
                  messagecont.style.display = "none";  
                  } 
                  if(data == "exist"){
                  messagediserr.innerHTML="Appointment For this Date Exists!";
                  messageconterr.style.display = "flex";
                  messagecont.style.display = "none";  
                  }
              
                  if(data == "not set"){
                      messagediserr.innerHTML="Technical Error Quit this window and open it again!";
                      messageconterr.style.display = "flex";
                      messagecont.style.display = "none";  
                      } 
    
       }
   }
   }
   //send the form data throught ajax to php
   let formData = new FormData(form); 
   //new formData object
   
   xhr.send(formData);
   }
   