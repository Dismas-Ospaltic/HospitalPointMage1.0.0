function changeempTable(){
    const display = document.querySelector("#outer-table .table-staff");
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET", "Showstaff.php", false);
     xmlhttp.send(null);
     display.innerHTML=xmlhttp.responseText;
  }


  function addEmp(){
  
    const form = document.querySelector("#add-emp-card .field-form .main-container form"),
    loader = document.getElementById("loader"),
    messagedis = document.querySelector("#add-emp-card .field-form #message-dis p"),
    messagecont = document.querySelector("#add-emp-card .field-form #message-dis"),
    messagediserr=document.querySelector("#add-emp-card .field-form #message-err-dis p"),
    messageconterr= document.querySelector("#add-emp-card .field-form #message-err-dis");
       
        
    form.onsubmit = (e)=>{
       e.preventDefault();
      //prevent form  submitting
    }   
                
   
        loader.style.display = "initial";
     
        //Ajax code
        let xhr = new XMLHttpRequest();//create Xml oject
        xhr.open("POST", "AddNewEmp.php", true);
    
        xhr.onload = ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
              loader.style.display = "none";
              
        
          let data = xhr.response;
          console.log(data);
        
          if(data == "added successfully"){
            messagedis.innerHTML="Staff added successfully!";
            messagecont.style.display = "flex";
            messageconterr.style.display = "none"; 
          }
    
          if(data == "failed"){
                messagediserr.innerHTML="Staff add Failed Try again!";
                messageconterr.style.display = "flex"; 
                messagecont.style.display = "none"; 
              }
        
              if(data == "emp exists"){
                    messagediserr.innerHTML="employee already exists! Failed Try again!";
                    messageconterr.style.display = "flex"; 
                    messagecont.style.display = "none"; 
                  }

                  if(data == "empty fields"){
                        messagediserr.innerHTML="Please fill the field with *";
                        messageconterr.style.display = "flex";
                        messagecont.style.display = "none";  
                      }
                 
                      changeempTable();
            }
        }
        }
        //send the form data throught ajax to php
        let formData = new FormData(form); //new formData object
        xhr.send(formData);
        
    }

   
    function UpdateEmp(){
  
        const form = document.querySelector("#update-emp-card .field-form .main-container form"),
        loader = document.getElementById("loader"),
        messagedis = document.querySelector("#update-emp-card .field-form #message-dis p"),
        messagecont = document.querySelector("#update-emp-card .field-form #message-dis"),
        messagediserr=document.querySelector("#update-emp-card .field-form #message-err-dis p"),
        messageconterr= document.querySelector("#update-emp-card .field-form #message-err-dis"),
        urlParams = new URLSearchParams(window.location.search),
        paramValue = urlParams.get('mail');
           
            
        form.onsubmit = (e)=>{
           e.preventDefault();
          //prevent form  submitting
        }   
                    
       
            loader.style.display = "initial";
         
            //Ajax code
            let xhr = new XMLHttpRequest();//create Xml oject
            xhr.open("POST", "UpdateEmp.php?mail=" + encodeURIComponent(paramValue), true);
            // xhr.open("POST", "UpdateEmp.php", true);
        
            xhr.onload = ()=>{
            if(xhr.readyState === XMLHttpRequest.DONE){
                if(xhr.status === 200){
                  loader.style.display = "none";
                  
            
              let data = xhr.response;
              console.log(data);
            
              if(data == "added successfully"){
                messagedis.innerHTML="Staff Updated successfully!";
                messagecont.style.display = "flex";
                messageconterr.style.display = "none"; 
              }
        
              if(data == "failed"){
                    messagediserr.innerHTML="Staff Update Failed Try again!";
                    messageconterr.style.display = "flex"; 
                    messagecont.style.display = "none"; 
                  }
            
                  if(data == "emp exists"){
                        messagediserr.innerHTML="employee already exists! Failed Try again!";
                        messageconterr.style.display = "flex"; 
                        messagecont.style.display = "none"; 
                      }
    
                      if(data == "empty fields"){
                            messagediserr.innerHTML="Please fill the field with *";
                            messageconterr.style.display = "flex";
                            messagecont.style.display = "none";  
                          }
                     
                          changeempTable();
                }
            }
            }
            //send the form data throught ajax to php
            let formData = new FormData(form); //new formData object
            xhr.send(formData);
            
        }

    function changeempDet(){

        const display = document.querySelector("#update-emp-card .field-form .main-container"),
        urlParams = new URLSearchParams(window.location.search),
        paramValue = urlParams.get('mail');
        
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.open("GET", "ShowempDet.php?mail=" + paramValue, false);
        xmlhttp.send(null);
        display.innerHTML=xmlhttp.responseText;
        }

        function DeleteempDet(){
            const urlParams = new URLSearchParams(window.location.search),
             paramValue = urlParams.get('mail'),
               loader = document.getElementById("loader");
                  
                   
                   loader.style.display = "initial";
                
                   //Ajax code
                   let xhr = new XMLHttpRequest();//create Xml oject
                   xhr.open("GET", "DeleteempDet.php?mail=" + paramValue, true);
               
                   xhr.onload = ()=>{
                   if(xhr.readyState === XMLHttpRequest.DONE){
                       if(xhr.status === 200){
                         loader.style.display = "none";
                         
                   
                     let data = xhr.response;
                     console.log(data);
                   
                        if(data == "deleted"){
                        alert("Delete successfully");
                        }
                        if(data == "failed"){
                          alert("Delete Failed Try Again"); 
                        }
                            
                        changeempTable();
                       }
                   }
                   }
                   xhr.send();
            
               }