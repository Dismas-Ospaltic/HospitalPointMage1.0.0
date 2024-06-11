function displayIncomingLab() {
    const display = document.querySelector("#inco-cont .incoming-sec .incoming-container");
    
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET", "displayIncomingLabTest.php", true); // Use true for asynchronous
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
            display.innerHTML = xmlhttp.responseText;
        }
    };
    xmlhttp.send();
}
    
 

function displayCompleteLabTest() {
    const display = document.querySelector("#comp-cont .complete-sec .complete-container");
    
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET", "displayCompleteLabTest.php", true); // Use true for asynchronous
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
            display.innerHTML = xmlhttp.responseText;
        }
    };
    xmlhttp.send();
}
  

 //display laborder card
  function displayLabDetCard(){
       
    const display = document.querySelector("#View-lab-card-inco .field-form .main-container"),
    urlParams = new URLSearchParams(window.location.search),
   paramValue = urlParams.get('HSPN'),
   paramValue1 = urlParams.get('V_ID');
 
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET", "displayLabOrderCard.php?HSPN=" + paramValue + "&V_ID=" + paramValue1, true);
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
            display.innerHTML=xmlhttp.responseText;
        }
    };
    xmlhttp.send(null);
   

 } 


  //display laborder card
  function displayLabDetCardForComlete(){
       
    const display = document.querySelector("#View-lab-card-comp .field-form .main-container"),
    urlParams = new URLSearchParams(window.location.search),
   paramValue = urlParams.get('HSPN'),
   paramValue1 = urlParams.get('V_ID');
 
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET", "displayCompLabOrderCard.php?HSPN=" + paramValue + "&V_ID=" + paramValue1, true);
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
            display.innerHTML = xmlhttp.responseText;
        }
    };
  
    xmlhttp.send(null);

 } 

  //display laborder card
  function displayFieltoaddLabDet(){
    const display = document.querySelector("#Add-pat-labtest-card .field-form .main-container"),
    urlParams = new URLSearchParams(window.location.search),
   paramValue = urlParams.get('HSPN'),
   paramValue1 = urlParams.get('V_ID');
 
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET", "displayFieldLabOrder.php?HSPN=" + paramValue + "&V_ID=" + paramValue1, true);
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
            display.innerHTML=xmlhttp.responseText;
        }
    };
    xmlhttp.send(null);
    

 }


 function AddLabTestResult(){    
    const form = document.querySelector("#Add-pat-labtest-card .field-form .main-container form"),
     messagedis = document.querySelector("#Add-pat-labtest-card .field-form .message-dis p"),
     messagecont = document.querySelector("#Add-pat-labtest-card .field-form .message-dis"),
     messagediserr=document.querySelector("#Add-pat-labtest-card .field-form .message-dis-err p"),
     messageconterr= document.querySelector("#Add-pat-labtest-card .field-form .message-dis-err"),
     loader = document.getElementById("loader"),
     urlParams = new URLSearchParams(window.location.search),
     paramValue = urlParams.get('HSPN'),
     paramValue1 = urlParams.get('V_ID');
 
 form.onsubmit = (e)=>{
    e.preventDefault();
   //prevent form  submitting
 } 
  
 
   loader.style.display = "initial";
  
 //Ajax code
 let xhr = new XMLHttpRequest();
 //create Xml oject
 xhr.open("POST", "AddLabTest.php?HSPN=" + encodeURIComponent(paramValue) + "&V_ID=" + encodeURIComponent(paramValue1), true);
 xhr.onload = ()=>{
 if(xhr.readyState === XMLHttpRequest.DONE){
     if(xhr.status === 200){
      
  loader.style.display = "none";
 
   let data = xhr.response;
   console.log(data);
 
    
 
 if(data == "failed"){
 messagediserr.innerHTML="Failed to add Lab Results Please try again!";
 messageconterr.style.display = "flex";
 messagecont.style.display = "none";  
 }

    if(data == "empty"){
        messagediserr.innerHTML="Please fill up the field with *";
        messageconterr.style.display = "flex";
        messagecont.style.display = "none";  
        }

        if(data == "success"){
            messagedis.innerHTML="Added Successfully!";
            messageconterr.style.display = "none";
            messagecont.style.display = "flex";  
            }
 
            if(data == "not set"){
                messagediserr.innerHTML="Technical Error occurred Please Close this window and reoppen it";
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

   //display laborder card
   function MarkTestAsComplete(){
    const urlParams = new URLSearchParams(window.location.search),
   paramValue = urlParams.get('HSPN'),
   paramValue1 = urlParams.get('V_ID');
 
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET", "MarkLabtestasComp.php?HSPN=" + paramValue + "&V_ID=" + paramValue1, true);
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
// console.log(xmlhttp.responseText);
data = xmlhttp.responseText;
if(data == "success"){
    alert("Successfully Marked as Complete!");
}
if(data == "failed"){
    alert("Failed to Mark as Complete! Please try again");
}

if(data == "empty data"){
    alert("Please Add test results first");
}

if(data == "not set"){
    alert("There was a technical Error! Please close this window and reopen it");
}

        }
    };
    xmlhttp.send(null);
     
    
 }


 function CancelOrderLab(){
    const urlParams = new URLSearchParams(window.location.search),
   paramValue = urlParams.get('HSPN'),
   paramValue1 = urlParams.get('V_ID');
 
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET", "MarkLabtestCancel.php?HSPN=" + paramValue + "&V_ID=" + paramValue1, true);
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
 // console.log(xmlhttp.responseText);
 data = xmlhttp.responseText;
 if(data == "success"){
     alert("Successfully Canceled!");
 }
 if(data == "failed"){
     alert("Failed to Mark as Complete! Please try again");
 }

 if(data == "not set"){
     alert("There was a technical Error! Please close this window and reopen it");
 }
        }
    };
    xmlhttp.send(null);
     
    
 }

 //display history
 function displayLabHist() {
    const display = document.querySelector("#outer-table .table-container-hist");
    
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET", "displayLabTestHist.php", true); // Use true for asynchronous
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
            display.innerHTML = xmlhttp.responseText;
        }
    };
    xmlhttp.send();
}


//display cards
function displayIncomingLabNum() {
    const display = document.querySelector("#top-overview .card-stats .cards .incoNum h1");
    
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET", "displayIncomingLabTestNum.php", true); // Use true for asynchronous
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
            display.innerHTML = xmlhttp.responseText;
        }
    };
    xmlhttp.send();
}

function displayCompleteLabNum() {
    const display = document.querySelector("#top-overview .card-stats .cards .completeNum h1");
    
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET", "displayCompleteLabTestNum.php", true); // Use true for asynchronous
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
            display.innerHTML = xmlhttp.responseText;
        }
    };
    xmlhttp.send();
}


function displayTodayPendingLabNum() {
    const display = document.querySelector("#top-overview .card-stats .cards .tdayPendingNum h1");
    
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET", "displaytodayPendingLabTestNum.php", true); // Use true for asynchronous
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
            display.innerHTML = xmlhttp.responseText;
        }
    };
    xmlhttp.send();
}

function displayPreviousPendingLabNum() {
    const display = document.querySelector("#top-overview .card-stats .cards .predayPendingNum h1");
    
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET", "displaypreviousPendingLabTestNum.php", true); // Use true for asynchronous
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
            display.innerHTML = xmlhttp.responseText;
        }
    };
    xmlhttp.send();
}


function SearchIncomingLabOrder(){

    const searchBar = document.getElementById("searchIncoLab"),
     displayCont = document.querySelector("#inco-cont .incoming-sec .incoming-container");
  
  searchBar.addEventListener("focus", () =>{
      searchBar.onkeyup = ()=>{
   
        clearInterval(intervalIncoPatLabOrder);
          let searchTerm = searchBar.value;
          if(searchTerm != ""){
              searchBar.classList.add("active");
          }else{ 
              searchBar.classList.remove("active");
          }
     
          //Ajax code
      let xhr = new XMLHttpRequest();//create Xml oject
      xhr.open("POST", "SearchIncoLabOrder.php", true);
      xhr.onload = ()=>{
      if(xhr.readyState === XMLHttpRequest.DONE){
          if(xhr.status === 200){
        let data = xhr.response;
        console.log(data);
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
  
  
  function SearchTodayCompleteLabOrder(){

    const searchBar = document.getElementById("searchTodayCompleteLab"),
     displayCont = document.querySelector("#comp-cont .complete-sec .complete-container");
  
  searchBar.addEventListener("focus", () =>{
      searchBar.onkeyup = ()=>{
   
        // clearInterval(intervalIncoPatLabOrder);
          let searchTerm = searchBar.value;
          if(searchTerm != ""){
              searchBar.classList.add("active");
          }else{ 
              searchBar.classList.remove("active");
          }
     
          //Ajax code
      let xhr = new XMLHttpRequest();//create Xml oject
      xhr.open("POST", "SearchTodayCompleteLabOrder.php", true);
      xhr.onload = ()=>{
      if(xhr.readyState === XMLHttpRequest.DONE){
          if(xhr.status === 200){
        let data = xhr.response;
        console.log(data);
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

  function SearchPrevCompleteLabOrder(){

    const searchBar = document.getElementById("searchPrevCompleteLab"),
     displayCont = document.querySelector("#outer-table .table-container-hist");
  
  searchBar.addEventListener("focus", () =>{
      searchBar.onkeyup = ()=>{
   
        // clearInterval(intervalIncoPatLabOrder);
          let searchTerm = searchBar.value;
          if(searchTerm != ""){
              searchBar.classList.add("active");
          }else{ 
              searchBar.classList.remove("active");
          }
     
          //Ajax code
      let xhr = new XMLHttpRequest();//create Xml oject
      xhr.open("POST", "SearchPrevCompleteLabOrder.php", true);
      xhr.onload = ()=>{
      if(xhr.readyState === XMLHttpRequest.DONE){
          if(xhr.status === 200){
        let data = xhr.response;
        console.log(data);
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