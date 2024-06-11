<!DOCTYPE html>
<html>
    <head>
        <title>Hospital Management System</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,initial-scale=1.0">
        <meta http-equiv="X-UA_Compatible" content="IE=edge">
        <link rel="stylesheet" href="indexStyle.css">
        <link rel="stylesheet" href="activateStyle.css">
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

    <section id="loader">
        <div class="loader-img">
          <img src="resources/img/loaderr.gif" alt="Loading...">
        </div>
    </section>
<main>
    <section id="main-container">
        <h1>Activate Hospital Management System</h1>
        <p id="message"></p>
    <div class="form-container">
   <form action="#" method="post">
       <div class="input-wrapper">
        <label><strong>Access Token</strong></label>
        <div class="input-btn">
            <input type="text" name="text_token" placeholder="Enter access Token...">
            <button class="activate" onclick="checkInternetConnection()">Activate</button>
            <button class="app" onclick="window.location.href='patient.php'">Go To App</button>
        </div>
</form>
       </div>
    </div>
    </section>
</main>
    
<script type="text/javascript">
function ActivateApp(){
const form = document.querySelector("#main-container .form-container form"),
    loader = document.getElementById("loader"),
    messageCont = document.getElementById("message");


form.onsubmit = (e)=>{
   e.preventDefault();
  //prevent form  submitting
} 
 

loader.style.display = "initial";
 
//Ajax code
let xhr = new XMLHttpRequest();
//create Xml oject
xhr.open("POST", "ActivateApp.php", true);
xhr.onload = ()=>{
if(xhr.readyState === XMLHttpRequest.DONE){
    if(xhr.status === 200){
     
 loader.style.display = "none";

  let data = xhr.response;

  messageCont.innerHTML=data;

    }
}
}
//send the form data throught ajax to php
let formData = new FormData(form); 
//new formData object

xhr.send(formData);
}



function checkInternetConnection() {
    const form = document.querySelector("#main-container .form-container form"),
          messageCont = document.getElementById("message");


    form.onsubmit = (e)=>{
   e.preventDefault();
  //prevent form  submitting
} 

            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'check_connection.php', true);
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    if (xhr.responseText === "online") {
                        // Internet connection is online
                        // console.log("Online");
                        let data = xhr.response;
                        messageCont.innerHTML=data;
                        ActivateApp();
                    } else {
                        // Internet connection is offline
                        // console.log("Offline");
                        let data = xhr.response;
                        messageCont.innerHTML=data;
                        // ActivateApp();
                    }
                }
            }; 
            xhr.send();
        }
     
</script>

</body>
</html>