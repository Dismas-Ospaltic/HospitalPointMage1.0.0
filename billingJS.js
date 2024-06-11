function ChangeInvoice(){
   
    const display = document.querySelector("#over-view-note"),
    urlParams = new URLSearchParams(window.location.search),
   paramValue = urlParams.get('HSPN'),
   paramValue1 = urlParams.get('ODPIDP');
 
   var xmlhttp = new XMLHttpRequest();
   xmlhttp.open("GET", "displayInvoice.php?HSPN=" + paramValue + "&ODPIDP=" + paramValue1, false);
    xmlhttp.send(null);
    display.innerHTML=xmlhttp.responseText;
    data = xmlhttp.responseText;
 
    if(data == "No Data!" || data == "not Set"){
        window.location.href = "doctor.php";
    }
    
 } 
  

 function SearchPatientVisitInvoice(){

    const searchBar = document.getElementById("searchPatVisitInvoice"),
     displayCont = document.querySelector(".search-auto-list .list-container"),
    maincont = document.querySelector(".search-auto-list");
       
  searchBar.addEventListener("focus", () =>{
      searchBar.onkeyup = ()=>{
        maincont.style.display="initial";
   
          let searchTerm = searchBar.value;
          if(searchTerm != ""){
              searchBar.classList.add("active");
          }else{ 
              searchBar.classList.remove("active");
          }
    
          //Ajax code
      let xhr = new XMLHttpRequest();//create Xml oject
      xhr.open("POST", "searchPatientVisitInvoice.php", true);
      xhr.onload = ()=>{
      if(xhr.readyState === XMLHttpRequest.DONE){
          if(xhr.status === 200){
        let data = xhr.response;
        // console.log(data);
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

function removeAutoList(){
    const maincont = document.querySelector(".search-auto-list");
    maincont.style.display = "none";
}


///add services
function AddServiceBillingInvoice(){
  
   const form = document.querySelector(".add-more-invo-service form"),
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
// xhr.open("POST", "AddServiceBill.php", true);
xhr.open("POST", "AddbillingMore.php?HSPN=" + encodeURIComponent(paramValue) + "&ODPIDP=" + encodeURIComponent(paramValue1), true);
xhr.onload = ()=>{
if(xhr.readyState === XMLHttpRequest.DONE){
    if(xhr.status === 200){
     
 loader.style.display = "none";

  let data = xhr.response;
  console.log(data);

 
  
  if(data == "success"){
    alert("Invoice Added Successfully");
   }

  if(data == "failed 1"){
    alert("Failed to add invoice System mulfunction Please Contact Developer For Help");
   }

  if(data == "failed"){
    alert("Failed to add invoice Please try Again");
   }

if(data == "no visit id"){
 alert("Patient Visit not Added Make sure Patient Has Visited Facility");
}

if(data == "empty"){
  alert("Please fill all the fields");
}

if(data == "not set"){
alert("Sorry Can Not Find Patient details");
}


ChangeInvoice();
 
    }
}
}
//send the form data throught ajax to php
let formData = new FormData(form); 
//new formData object

xhr.send(formData);
}

 

function ChangeInvoiceMoreDet(){
   
  const display = document.querySelector("#invoice"),
  urlParams = new URLSearchParams(window.location.search),
  paramValue = urlParams.get('HSPN'),
  paramValue1 = urlParams.get('V_ID');
  
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.open("GET", "InvoiceInnerContent.php?HSPN=" + paramValue + "&V_ID=" + paramValue1, true);
  xmlhttp.onreadystatechange = function () {
       if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
        display.innerHTML=xmlhttp.responseText;
       data = xmlhttp.responseText;
       }
   };
  xmlhttp.send(null);
 
  
  } 


function ChangeInvoiceToEdit(){
   
  const display = document.querySelector("#Edit-pat-invo-card .field-form .main-container"),
  urlParams = new URLSearchParams(window.location.search),
  paramValue = urlParams.get('product_name'),
  paramValue1 = urlParams.get('V_ID'),
  paramValue2 = urlParams.get('INVO_NUM');

  var xmlhttp = new XMLHttpRequest();
  xmlhttp.open("GET", "displayInvoiceToUpdate.php?product_name=" + paramValue + "&V_ID=" + paramValue1 + "&INVO_NUM=" + paramValue2, false);
  xmlhttp.send(null);
  display.innerHTML=xmlhttp.responseText;
  data = xmlhttp.responseText;
  
  
  } 

 


  ///edit services
function EditServiceBillingInvoice(){
     
  const form = document.querySelector("#Edit-pat-invo-card .field-form .main-container form"),
   loader = document.getElementById("loader"),
   messagedis = document.querySelector("#Edit-pat-invo-card .field-form .message-dis p"),
   messagecont = document.querySelector("#Edit-pat-invo-card .field-form .message-dis"),
   messagediserr=document.querySelector("#Edit-pat-invo-card .field-form .message-dis-err p"),
   messageconterr= document.querySelector("#Edit-pat-invo-card .field-form .message-dis-err"),
   urlParams = new URLSearchParams(window.location.search),
   paramValue = urlParams.get('product_name'),
  paramValue1 = urlParams.get('V_ID'),
  paramValue2 = urlParams.get('INVO_NUM'),
  paramValue3 = urlParams.get('num_det');

form.onsubmit = (e)=>{
  e.preventDefault();
 //prevent form  submitting
} 


 loader.style.display = "initial";

//Ajax code
let xhr = new XMLHttpRequest();
//create Xml oject
xhr.open("POST", "BillingbillingMore.php?product_name=" + encodeURIComponent(paramValue) + "&V_ID=" + encodeURIComponent(paramValue1) + "&INVO_NUM=" + encodeURIComponent(paramValue2) + "&num_det=" + encodeURIComponent(paramValue3), true);
xhr.onload = ()=>{
if(xhr.readyState === XMLHttpRequest.DONE){
   if(xhr.status === 200){
    
loader.style.display = "none";

 let data = xhr.response;
 console.log(data);


  if(data == "success"){
    messagedis.innerHTML="Invoice updated Successfully!";
    messagecont.style.display = "flex";
    messageconterr.style.display = "none";  
}

if(data == "failed"){
    messagediserr.innerHTML="Failed to update, Please cancel this window and Try Again";
    messageconterr.style.display = "flex";
    messagecont.style.display = "none";  
}

if(data == "empty"){
  messagediserr.innerHTML="Please Fill All The fields";
  messageconterr.style.display = "flex";
  messagecont.style.display = "none";  
}

if(data == "not set"){
  messagediserr.innerHTML="System error occurred Close this dialog window and try again!";
  messageconterr.style.display = "flex";
  messagecont.style.display = "none";  
}

ChangeInvoice();

   }  
}
}
//send the form data throught ajax to php
let formData = new FormData(form); 
//new formData object

xhr.send(formData);
}
 
function DeleteListInvoice(){
  // display = document.querySelector("#Edit-pat-invo-card .field-form .main-container"),
  const urlParams = new URLSearchParams(window.location.search),
  paramValue = urlParams.get('product_name'),
  paramValue1 = urlParams.get('V_ID'),
  paramValue2 = urlParams.get('INVO_NUM'),
  paramValue3 = urlParams.get('num_det');


  var xmlhttp = new XMLHttpRequest();
  xmlhttp.open("GET", "DeletListInvoice.php?product_name=" + paramValue + "&V_ID=" + paramValue1 + "&INVO_NUM=" + paramValue2 + "&num_det=" + encodeURIComponent(paramValue3), false);
  xmlhttp.send(null);
  // display.innerHTML=xmlhttp.responseText;
  data = xmlhttp.responseText;
  
  if(data == "success"){
    alert("Deleted Successfully");
  }


  if(data == "failed"){
    alert(" failed to Delete!");
  }

  if(data == "not set"){
    alert("Can't Delete at this time");
  }
  
  } 

            ///display data to table
            function changeVisitAllPatientInvoice(){
              const display = document.querySelector("#visit-cont #outer-table .table-container");
            
             var xmlhttp = new XMLHttpRequest();
             xmlhttp.open("GET", "displayAllVisitInvoice.php", false);
              xmlhttp.send(null);
              display.innerHTML=xmlhttp.responseText;
            }
           
           
            function SearchPatientSingleVisitInvoice(){
           
           const searchBar = document.getElementById("searchSingleVisitInvoice"),
            displayCont = document.querySelector("#visit-cont #outer-table .table-container");
           
              
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
             xhr.open("POST", "SearchPatientSingleAllInvoice.php", true);
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
  
 