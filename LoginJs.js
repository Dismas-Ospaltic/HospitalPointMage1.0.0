// function LoginDet(){
//     const form = document.querySelector("#right-dis .form-container form"),
//         messagedis = document.querySelector("#right-dis .form-container #message-dis p"),
//         messagecont = document.querySelector("#right-dis .form-container #message-dis"),
//         messagediserr=document.querySelector("#right-dis .form-container #message-err-dis p"),
//         messageconterr= document.querySelector("#right-dis .form-container #message-err-dis"),
//         loader = document.getElementById("loader");
    
    
//     form.onsubmit = (e)=>{
//        e.preventDefault();
//       //prevent form  submitting
//     } 
     
    
//       loader.style.display = "initial";
     
//     //Ajax code
//     let xhr = new XMLHttpRequest();
//     //create Xml oject
//     xhr.open("POST", "LoginDet.php", true);
//     xhr.onload = ()=>{
//     if(xhr.readyState === XMLHttpRequest.DONE){
//         if(xhr.status === 200){
         
//      loader.style.display = "none";
    
//       let data = xhr.response;
//       console.log(data);
    
    
    
//     if(data == "fill out all fields"){
//     messagediserr.innerHTML="Please fill the field with *";
//     messageconterr.style.display = "flex";
//     messagecont.style.display = "none";  
//     }
    
//     if(data == "login success"){
//         messagedis.innerHTML="Login Successful!";
//         messagecont.style.display = "flex";
//         messageconterr.style.display = "none";   
//         window.location.href='patient.php';
//     }
    
    
    
//     if(data == "incorect logins"){
//         messagediserr.innerHTML="Incorect Credentials! Please try Again";
//         messageconterr.style.display = "flex";
//         messagecont.style.display = "none";  
//     }
     
//         }
//     }
//     }
//     //send the form data throught ajax to php
//     let formData = new FormData(form); 
//     //new formData object
    
//     xhr.send(formData);
//     }