function ShowStaffProfile(){
    const display = document.querySelector("#profile-sec .user-pro .list-det");
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET", "ShowstaffDetailsProfile.php", false);
     xmlhttp.send(null);
     display.innerHTML=xmlhttp.responseText;
  } 
  
  
  function ShowfacilityProfile(){
    const display = document.querySelector("#profile-sec .facility-pro .list-det");
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET", "ShowfacilityDetailsProfile.php", false);
     xmlhttp.send(null);
     display.innerHTML=xmlhttp.responseText;
  } 


  function changesecurityDetFields(){

    const display = document.querySelector(".security-quiz");
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET", "ShowSecurityQuizDetFields.php", false);
    xmlhttp.send(null);
    display.innerHTML=xmlhttp.responseText;
    }


  function changeFacilityDetFields(){

    const display = document.querySelector("#update-biz-profile-card .field-form .main-container");
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET", "ShowfacilityDetFields.php", false);
    xmlhttp.send(null);
    display.innerHTML=xmlhttp.responseText;
    }
    
  
  function changestaffDetFields(){

    const display = document.querySelector("#update-profile-card .field-form .main-container");
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET", "ShowempDetFields.php", false);
    xmlhttp.send(null);
    display.innerHTML=xmlhttp.responseText;
    }

    function UpdateUserProfile(){
  
        const form = document.querySelector("#update-profile-card .field-form .main-container form"),
        loader = document.getElementById("loader"),
        messagedis = document.querySelector("#update-profile-card .field-form .message-dis p"),
        messagecont = document.querySelector("#update-profile-card .field-form .message-dis"),
        messagediserr=document.querySelector("#update-profile-card .field-form .message-dis-err p"),
        messageconterr= document.querySelector("#update-profile-card .field-form .message-dis-err");
           
            
        form.onsubmit = (e)=>{
           e.preventDefault();
          //prevent form  submitting
        }   
                    
       
            loader.style.display = "initial";
         
            //Ajax code
            let xhr = new XMLHttpRequest();//create Xml oject
            xhr.open("POST", "UpdateUserProfile.php", true);
        
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
    
                      if(data == "empty fields"){
                            messagediserr.innerHTML="Please fill the field with *";
                            messageconterr.style.display = "flex";
                            messagecont.style.display = "none";  
                          }
                     
                          ShowStaffProfile();
                          logoutDet();
                }
            }
            }
            //send the form data throught ajax to php
            let formData = new FormData(form); //new formData object
            xhr.send(formData);
            
        }

        function UpdateFacilityProfile(){
  
            const form = document.querySelector("#update-biz-profile-card .field-form .main-container form"),
            loader = document.getElementById("loader"),
            messagedis = document.querySelector("#update-biz-profile-card .field-form .message-dis p"),
            messagecont = document.querySelector("#update-biz-profile-card .field-form .message-dis"),
            messagediserr=document.querySelector("#update-biz-profile-card .field-form .message-dis-err p"),
            messageconterr= document.querySelector("#update-biz-profile-card .field-form .message-dis-err");
               
                
            form.onsubmit = (e)=>{
               e.preventDefault();
              //prevent form  submitting
            }   
                        
           
                loader.style.display = "initial";
             
                //Ajax code
                let xhr = new XMLHttpRequest();//create Xml oject
                xhr.open("POST", "UpdateFacilityProfile.php", true);
            
                xhr.onload = ()=>{
                if(xhr.readyState === XMLHttpRequest.DONE){
                    if(xhr.status === 200){
                      loader.style.display = "none";
                      
                
                  let data = xhr.response;
                  console.log(data);
                
                  if(data == "added successfully"){
                    messagedis.innerHTML="Updated successfully!";
                    messagecont.style.display = "flex";
                    messageconterr.style.display = "none"; 
                  }
            
                  if(data == "failed"){
                        messagediserr.innerHTML="Update Failed Try again!";
                        messageconterr.style.display = "flex"; 
                        messagecont.style.display = "none"; 
                      }
        
                          if(data == "empty fields"){
                                messagediserr.innerHTML="Please fill the field with *";
                                messageconterr.style.display = "flex";
                                messagecont.style.display = "none";  
                              }
                         
                              ShowfacilityProfile();
                    }
                }
                }
                //send the form data throught ajax to php
                let formData = new FormData(form); //new formData object
                xhr.send(formData);
                
            }
 

            function AddFacilityProfile(){
  
                const form = document.querySelector("#add-biz-profile-card .field-form .main-container form"),
                loader = document.getElementById("loader"),
                messagedis = document.querySelector("#add-biz-profile-card .field-form .message-dis p"),
                messagecont = document.querySelector("#add-biz-profile-card .field-form .message-dis"),
                messagediserr=document.querySelector("#add-biz-profile-card .field-form .message-dis-err p"),
                messageconterr= document.querySelector("#add-biz-profile-card .field-form .message-dis-err");
                    
                    
                form.onsubmit = (e)=>{
                   e.preventDefault();
                  //prevent form  submitting
                }   
                            
               
                    loader.style.display = "initial";
                 
                    //Ajax code
                    let xhr = new XMLHttpRequest();//create Xml oject
                    xhr.open("POST", "AddFacilityProfile.php", true);
                
                    xhr.onload = ()=>{
                    if(xhr.readyState === XMLHttpRequest.DONE){
                        if(xhr.status === 200){
                          loader.style.display = "none";
                          
                    
                      let data = xhr.response;
                      console.log(data);
                    
                      if(data == "added successfully"){
                        messagedis.innerHTML="Added successfully!";
                        messagecont.style.display = "flex";
                        messageconterr.style.display = "none"; 
                      }
                
                      if(data == "failed"){
                            messagediserr.innerHTML="Add Failed Try again!";
                            messageconterr.style.display = "flex"; 
                            messagecont.style.display = "none"; 
                          }
            
                              if(data == "empty fields"){
                                    messagediserr.innerHTML="Please fill the field with *";
                                    messageconterr.style.display = "flex";
                                    messagecont.style.display = "none";  
                                  }

                                  if(data == "Profile added"){
                                    messagediserr.innerHTML="Profile already added Click Update Button to edit";
                                    messageconterr.style.display = "flex";
                                    messagecont.style.display = "none";  
                                  }
                                  
                                  ShowfacilityProfile();
                        }
                    }
                    }
                    //send the form data throught ajax to php
                    let formData = new FormData(form); //new formData object
                    xhr.send(formData);
                    
                }


                function AddsecurityQuiz(){
  
                    const form = document.querySelector(".security-quiz form"),
                    loader = document.getElementById("loader");
                       
                        
                    form.onsubmit = (e)=>{
                       e.preventDefault();
                      //prevent form  submitting
                    }   
                                
                   
                        loader.style.display = "initial";
                     
                        //Ajax code
                        let xhr = new XMLHttpRequest();//create Xml oject
                        xhr.open("POST", "AddSecurityQuiz.php", true);
                    
                        xhr.onload = ()=>{
                        if(xhr.readyState === XMLHttpRequest.DONE){
                            if(xhr.status === 200){
                              loader.style.display = "none";
                              
                        
                          let data = xhr.response;
                          console.log(data);
                        
                          if(data == "added successfully"){
                        alert("Security Question added Successfully!");
                          }
                    
                          if(data == "failed"){
                            alert("Security Question failed to add Please Try Again!");
                              }
                
                                  if(data == "empty fields"){
                                    alert("Please fill All the fields"); 
                                      }

                                      if(data == "cannot"){
                                        alert("Please fill Answer the Question"); 
                                          }
                                      
                                 
                                      changesecurityDetFields();
                            }
                        }
                        }
                        //send the form data throught ajax to php
                        let formData = new FormData(form); //new formData object
                        xhr.send(formData);
                        
                    }

                    function UpdatePassKey(){
   
                        const form = document.querySelector("#update-passkey-card .field-form .main-container form"),
                        loader = document.getElementById("loader"),
                        messagedis = document.querySelector("#update-passkey-card .field-form .message-dis p"),
                        messagecont = document.querySelector("#update-passkey-card .field-form .message-dis"),
                        messagediserr=document.querySelector("#update-passkey-card .field-form .message-dis-err p"),
                        messageconterr= document.querySelector("#update-passkey-card .field-form .message-dis-err");
                           
                            
                        form.onsubmit = (e)=>{
                           e.preventDefault();
                          //prevent form  submitting
                        }   
                                    
                       
                            loader.style.display = "initial";
                         
                            //Ajax code
                            let xhr = new XMLHttpRequest();//create Xml oject
                            xhr.open("POST", "UpdatePassKeyProfile.php", true);
                        
                            xhr.onload = ()=>{
                            if(xhr.readyState === XMLHttpRequest.DONE){
                                if(xhr.status === 200){
                                  loader.style.display = "none";
                                  
                            
                              let data = xhr.response;
                              console.log(data);
                            
                              if(data == "success"){
                                messagedis.innerHTML="Updated successfully!";
                                messagecont.style.display = "flex";
                                messageconterr.style.display = "none"; 
                              }
                        
                              if(data == "failed"){
                                    messagediserr.innerHTML="Update Failed Try again!";
                                    messageconterr.style.display = "flex"; 
                                    messagecont.style.display = "none"; 
                                  }
                    
                                      if(data == "empty fields"){
                                            messagediserr.innerHTML="Please fill the field with *";
                                            messageconterr.style.display = "flex";
                                            messagecont.style.display = "none";  
                                          }
                                          if(data == "not match"){
                                            messagediserr.innerHTML="Sorry the passwords do not match";
                                            messageconterr.style.display = "flex";
                                            messagecont.style.display = "none";  
                                          }   
                                          if(data == "incorrect old"){
                                            messagediserr.innerHTML="Old password is incorrect";
                                            messageconterr.style.display = "flex";
                                            messagecont.style.display = "none";  
                                          } 
                                          if(data == "old is equal new"){
                                            messagediserr.innerHTML="Old password Can not be used as new Password!";
                                            messageconterr.style.display = "flex";
                                            messagecont.style.display = "none";  
                                          } 
                                }
                            }
                            }
                            //send the form data throught ajax to php
                            let formData = new FormData(form); //new formData object
                            xhr.send(formData);
                            
                        }
    
