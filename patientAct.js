function AddNewPatient(){
const form = document.querySelector("#Add-pat-card .field-form .main-container form"),
    messagedis = document.querySelector(".message-dis p"),
    messagecont = document.querySelector(".message-dis"),
    messagediserr=document.querySelector(".message-dis-err p"),
    messageconterr= document.querySelector(".message-dis-err"),
    loader = document.getElementById("loader");
  

form.onsubmit = (e)=>{
   e.preventDefault();
  //prevent form  submitting
} 
 

  loader.style.display = "initial";
 
//Ajax code
let xhr = new XMLHttpRequest();
//create Xml oject
xhr.open("POST", "AddNewPat.php", true);
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
    messagedis.innerHTML="Patient Added Successfully!";
    messagecont.style.display = "flex";
    messageconterr.style.display = "none";  
}

if(data == "failed"){
    messagediserr.innerHTML="Failed to add Patient Please Try Again";
    messageconterr.style.display = "flex";
    messagecont.style.display = "none";  
}

 changeTable();
 
    }
}
}
//send the form data throught ajax to php
let formData = new FormData(form); 
//new formData object

xhr.send(formData);
}


///display data to table
function changeTable(){
    const display = document.querySelector("#outer-table .table-container");
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET", "displayPatients.php", false);
     xmlhttp.send(null);
     display.innerHTML=xmlhttp.responseText;
}

function SearchPatient(){

    const searchBar = document.getElementById("searchPat"),
     displayCont = document.querySelector("#outer-table .table-container");
  
       
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
      xhr.open("POST", "SearchPatient.php", true);
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

  function clearfield(){
    const textField1 = document.getElementById("field1"),
    textField2 = document.getElementById("field2"),
    textField3 = document.getElementById("field3"),
    textField4 = document.getElementById("field4"),
    textField5 = document.getElementById("field5"),
    textField6 = document.getElementById("field6"),
    textField7 = document.getElementById("field7"),
    textField8 = document.getElementById("field8"),
    textField9 = document.getElementById("field9"),
    textField10 = document.getElementById("field10"),
    textField11 = document.getElementById("field11"),
    textField12 = document.getElementById("field12");

    textField1.value ="";
    textField2.value ="";
    textField3.value ="";
    textField4.value ="";
    textField5.value ="";
    textField6.value ="";
    textField7.value ="";
    textField8.value ="";
    textField9.value ="";
    textField10.value ="";
    textField11.value ="";
    textField12.value ="";
  }
  