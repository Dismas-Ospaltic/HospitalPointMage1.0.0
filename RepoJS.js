function displayReportList(){
    const display = document.querySelector("#report-container .list-cont-repo");
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET", "ShowReport.php", false);
     xmlhttp.send(null);
     display.innerHTML=xmlhttp.responseText;
  }
          
  function displayDailyVisitReportList(){


     const display = document.querySelector("#visit-cont"),
     urlParams = new URLSearchParams(window.location.search),
    paramValue = urlParams.get('repoDate');
  
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET", "ShowSingleVisitReport.php?repoDate=" + encodeURIComponent(paramValue), false);
     xmlhttp.send(null);

     display.innerHTML=xmlhttp.responseText;
     data = xmlhttp.responseText;
  
     if(data == "No Data!" || data == "not Set"){
         window.location.href = "report.php.php";
     }
     
    //  console.log(data);
  }

  ///display data to table
function changePatientInvoice(){
   
    const display = document.querySelector("#visit-cont"),
    urlParams = new URLSearchParams(window.location.search),
    paramValue = urlParams.get('repoDate');
 
   var xmlhttp = new XMLHttpRequest();
   xmlhttp.open("GET", "displayVisitInvoice.php?repoDate=" + paramValue, false);
    xmlhttp.send(null);
    display.innerHTML=xmlhttp.responseText;
    data = xmlhttp.responseText;
 
    if(data == "No Data!" || data == "not Set"){
        window.location.href = "report.php";
    }
  
 }

   
 function ChangeInvoiceMoreDetDisplay(){
       
    const display = document.querySelector("#invoice"),
    urlParams = new URLSearchParams(window.location.search),
    paramValue = urlParams.get('HSPN'),
    paramValue1 = urlParams.get('V_ID');
    
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET", "InvoiceInnerContentReport.php?HSPN=" + paramValue + "&V_ID=" + paramValue1, false);
    xmlhttp.send(null);
    display.innerHTML=xmlhttp.responseText;
    data = xmlhttp.responseText;
    
    // if(data == "No Data!" || data == "not Set"){
    //     window.location.href = "doctor.php";
    // }
    
    } 



      function SearchPatientSingleVisit(){

        const searchBar = document.getElementById("searchSingleVisit"),
         displayCont = document.querySelector("#visit-cont"),
         urlParams = new URLSearchParams(window.location.search),
         paramValue = urlParams.get('repoDate');
        
           
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
          xhr.open("POST", "SearchPatientSingleVisit.php?repoDate=" + encodeURIComponent(paramValue), true);
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

        function SearchPatientSingleVisitInvoice(){

            const searchBar = document.getElementById("searchSingleVisitInvoice"),
             displayCont = document.querySelector("#visit-cont"),
             urlParams = new URLSearchParams(window.location.search),
             paramValue = urlParams.get('repoDate');
            
               
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
              xhr.open("POST", "SearchPatientSingleVisitInvoice.php?repoDate=" + encodeURIComponent(paramValue), true);
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


            function SearchPatientGenReport(){
              const searchBar = document.getElementById("searchGenReport"),
               displayCont = document.querySelector("#report-container .list-cont-repo");
      
              
                 
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
                xhr.open("POST", "SearchPatientGenReport.php", true);
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