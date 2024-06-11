<?php
session_start();

if(!isset($_COOKIE['access'])){
  header("Location:  activate.php");
}
     
if(isset($_SESSION['text_role_hms']) && isset($_SESSION['text_mail_hms'])){
header('Location: index.php');  
die();
}
 
@include 'config.php';

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Hospital Management System</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,initial-scale=1.0">
        <meta http-equiv="X-UA_Compatible" content="IE=edge">
        <link rel="stylesheet" href="indexStyle.css">
        <link rel="stylesheet" href="loginStyle.css">
        <link rel="stylesheet" href="resources/css/all.min.css">
        <link rel="stylesheet" href="resources/css/fontawesome.min.css">
         <!-- Link Swiper's CSS -->
    <link
    rel="stylesheet"
    href="resources/CDN-links/swiper-bundle.css"
  />   

  <style type="text/css">

   </style>

        <script src="resources/CDN-links/jquery.min.js"></script>
    </head>
  <body> 

  <section id="Security-card">
      <div class="field-form">
      <div id="canel-field-form"><i class="fa-solid fa-times"></i></div>
      <h2>Security Question</h2>
      <div class="message-dis-secy">
          <p>Patient add successfully</p>
          <label onClick="remMessage1()"><i class="fa-solid fa-times-square"></i></label>
        </div>
    
        <div class="message-err-dis-secy">
          <p>Patient add falied</p>
          <label onClick="remMessage1()"><i class="fa-solid fa-times-square"></i></label>
        </div>
      <div class="main-container">

   <form action="#" method="post">
            <div class="input-wrapper">
              <label>Email Address*</label>
              <input type="email" name="text_mail" id="emailField" placeholder="please enter email..." onBlur="changeQuiz()" autocomplete="off">
             </div>

          <div class="input-wrapper">
              <p id="quiz">Your Security Question Will Display Here...</p>
             </div>

         <div class="input-wrapper">
          <label>Answer*</label>
          <input type="text" name="text_answer" placeholder="please enter an answer for security question..." autocomplete="off">
         </div>

         <div class="btn-wrapper">
          <button class="btn-save-update" onClick="ConfirmAns()">Submit</button>
         </div>
     </form>
      </div>
      </div>
      </section>
    

      <section id="update-passkey-card">
        <div class="field-form">
        <div id="canel-field-form"><i class="fa-solid fa-times"></i></div>
        <h2>Change Password</h2>
        <div class="message-dis-secy">
            <p>Patient add successfully</p>
            <label onClick="remMessage2()"><i class="fa-solid fa-times-square"></i></label>
          </div>
      
          <div class="message-err-dis-secy">
            <p>Patient add falied</p>
            <label onClick="remMessage2()"><i class="fa-solid fa-times-square"></i></label>
          </div>
        <div class="main-container">
       <form action="#" method="post">
        <div class="input-wrapper">
              <label>Email Address*</label>
              <input type="email" name="text_mail" id="emailField" placeholder="please enter email..." onBlur="changeQuiz()" autocomplete="off">
             </div>

           <div class="input-wrapper">
            <label>New Password*</label>
            <input type="password" name="text_new1" placeholder="please enter new password...">
           </div>
 
           <div class="input-wrapper">
            <label>Confirm Password *</label>
            <input type="password" name="text_new2" placeholder="please confirm new password...">
           </div>

           <div class="btn-wrapper">
            <button class="btn-save-update" onClick="UpdatePassKey()">Save</button>
           </div>
      </form>
        </div>
        </div>
        </section>


    <section id="loader">
        <div class="loader-img">
          <img src="resources/img/loaderr.gif" alt="Loading...">
        </div>
    </section>

    <main>

    <section id="left-dis">
    <div class="top-cont">
    <?php
   $select_facility = mysqli_query($conn, "SELECT * FROM facility_data LIMIT 1");
   if(mysqli_num_rows($select_facility) > 0){
    $row = mysqli_fetch_assoc($select_facility);
    ?>
  
    <h1><?php echo $row["name"]; ?></h1>
    <label><i class="fa-solid fa-phone"></i> Contact:<span><?php echo $row["contact"]; ?></span></label>
    <label><i class="fa-solid fa-envelope"></i> Email:<span><?php echo $row["email"]; ?></span></label>
    <?php
   }else{
   ?>
  <h1>Facility Name not Added</h1>
    <label><i class="fa-solid fa-phone"></i> Contact:<span> _ _ _</span></label>
    <label><i class="fa-solid fa-envelope"></i> Email:<span>_ _ _</span></label>

 <?php
   }
 ?>

    </div>
    <div class="bottom-cont">
    <p>This software was designed and developed by Ospaltic Software Solutions</p>
    <div class="contacts">
        <label><i class="fa-solid fa-phone"></i><span>+254 742 354 784, +254 736 218 327</span></label>
        <label><i class="fa-solid fa-envelope"></i><span>ospaltic@gmail.com</span></label>
    </div>
    <div class="social-contacts">
        <label><i class="fa-solid fa-globe"></i><a href="https://ospalticsoftware.000webhostapp.com/">Visit Website</a></label>
        <label><i class="fa-brands fa-facebook"></i><a href="https://www.facebook.com/Ospaltic-104725722120980/">Facebook</a></label>
    </div>
    </div>
    </section>  

    <section id="right-dis">
     <div class="form-container">
        <div class="log-greet">
            <i class="fa-solid fa-stethoscope"></i>
            <h2>Hello, Welcome Back</h2>
        </div>
       

        <div id="message-dis">
            <p></p>
            <label onClick="remMessage()"><i class="fa-solid fa-times-square"></i></label>
          </div>
    
          <div id="message-err-dis">
            <p></p>
            <label onClick="remMessage()"><i class="fa-solid fa-times-square"></i></label>
          </div>
          <form action="#" method="post"> 
        <div class="field-wrapper">
       <i class="fa-solid fa-envelope"></i>
       <input type="email" name="text_mail" placeholder="Please enter your email address...">
        </div>

        <div class="field-wrapper">
            <i class="fa-solid fa-lock"></i>
            <input type="password" name="text_passkey" placeholder="Please enter your Password...">
             </div>

             <div class="field-wrapper">
                <i class="fa-solid fa-user"></i>
                <select name="text_role">
                    <option value="">--Login as--</option>
                    <option value="user">User</option>
                    <option value="admin">Admin</option>
                </select>
                 </div>
                 <div class="btn-wrapper">
                    <button type="submit" onClick="LoginDet()"><i class="fa-solid fa-arrow-up-right-from-square"></i>Login</button>
                 </div>
        </form>     
              <label class="forgot">forgot password</label> 
              
            
      
     </div>
    </section>

       

    </main>
    <script>
          $('.forgot').click(function(){
        $('#Security-card').addClass('active')
        });
    
        $('#Security-card .field-form #canel-field-form').click(function(){
        $('#Security-card').removeClass('active')
        });

        function displayChangePass(){
        $(' #update-passkey-card').addClass('active')
    
        $('#update-passkey-card .field-form #canel-field-form').click(function(){
        $('#update-passkey-card').removeClass('active')
        });
        }


    </script>
    <script type="text/javascript" src="LoginJs.js"></script>
    <script type="text/javascript">
    function LoginDet(){
const form = document.querySelector("#right-dis .form-container form"),
    messagedis = document.querySelector("#right-dis .form-container #message-dis p"),
    messagecont = document.querySelector("#right-dis .form-container #message-dis"),
    messagediserr=document.querySelector("#right-dis .form-container #message-err-dis p"),
    messageconterr= document.querySelector("#right-dis .form-container #message-err-dis"),
    loader = document.getElementById("loader");


form.onsubmit = (e)=>{
   e.preventDefault();
  //prevent form  submitting
} 
 

  loader.style.display = "initial";
 
//Ajax code
let xhr = new XMLHttpRequest();
//create Xml oject
xhr.open("POST", "LoginDet.php", true);
xhr.onload = ()=>{
if(xhr.readyState === XMLHttpRequest.DONE){
    if(xhr.status === 200){
     
 loader.style.display = "none";

  let data = xhr.response;
  console.log(data);



if(data == "fill out all fields"){
messagediserr.innerHTML="Please fill the field with *";
messageconterr.style.display = "flex";
messagecont.style.display = "none";  
}

if(data == "login success"){
    messagedis.innerHTML="Login Successful!";
    messagecont.style.display = "flex";
    messageconterr.style.display = "none";   
    window.location.href='index.php';
}



if(data == "incorect logins"){
    messagediserr.innerHTML="Incorect Credentials! Please try Again";
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


function remMessage(){

const messagecont = document.querySelector("#right-dis .form-container #message-dis"),
messageconterr= document.querySelector("#right-dis .form-container #message-err-dis");


messageconterr.style.display = "none";
messagecont.style.display = "none"; 
}



function changeQuiz() {
    const display = document.getElementById("quiz");
    const email = document.getElementById("emailField").value; // Get the value of the emailField input

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET", "displayQuiz.php?email=" + encodeURIComponent(email), true);
    
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            display.innerHTML = xmlhttp.responseText; // Update the content of the quiz element
        }
    };
    
    xmlhttp.send();
}



function ConfirmAns(){
   const form = document.querySelector("#Security-card .field-form .main-container form"),
      mainContainer =document.querySelector("#Security-card"),
    messagedis = document.querySelector("#Security-card .field-form .message-dis-secy p"),
    messagecont = document.querySelector("#Security-card .field-form .message-dis-secy"),
    messagediserr=document.querySelector("#Security-card .field-form .message-err-dis-secy p"),
    messageconterr= document.querySelector("#Security-card .field-form .message-err-dis-secy"),
    loader = document.getElementById("loader");


form.onsubmit = (e)=>{
   e.preventDefault();
  //prevent form  submitting
} 
 

  loader.style.display = "initial";
 
//Ajax code
let xhr = new XMLHttpRequest();
//create Xml oject
xhr.open("POST", "QuestionCheckans.php", true);
xhr.onload = ()=>{
if(xhr.readyState === XMLHttpRequest.DONE){
    if(xhr.status === 200){
     
 loader.style.display = "none";

  let data = xhr.response;
  console.log(data);



if(data == "empty field"){
messagediserr.innerHTML="Please fill the field with *";
messageconterr.style.display = "flex";
messagecont.style.display = "none";  
}

if(data == "cor"){
   mainContainer.style.display = "none";
   displayChangePass();
}



if(data == "incor"){
    messagediserr.innerHTML="Incorect Answer! Please try Again";
    messageconterr.style.display = "flex";
    messagecont.style.display = "none";  
}

if(data == "no quiz"){
    messagediserr.innerHTML="Sorry Could not Find Answer! Seek Help from System Admin";
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


function remMessage1(){
  const messagecont = document.querySelector("#Security-card .field-form .message-dis-secy"),
    messageconterr= document.querySelector("#Security-card .field-form .message-err-dis-secy");
    messagecont.style.display="none";
    messageconterr.style.display="none";

}
  function remMessage2(){
   const messagecont = document.querySelector("#update-passkey-card .field-form .message-dis-secy"),
    messageconterr= document.querySelector("#update-passkey-card .field-form .message-err-dis-secy");
    messagecont.style.display="none";
    messageconterr.style.display="none";
  }

function UpdatePassKey(){
   
   const form = document.querySelector("#update-passkey-card .field-form .main-container form"),
   loader = document.getElementById("loader"),
   messagedis = document.querySelector("#update-passkey-card .field-form .message-dis-secy p"),
   messagecont = document.querySelector("#update-passkey-card .field-form .message-dis-secy"),
   messagediserr=document.querySelector("#update-passkey-card .field-form .message-err-dis-secy p"),
   messageconterr= document.querySelector("#update-passkey-card .field-form .message-err-dis-secy");
      
       
   form.onsubmit = (e)=>{
      e.preventDefault();
     //prevent form  submitting
   }   
               
  
       loader.style.display = "initial";
    
       //Ajax code
       let xhr = new XMLHttpRequest();//create Xml oject
       xhr.open("POST", "UpdatePassKeyForgot.php", true);
   
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
                     
                     if(data == "old is equal new"){
                       messagediserr.innerHTML="Old password Can not be used as new Password!";
                       messageconterr.style.display = "flex";
                       messagecont.style.display = "none";  
                     } 

                     if(data == "incor user"){
                       messagediserr.innerHTML="Sorry The Email You Provided Do not Exist!";
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

</script>
</body>
</html>