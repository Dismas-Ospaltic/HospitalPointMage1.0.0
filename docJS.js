     ///display data to table
function changeTableIncominPatients(){
    const display = document.querySelector("#outer-table .inco-patient");
    var xmlhttp = new XMLHttpRequest();

    xmlhttp.open("GET", "displayIncomingPatient.php", true);
    xmlhttp.onreadystatechange = function () {
      if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
        display.innerHTML=xmlhttp.responseText;
      }
  };
     xmlhttp.send(null);
     
      
} 
 
     ///display data to table icoming lab test
     function changeTableIncominLabTest(){
        const display = document.querySelector("#outer-table .inco-Lab");
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.open("GET", "docdisplayIncomingLab.php", true);
        xmlhttp.onreadystatechange = function () {
          if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
            display.innerHTML=xmlhttp.responseText;
          }
      };
         xmlhttp.send(null);
         
          
    } 
 
         ///display data to table icoming lab test
         function changeTableupcomingAppoint(){
            const display = document.querySelector("#appointment-recent .appointment-sec .appointment-container");
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.open("GET", "docdisplayupcoApointment.php", true);
            xmlhttp.onreadystatechange = function () {
              if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
                display.innerHTML=xmlhttp.responseText;
              }
          };
             xmlhttp.send(null);
             
              
        } 

          ///display data to table icoming lab test
     function changeTableRecentPatient(){
        const display = document.querySelector("#appointment-recent .recent-container");
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.open("GET", "docdisplayrecentPatient.php", true);
        xmlhttp.onreadystatechange = function () {
          if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
            display.innerHTML=xmlhttp.responseText;
          }
      };
         xmlhttp.send(null);
        
          
    }
    

    function SearchIncomingPatient(){

     const searchBar = document.getElementById("incomingPatientList"),
      displayCont = document.querySelector("#outer-table .inco-patient");
     
        
     searchBar.addEventListener("focus", () =>{
       searchBar.onkeyup = ()=>{
        clearInterval(intervalIncoPat);
     
           let searchTerm = searchBar.value;
           if(searchTerm != ""){
               searchBar.classList.add("active");
           }else{ 
               searchBar.classList.remove("active");
           }
       
           //Ajax code
       let xhr = new XMLHttpRequest();//create Xml oject
       xhr.open("POST", "SearchIncomindocPatient.php", true);
       xhr.onload = ()=>{
       if(xhr.readyState === XMLHttpRequest.DONE){
           if(xhr.status === 200){
         let data = xhr.response;
        
              displayCont.innerHTML = data;
           }
       }
       }
       xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
       xhr.send("searchTerm=" + searchTerm);
       }
       });
     }

         
   
     function SearchIncomingPatientLabTest(){

          const searchBar = document.getElementById("incomingPatientLabList"),
           displayCont = document.querySelector("#outer-table .inco-Lab");
          
             
          searchBar.addEventListener("focus", () =>{
            searchBar.onkeyup = ()=>{
                clearInterval(intervalIncoLab);
          
                let searchTerm = searchBar.value;
                if(searchTerm != ""){
                    searchBar.classList.add("active");
                }else{ 
                    searchBar.classList.remove("active");
                }
            
                //Ajax code
            let xhr = new XMLHttpRequest();//create Xml oject
            xhr.open("POST", "SearchIncominLabTestPatient.php", true);
            xhr.onload = ()=>{
            if(xhr.readyState === XMLHttpRequest.DONE){
                if(xhr.status === 200){
              let data = xhr.response;
             
                   displayCont.innerHTML = data;
                }
            }
            }
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.send("searchTerm=" + searchTerm);
            }
            });
          }
   
        //   display data to cards
        function displaycardincomingPat(){
  
          const display = document.querySelector("#overview-det .doc-repo-cards .inco-pati-card label");
        
         var xmlhttp = new XMLHttpRequest();
         xmlhttp.open("GET", "DisplayNoincoPatNo.php", true);
         xmlhttp.onreadystatechange = function () {
          if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
            display.innerHTML=xmlhttp.responseText;
          }
      };
          xmlhttp.send(null);
          
        }
        
        function displaycardincomingLabtest(){
        
          const display = document.querySelector("#overview-det .doc-repo-cards .inco-lab-test label");
        
         var xmlhttp = new XMLHttpRequest();
         xmlhttp.open("GET", "DisplayNoincoLabNo.php", true);
         xmlhttp.onreadystatechange = function () {
          if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
            display.innerHTML=xmlhttp.responseText;
          }
      };
          xmlhttp.send(null);
          
        } 
        
        function displaycardincomingAppoint(){
        
          const display = document.querySelector("#overview-det .doc-repo-cards .inco-appoint label");
        
         var xmlhttp = new XMLHttpRequest();
         xmlhttp.open("GET", "DisplayNoincoapoint.php", true);
         xmlhttp.onreadystatechange = function () {
          if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
            display.innerHTML=xmlhttp.responseText;
          }
      };
          xmlhttp.send(null);
          
        }

        ///display data to table
        function changeTable(){
          const display = document.querySelector("#outer-table .doc-pat-sec");
          var xmlhttp = new XMLHttpRequest();
          xmlhttp.open("GET", "displayPatientsDocSec.php", true);
          xmlhttp.onreadystatechange = function () {
            if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
              display.innerHTML=xmlhttp.responseText;
            }
        };
           xmlhttp.send(null);
          
        }


function SearchPatient(){

  const searchBar = document.getElementById("searchPat"),
   displayCont = document.querySelector("#outer-table .doc-pat-sec");
  
     
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
    xhr.open("POST", "SearchPatientdocsec.php", true);
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

   
function markAppointment(){
  const loader = document.getElementById("loader"),
   urlParams = new URLSearchParams(window.location.search),
   paramValue = urlParams.get('HSPN'),
   paramValue1 = urlParams.get('APP_DATE');

 loader.style.display = "initial";

//Ajax code
let xhr = new XMLHttpRequest();
//create Xml oject
xhr.open("GET", "MarkApointmentComp.php?HSPN=" + encodeURIComponent(paramValue) + "&APP_DATE=" + encodeURIComponent(paramValue1), true);
xhr.onload = ()=>{
if(xhr.readyState === XMLHttpRequest.DONE){
   if(xhr.status === 200){
    
loader.style.display = "none";

 let data = xhr.response;
 console.log(data);



if(data == "failed"){
  alert("Failed to Mark As comlete Please try again!");
}

      if(data == "success"){
        alert("Comleted!");  
          }

              if(data == "not set"){ 
                  alert("Technical Error Quit this window and open it again!");
                  } 

   }
}
}

//new formData object

xhr.send(null);
}


function cancelAppointment(){
  const loader = document.getElementById("loader"),
   urlParams = new URLSearchParams(window.location.search),
   paramValue = urlParams.get('HSPN'),
   paramValue1 = urlParams.get('APP_DATE');

 loader.style.display = "initial";

//Ajax code
let xhr = new XMLHttpRequest();
//create Xml oject
xhr.open("GET", "CancelApointmentComp.php?HSPN=" + encodeURIComponent(paramValue) + "&APP_DATE=" + encodeURIComponent(paramValue1), true);
xhr.onload = ()=>{
if(xhr.readyState === XMLHttpRequest.DONE){
   if(xhr.status === 200){
    
loader.style.display = "none";

 let data = xhr.response;
 console.log(data);


if(data == "failed"){
  alert("Failed to Mark As comlete Please try again!");
}

      if(data == "success"){
        alert("Comleted!");  
          }

              if(data == "not set"){ 
                  alert("Technical Error Quit this window and open it again!");
                  } 

   }
}
}

//new formData object

xhr.send(null);
}