function UpdateOfflineData(){
  
    const loader = document.getElementById("ofline-data-backup-card"),
    messagedis = document.querySelector("#ofline-data-backup-card .field-form .message-dis p"),
    messagecont = document.querySelector("#ofline-data-backup-card .field-form .message-dis");
       

        loader.style.display = "initial";
        //Ajax code
        let xhr = new XMLHttpRequest();//create Xml oject
        xhr.open("GET", "oflineDataBackup.php", true);
    
        xhr.onload = ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
              loader.style.display = "none";
              
        
          let data = xhr.response;
          console.log(data);
        
          messagedis.innerHTML=data;
          messagecont.style.display = "flex";

        
            }
        }
        }
        //send the form data throught ajax to php
        xhr.send(null);
        
    }


    function UpdateOnlineData(){
        
        const loader = document.getElementById("online-data-backup-card"),
        messagedis = document.querySelector("#online-data-backup-card .field-form .message-dis p"),
        messagecont = document.querySelector("#online-data-backup-card .field-form .message-dis");
           
    
            loader.style.display = "initial";
            //Ajax code
            let xhr = new XMLHttpRequest();//create Xml oject
            xhr.open("GET", "onlineDataBackup.php", true);
        
            xhr.onload = ()=>{
            if(xhr.readyState === XMLHttpRequest.DONE){
                if(xhr.status === 200){
                  loader.style.display = "none";
                  
            
              let data = xhr.response;
              console.log(data);
            
              messagedis.innerHTML=data;
              messagecont.style.display = "flex";
    
            
                }
            }
            }
            //send the form data throught ajax to php
            xhr.send(null);
            
        }