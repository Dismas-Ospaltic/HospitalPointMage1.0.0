function changeEquipTable(){
    const display = document.querySelector("#outer-table .table-equip");
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET", "ShowEquip.php", false);
     xmlhttp.send(null);
     display.innerHTML=xmlhttp.responseText;
  }

  function addEquip(){
   
    const form = document.querySelector("#add-equipment-card .field-form .main-container form"),
    loader = document.getElementById("loader"),
    messagedis = document.querySelector("#add-equipment-card .field-form #message-dis p"),
    messagecont = document.querySelector("#add-equipment-card .field-form #message-dis"),
    messagediserr=document.querySelector("#add-equipment-card .field-form #message-err-dis p"),
    messageconterr= document.querySelector("#add-equipment-card .field-form #message-err-dis");
       
        
    form.onsubmit = (e)=>{
       e.preventDefault();
      //prevent form  submitting
    }   
                
   
        loader.style.display = "initial";
     
        //Ajax code
        let xhr = new XMLHttpRequest();//create Xml oject
        xhr.open("POST", "AddEquip.php", true);
    
        xhr.onload = ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
              loader.style.display = "none";
              
        
          let data = xhr.response;
          console.log(data);
        
          if(data == "added successfully"){
            messagedis.innerHTML="Equipment added successfully!";
            messagecont.style.display = "flex";
            messageconterr.style.display = "none"; 
          }
    
          if(data == "failed"){
                messagediserr.innerHTML="Equipment add Failed Try again!";
                messageconterr.style.display = "flex"; 
                messagecont.style.display = "none"; 
              }
        
              if(data == "equip exists"){
                    messagediserr.innerHTML="Equipment already exists! Failed Try again!";
                    messageconterr.style.display = "flex"; 
                    messagecont.style.display = "none"; 
                  }

                  if(data == "empty fields"){
                        messagediserr.innerHTML="Please fill the field with *";
                        messageconterr.style.display = "flex";
                        messagecont.style.display = "none";  
                      }
                 
                      changeEquipTable();
            }
        }
        }
        //send the form data throught ajax to php
        let formData = new FormData(form); //new formData object
        xhr.send(formData);
        
    }


    function changeequipDet(){

        const display = document.querySelector("#update-equipment-card .field-form .main-container"),
        urlParams = new URLSearchParams(window.location.search),
        paramValue = urlParams.get('name'),
        paramValue1 = urlParams.get('proid');
        
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.open("GET", "ShowEquipData.php?name=" + paramValue + "&proid=" +paramValue1, false);
        xmlhttp.send(null);
        display.innerHTML=xmlhttp.responseText;
        }

    function updateEquip(){
    
        const form = document.querySelector("#update-equipment-card .field-form .main-container form"),
        loader = document.getElementById("loader"),
        messagedis = document.querySelector("#update-equipment-card .field-form #message-dis p"),
        messagecont = document.querySelector("#update-equipment-card .field-form #message-dis"),
        messagediserr=document.querySelector("#update-equipment-card .field-form #message-err-dis p"),
        messageconterr= document.querySelector("#update-equipment-card .field-form #message-err-dis"),
        urlParams = new URLSearchParams(window.location.search),
        paramValue = urlParams.get('name'),
        paramValue1 = urlParams.get('proid');
           
            
        form.onsubmit = (e)=>{
           e.preventDefault();
          //prevent form  submitting
        }   
                    
       
            loader.style.display = "initial";
         
            //Ajax code
            let xhr = new XMLHttpRequest();//create Xml oject
            xhr.open("POST", "UpdateEquip.php?name=" + encodeURIComponent(paramValue)  + "&proid="+ encodeURIComponent(paramValue1), true);
            // xhr.open("POST", "UpdateEmp.php", true);
        
            xhr.onload = ()=>{
            if(xhr.readyState === XMLHttpRequest.DONE){
                if(xhr.status === 200){
                  loader.style.display = "none";
                  
            
              let data = xhr.response;
              console.log(data);
            
              if(data == "added successfully"){
                messagedis.innerHTML="Equipment Updated successfully!";
                messagecont.style.display = "flex";
                messageconterr.style.display = "none"; 
              }
        
              if(data == "failed"){
                    messagediserr.innerHTML="Equipment Update Failed Try again!";
                    messageconterr.style.display = "flex"; 
                    messagecont.style.display = "none"; 
                  }
            
                  if(data == "emp exists"){
                        messagediserr.innerHTML="Equipment already exists! Failed Try again!";
                        messageconterr.style.display = "flex"; 
                        messagecont.style.display = "none"; 
                      }
    
                      if(data == "empty fields"){
                            messagediserr.innerHTML="Please fill the field with *";
                            messageconterr.style.display = "flex";
                            messagecont.style.display = "none";  
                          }
                     
                          changeEquipTable();
                }
            }
            }
            //send the form data throught ajax to php
            let formData = new FormData(form); //new formData object
            xhr.send(formData);
            
    }

    function DeleteequipDet(){
        const urlParams = new URLSearchParams(window.location.search),
         paramValue = urlParams.get('name'),
         paramValue1 = urlParams.get('proid'),
        loader = document.getElementById("loader");
              
               
               loader.style.display = "initial";
            
               //Ajax code
               let xhr = new XMLHttpRequest();//create Xml oject
               xhr.open("GET", "DeleteequipDet.php?name=" + paramValue + "&proid=" + paramValue1, true);
           
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
                        
                    changeEquipTable();
                   }
               }
               }
               xhr.send();
        
           }