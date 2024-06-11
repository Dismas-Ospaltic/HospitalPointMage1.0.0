<?php
session_start();
@include 'config.php';
$current_date = date("Y-m-d");
if(!isset($_COOKIE['access'])){
  header("Location:  activate.php");
} 
if(!isset($_COOKIE['text_role_hms']) && !isset($_COOKIE['text_mail_hms'])){
header("Location:  Login.php");
}

$_SESSION['text_mail_hms']=$_COOKIE['text_mail_hms'];
$_SESSION['text_role_hms']=$_COOKIE['text_role_hms'];

$session_user=$_SESSION['text_mail_hms'];
$session_role=$_SESSION['text_role_hms'];

if($session_role == "admin"){
$select_admin_det = mysqli_query($conn, "SELECT * FROM admin_data WHERE email_address='{$session_user}'");
if(mysqli_num_rows($select_admin_det) > 0){
  $row = mysqli_fetch_assoc($select_admin_det);
  $adminName = $row["first_name"]." ".$row["middle_name"]." ".$row["last_name"];
  $role = $row["role"];
}else{

}
}else{
  $select_other_det = mysqli_query($conn, "SELECT * FROM employee_data WHERE email_address='{$session_user}'");
if(mysqli_num_rows($select_other_det) > 0){
  $row = mysqli_fetch_assoc($select_other_det);
  $adminName = $row["first_name"]." ".$row["middle_name"]." ".$row["last_name"];
  $role = $row["role"];
}else{

}
}


?>
<!DOCTYPE html>
<html>
    <head>
        <title>Hospital Management System</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,initial-scale=1.0">
        <meta http-equiv="X-UA_Compatible" content="IE=edge">
        <link rel="stylesheet" href="indexStyle.css">
        <link rel="stylesheet" href="settingStyle.css">
        <link rel="stylesheet" href="resources/css/all.min.css">
        <link rel="stylesheet" href="resources/css/fontawesome.min.css">
         <!-- Link Swiper's CSS -->
    <link
    rel="stylesheet"
    href="resources/CDN-links/swiper-bundle.css"
  />
      <style type="text/css">

:root{
   
   --main-color: royalblue;
   --secondary-color:orangered;
   --green: #27ae60;
   --black: #333;
   --white: #fff;
   --light-bg-color: #f2f3f5;
   --border-color: #e5e8ec;
   /* --navyBlue: rgba(0, 0, 128, 50%); */
   --navyBlue: rgba(0, 0, 119, 0.8);
   --color-dark: #1D2231;
   --text-grey: #8390A2;
   --coolor: #6ea1e9;
   --blueViolet: blueviolet;
   --beautiful: #6e25f5;
   /* color: rgb(9, 240, 163) */
}

#profile-sec{
   display: flex;
   justify-content: space-between;
   align-items: center;
}
#profile-sec .user-pro{
   background: var(--white);
   border-radius: 10px;
   padding: 1rem;
   width: 50%;
}

#profile-sec .user-pro .icon-header{
   display: flex;
   align-items: baseline;
}
#profile-sec .user-pro .icon-header i{
   font-size: 2rem;
   color: var(--white);
   padding: .5rem;
   background: var(--navyBlue);
   border-radius: 5px;
}
#profile-sec .user-pro .icon-header h3{
   font-weight: 600;
   font-size: 1.5rem;
   color: var(--navyBlue);
}
#profile-sec .user-pro .list-det{
  display: flex; 
  flex-direction: column;
}
#profile-sec .user-pro .list-det label strong{
  color: var(--coolor); 
}
#profile-sec .user-pro .list-det label span{
   color: var(--text-grey);
   padding-left: .3rem;
}
.btn-opps{
   display: flex;
}
.btn-opps button{
   padding: .5rem 1rem;
   color: var(--white);
   border-radius: 5px;
   cursor: pointer;
}
.btn-opps button:hover{
   opacity: .7;
}
.btn-opps .btn-edit{
background: var(--green);
margin: .5rem;
}
.btn-opps .btn-change{
   background: crimson;
   margin: .5rem;
}

/* facility */
#profile-sec .facility-pro{
   background: var(--white);
   border-radius: 10px;
   padding: 1rem;
   width: 45%;
}
#profile-sec .facility-pro .icon-header{
   display: flex;
   align-items: baseline;
}
#profile-sec .facility-pro .icon-header i{
   font-size: 2rem;
   color: var(--white);
   padding: .5rem;
   background: var(--navyBlue);
   border-radius: 5px;
}
#profile-sec .facility-pro .icon-header h3{
   font-weight: 600;
   font-size: 1.5rem;
   color: var(--navyBlue);
}
#profile-sec .facility-pro .list-det{
  display: flex; 
  flex-direction: column;
}

#profile-sec .facility-pro .list-det label strong{
   color: var(--coolor); 
}
#profile-sec .facility-pro .list-det label span{
    color: var(--text-grey);
    padding-left: .3rem;
}
.btn-opps{
    display: flex;
}
.btn-opps button{
    padding: .5rem 1rem;
    color: var(--white);
    border-radius: 5px;
    cursor: pointer;
}
.btn-opps button:hover{
    opacity: .7;
}
.btn-opps .btn-add-facility{
 background: var(--main-color);
 margin: .5rem;
}
.btn-opps .btn-edit-facility{
    background: chocolate;
    margin: .5rem;
}
.not-data-sec{
width: fit-content;
margin: 0 auto;
padding: .5rem;
background: var(--text-grey);
color: var(--main-color);
border-radius: 20px;
}

.security-quiz{
   background: var(--white);
   padding: .5rem;
   border-radius: 10px;
   margin-top: 10px;
   border: 1px solid var(--navyBlue);
}
.security-quiz label{
   display: flex;
   align-items: baseline;
   color: var(--navyBlue);
}
.security-quiz label i{
   font-size: 1.2rem;
  
}
.security-quiz label span{
   padding-left: .5rem;
}
.security-quiz .select-cont .wrapp-cont-security{
display: flex;
border: 1px solid var(--navyBlue);
border-radius: 5px;
width: 50%;
overflow: hidden;
margin-top: .2rem;
}
.security-quiz .select-cont .wrapp-cont-security input,
.security-quiz .select-cont .wrapp-cont-security select{
width: 100%;
height: 100%;
font-size: 1.2rem;
}
.btn-cont-opps button{
   padding: .3rem .8rem;
   color: var(--white);
   margin-top: .3rem;
   border-radius: 10px;
   cursor: pointer;
}
.btn-cont-opps button:hover{
   opacity: .7;
}
.btn-add-answer{
   background: var(--navyBlue);
}
/* backup option style */
#data-backup{
   background: var(--white);
   border-radius: 10px;
   border: 1px solid var(--navyBlue);
   padding: .5rem;
   margin-top: 10px;
}
#data-backup .header-sec{
display: flex;
align-items: baseline;
}
#data-backup .header-sec i{
   font-size: 1.5rem;
   color: var(--navyBlue);
}
#data-backup .header-sec h3{
   padding-left: .5rem;
   color: var(--color-dark);
}
#data-backup .two-opt{
   display: flex;
   align-items: center;
}
#data-backup .two-opt .opt-2 .det-btn,
#data-backup .two-opt .opt-1 .det-btn{
 display: flex;
}
#data-backup .two-opt .opt-2 .det-btn button,
#data-backup .two-opt .opt-1 .det-btn button{
   padding: .3rem .5rem;
   color: var(--white);
   border-radius: 5px;
   margin: .3rem;
   cursor: pointer;
}
#data-backup .two-opt .opt-2 .det-btn button:hover,
#data-backup .two-opt .opt-1 .det-btn button:hover{
opacity: .7;
}
#data-backup .two-opt .opt-2 .det-btn .btn-opt-1,
#data-backup .two-opt .opt-1 .det-btn .btn-opt-1{
   background: var(--green);
}
#data-backup .two-opt .opt-2 .det-btn .btn-opt-2,
#data-backup .two-opt .opt-1 .det-btn .btn-opt-2{
   background: var(--navyBlue);
   
}

#data-backup .two-opt .opt-2{
  margin-left: 1rem;
  }
  #online-data-backup-card,
  #ofline-data-backup-card{
   background: rgba(65,105,255, 0.3);
   padding: 1rem;
   position: fixed;
   top: 0;
   bottom: 0;
   left: 0;
   right: 0;
   z-index: 99999;
   margin: auto;
   display: none;
  }
  #Online-backup-card,
  #Offline-backup-card,
  #Security-card,
  #update-biz-profile-card,
  #add-biz-profile-card,
  #update-passkey-card,
  #update-profile-card{
  background: rgba(65,105,255, 0.3);
  padding: 1rem;
  position: fixed;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
  z-index: 99999;
  margin: auto;
  display: none;
  }
  #Online-backup-card.active,
  #Offline-backup-card.active,
  #Security-card.active,
  #update-biz-profile-card.active,
  #add-biz-profile-card.active,
  #update-passkey-card.active,
  #update-profile-card.active{
  display: initial;
  }
  #Online-backup-card .field-form,
  #Offline-backup-card .field-form{
   width: 50%;
   background-color: var(--navyBlue);
   margin: 0 auto;
   padding: .1rem;
   border-radius: 10px;
  }
  #online-data-backup-card .field-form,
  #ofline-data-backup-card .field-form{
   position: absolute;
   left: 0;
   right: 0;
   top: 0;
   bottom: 0;
   height: fit-content; 
   width: 200px;
   background-color: var(--white);
   margin: auto;
   padding: .1rem;
   border-radius: 10px;
  }
  #Security-card .field-form,
  #update-biz-profile-card .field-form,
  #add-biz-profile-card .field-form,
  #update-passkey-card .field-form,
  #update-profile-card .field-form{
  width: 50%;
  background-color: var(--white);
  margin: 0 auto;
  padding: .1rem;
  border-radius: 10px;
  }
  #Online-backup-card .field-form #canel-field-form,
  #Offline-backup-card .field-form #canel-field-form,
  #Security-card .field-form #canel-field-form,
  #update-biz-profile-card .field-form #canel-field-form,
  #add-biz-profile-card .field-form #canel-field-form,
  #update-passkey-card .field-form #canel-field-form,
  #update-profile-card .field-form #canel-field-form{
  float: right;
  padding: .6rem;
  border-radius: 10px;
  }
  #Online-backup-card .field-form #canel-field-form:hover,
  #Offline-backup-card .field-form #canel-field-form:hover,
  #Security-card .field-form #canel-field-form:hover,
  #update-biz-profile-card .field-form #canel-field-form:hover,
  #add-biz-profile-card .field-form #canel-field-form:hover,
  #update-passkey-card .field-form #canel-field-form:hover,
  #update-profile-card .field-form #canel-field-form:hover{
    background: var(--border-color);
  }
  #Online-backup-card .field-form h2,
  #Offline-backup-card .field-form h2,
  #Security-card .field-form h2,
  #update-biz-profile-card .field-form h2,
  #add-biz-profile-card .field-form h2,
  #update-passkey-card .field-form h2,
  #update-profile-card .field-form h2{
  margin-top: 1rem;
    color: var(--main-color);
    text-align: center;
  }
  #Online-backup-card .field-form .main-container,
  #Offline-backup-card .field-form .main-container,
  #Security-card .field-form .main-container,
  #update-biz-profile-card .field-form .main-container,
  #add-biz-profile-card .field-form .main-container,
  #update-passkey-card .field-form .main-container,
  #update-profile-card .field-form .main-container{
  width: 100%;
  overflow-y: auto;
  max-height: 550px;
  padding: 1rem;
  }
  #online-data-backup-card .field-form .main-container .loader-img img,
  #ofline-data-backup-card .field-form .main-container .loader-img img{
   width: 70px;
   display: block;
   margin: 0 auto;
  }

  .field-form .input-wrapper{
   display: flex;
   flex-direction: column;
   margin: 0 auto;
   margin-top: 10px;
   width: 100%;
 }
 .field-form .input-wrapper select,
 .field-form .input-wrapper input{
     padding: .2rem;
     border: 1px solid var(--text-grey);
     width: 100%;
     height: 100%;
     font-size: 1.2rem;
     border-radius: 5px;
     background: var(--light-bg-color);
     color: var(--green);
 }
 .field-form .input-wrapper label{
 font-size: 1.2rem;
 color: var(--color-dark);
 }
 .btn-wrapper {
 margin-top: 10px;
 display: flex;
 align-items: center;
 justify-content: center;
 }
 .btn-wrapper button{
 padding: .5rem 1rem;
 color: var(--white);
 border-radius: 5px;
 }
 .btn-save-update{
 background: var(--green);
 }

 .message-dis{
   display: none;
   align-items: center;
   justify-content: space-between;
   box-shadow: 0px 0px 15px var(--green);
   border-radius: 5px;
   margin: 0 auto;
   width: 90%;
   padding: .2rem;
   margin-bottom: 5px;
   }
   .message-dis.active{
     display: none;
     }
     .message-dis p{
       color: var(--green);
       font-size: 1.2rem;
     }
     .message-dis label i{
     font-size: 1.2rem;
     color: var(--green);
     }
        
     .message-dis-err{
         display: none;
         align-items: center;
         justify-content: space-between;
         box-shadow: 0px 0px 15px crimson;
         border-radius: 5px;
         margin: 0 auto;
         width: 90%;
         padding: .2rem;
         margin-bottom: 5px;
         }
         .message-dis-err.active{
             display: none;
             }
             .message-dis-err p{
               color: crimson;
               font-size: 1.2rem;
             }
             .message-dis-err label i{
             font-size: 1.2rem;
             color: crimson;
             }


             /* backup det style */
  .backup-det-cont p{
   color: var(--white);
  }
 #quiz{
   color: var(--white);
   font-size: 1.4rem;
   background: var(--navyBlue);
   padding: .3rem;
 }


  @media(max-width: 720px){

   #profile-sec{
  flex-direction: column;
   }

   #profile-sec .user-pro{
       width: 100%;
   }

   #profile-sec .facility-pro{

       width: 100%;
       margin-top: 10px;
   }

   #data-backup .two-opt{
    flex-direction: column;
    align-items: flex-start;

    }
    #data-backup .two-opt .opt-2{
       margin-left: 0rem;
       }

  }
      </style>
        <script src="resources/CDN-links/jquery.min.js"></script>
    </head>
<body>


    <section id="update-profile-card">
        <div class="field-form">
        <div id="canel-field-form"><i class="fa-solid fa-times"></i></div>
        <h2>Update Profile</h2>

        <div class="message-dis">
            <p></p>
            <label onclick="removeMessage()"><i class="fa-solid fa-times-square"></i></label>
          </div>
      
          <div class="message-dis-err">
            <p></p>
            <label onclick="removeMessage()"><i class="fa-solid fa-times-square"></i></label>
          </div>
        <div class="main-container">
      
        </div>
        </div>
        </section>



        <section id="update-biz-profile-card">
            <div class="field-form">
            <div id="canel-field-form"><i class="fa-solid fa-times"></i></div>
            <h2>Update Facility Profile</h2>
            <div class="message-dis">
                <p></p>
                <label onclick="removeMessage1()"><i class="fa-solid fa-times-square"></i></label>
              </div>
          
              <div class="message-dis-err">
                <p></p>
                <label onclick="removeMessage1()"><i class="fa-solid fa-times-square"></i></label>
              </div>
            <div class="main-container">
    
      
            </div>
            </div>
            </section>
            

            <section id="update-passkey-card">
                <div class="field-form">
                <div id="canel-field-form"><i class="fa-solid fa-times"></i></div>
                <h2>Change Password</h2>
                <div class="message-dis">
                    <p></p>
                    <label onclick="removeMessage3()"><i class="fa-solid fa-times-square"></i></label>
                  </div>
              
                  <div class="message-dis-err">
                    <p></p>
                    <label onclick="removeMessage3()"><i class="fa-solid fa-times-square"></i></label>
                  </div>
                <div class="main-container">
                 <form action="#" method="post">
                  <div class="input-wrapper">
                    <label>Old Password*</label>
                    <input type="password" name="text_old" placeholder="please enter Old password...">
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
                    <button class="btn-save-update" onclick="UpdatePassKey()">Save</button>
                   </div>
                </form>
                </div>
                </div>
                </section>

            <section id="add-biz-profile-card">
                <div class="field-form">
                <div id="canel-field-form"><i class="fa-solid fa-times"></i></div>
                <h2>Add Facility Profile</h2>
                <div class="message-dis">
                    <p></p>
                    <label onclick="removeMessage2()"><i class="fa-solid fa-times-square"></i></label>
                  </div>
              
                  <div class="message-dis-err">
                    <p></p>
                    <label onclick="removeMessage2()"><i class="fa-solid fa-times-square"></i></label>
                  </div>
                <div class="main-container">
                 <form action="#" method="post">
                 <div class="input-wrapper">
    <label>Facility Name *</label>
    <input type="text" name="text_name" placeholder="please enter facility name...">
   </div>

   <div class="input-wrapper">
    <label>Email*</label>
    <input type="text" name="text_mail" placeholder="please enter email...">
   </div>

   <div class="input-wrapper">
    <label>Contact *</label>
    <input type="text" name="text_contact" placeholder="please enter contact details...">
   </div>

   <div class="input-wrapper">
    <label>Address *</label>
    <input type="text" name="text_address" placeholder="please enter address...">
   </div>


  <div class="btn-wrapper">
   <button class="btn-save-update" onclick="AddFacilityProfile();">Save</button>
   </div>
               </form>
                </div>
                </div>
                </section>

                <section id="Offline-backup-card">
                    <div class="field-form">
                    <div id="canel-field-form"><i class="fa-solid fa-times"></i></div>
                    <h2>Backup Details</h2>
                    
                    <div class="main-container">
                        <div class="backup-det-cont">
                       <p>
                     The offline Database Backup make copies of your database to the local machine. 
                     This Data redundancy Prevents Data loss in Case of System Failure Or any Other Software Malware.
                     The Backup is done automatically by the system at interval of 30 days By default.
                     This Can also be done by clicking the Backup Button.
                       </p>
                        </div>
                    </div>
                    </div>
                    </section>


                    <section id="Online-backup-card">
                        <div class="field-form">
                        <div id="canel-field-form"><i class="fa-solid fa-times"></i></div>
                        <h2>Backup Details</h2>
                        
                        <div class="main-container">
                            <div class="backup-det-cont">
                           <p>
                         The online Database Backup make copies of your database to the online Server through the internet. 
                         This Data redundancy Prevents Data loss in Case of System Failure Or any Other Software Malware.
                         The Backup is done automatically by the system at interval of 30 days by Default.
                         This Can also be done by clicking the Backup Button.
                         This Service updates An online database.
                         The service is not activated yet but it will be soon, Contact Developer for more info.
                           </p>
                            </div>
                        </div>
                        </div>
                        </section>







                <section id="Security-card">
                    <div class="field-form">
                    <div id="canel-field-form"><i class="fa-solid fa-times"></i></div>
                    <h2>Security Question</h2>
                    <div class="message-dis">
                        <p>Patient add successfully</p>
                        <label><i class="fa-solid fa-times-square"></i></label>
                      </div>
                  
                      <div class="message-dis-err">
                        <p>Patient add falied</p>
                        <label><i class="fa-solid fa-times-square"></i></label>
                      </div>
                    <div class="main-container">



                        <div class="input-wrapper">
                            <label>National Id*</label>
                            <input type="text" name="text_nid" placeholder="please enter national id...">
                           </div>

                        <div class="input-wrapper">
                            <!-- <label>What's your favorite meal</label> -->
                            <p id="quiz">What's your favorite meal</p>
                           </div>
            
                       <div class="input-wrapper">
                        <label>Answer*</label>
                        <input type="text" name="text_answer" placeholder="please enter an answer for security question...">
                       </div>
              
        
                     
                       <div class="btn-wrapper">
                        <button class="btn-save-update">Submit</button>
                       </div>
              
                    </div>
                    </div>
                    </section>

                        
                    <section id="ofline-data-backup-card">
                      <div class="field-form">
                      <p>Offline Backup in progress...</p>
                      <div class="message-dis">
                          <p></p>
                        </div>
                    
                        <div class="message-dis-err">
                          <p></p>
                        </div>
                      <div class="main-container">
                        <div class="loader-img">
                          <img src="resources/img/loader.gif" alt="Loading...">
                        </div>
                      </div>
                      </div>
                      </section>


                      <section id="online-data-backup-card">
                        <div class="field-form">
                        <p>Online Backup in progress...</p>
                        <div class="message-dis">
                            <p></p>
                          </div>
                      
                          <div class="message-dis-err">
                            <p></p>
                          </div>
                        <div class="main-container">
                          <div class="loader-img">
                            <img src="resources/img/loader.gif" alt="Loading...">
                          </div>
                        </div>
                        </div>
                        </section>



    <section id="loader">
        <div class="loader-img">
          <img src="resources/img/loaderr.gif" alt="Loading...">
        </div>
    </section>

    <main>

        <section id="upper-nav">
            <div class="upper-left">
            <label>
                <i class="fa-solid fa-bars" id="add"></i>

                <i class="fa-solid fa-bars" id="rem"></i>
               <h2>Manange Settings</h2>
            </label>
            </div>
            <div class="upper-right">
            <!-- <a href="report.html"><i class="fa-solid fa-clipboard-list"></i>Today's Visits</a> -->
          
            <div class="notify">
              <i class="fa-solid fa-bell" id="bell"></i>
              <i class="fa-solid fa-circle" id="circle"></i>
                </div>
           
                <div class="user-acc">
                  <div class="avatar">
                   <i class="fa-solid fa-user" id="user"></i>
                   <i class="fa-solid fa-circle" id="circle"></i>
                     </div>
                     <div class="user-name">
                     <p><strong><?php echo $role; ?></strong></p>
                    <p><small><?php echo $adminName; ?></small></p> 
                     </div>
                   </div> 
          
            </div>
              </section>

              <section id="side-bar-menu">
                <div class="biz-brand">
                <?php 
                 $select_name = mysqli_query($conn, "SELECT name FROM facility_data LIMIT 1");
                 if(mysqli_num_rows($select_name) > 0){
                  $fname = mysqli_fetch_assoc($select_name);
                  $facility = $fname["name"];
                  if(!empty($facility)){
                  ?>
                 <h2><?php  echo $facility; ?></h2>
                  <?php 
                  }else{
                  ?>
                <h2>Medivina Medical</h2>
                  <?php 
                  }
                  ?>
                 <?php 
                 }else{
                 ?>
               <h2>Medivina Medical</h2>   
                 <?php
                 }
                 ?>
                </div>
              
                <div id="menu-ntro">
              <label><strong>Main menu</strong></label>
                </div> 
  
                <div class="main-menu">
                    <div class="first-sub">
                        <ul>
                        <li><a href="index.php"><i class="fa-solid fa-dashboard"></i><span>Dashboard</span></a></li>
                            <li><a href="patient.php"><i class="fa-solid fa-hospital-user"></i><span>Patient</span></a></li> 
                            <?php
                            if($session_role == "admin" || $session_role == "doctor" || $session_role == "nurse"){
                            ?>
                            <li><a href="doctor.php"><i class="fa-solid fa-user-nurse"></i><span>Doctor</span></a></li>
                            <?php
                            }else{
                            ?>
                            <li><a href="" onclick="alert('Sorry Seems You do not have rights to access This page')"><i class="fa-solid fa-user-nurse"></i><span>Doctor</span></a></li>
                             <?php
                            }
                            ?>
                            <?php
                            if($session_role == "admin" || $session_role == "doctor" || $session_role == "nurse" || $session_role == "Lab Tech"){
                            ?>
                           <li><a href="laboratory.php"><i class="fa-solid fa-house-medical"></i><span>Laboratory</span></a></li>           
                            <?php
                            }else{
                            ?>
                            <li><a href="" onclick="alert('Sorry Seems You do not have rights to access This page')"><i class="fa-solid fa-house-medical"></i><span>Laboratory</span></a></li>
                             <?php
                            } 
                            ?>
                            <?php
                             if($session_role == "admin"){
                              ?>
                              <li><a href="managereasource.php"><i class="fa-solid fa-people-group"></i><span>Hospital Resources</span></a></li>
                             <?php
                             }else{
                              ?>
                             <li><a href="" onclick="alert('Sorry Seems You do not have rights to access This page')"><i class="fa-solid fa-people-group"></i><span>Hospital Resources</span></a></li>
                             <?php
                             }
                             ?>     
                            <li><a href="report.php"><i class="fa-solid fa-file"></i><span>Report</span></a></li>
                            <li><a href="billing.php"><i class="fa-solid fa-clipboard-list"></i><span>Billing & Payments</span></a></li>
                            <li><a href=""><i class="fa-solid fa-money-bills"></i><span>Accounts</span></a></li>     
                            <li><a href=""><i class="fa-solid fa-comment-sms"></i><span>Messages</span></a></li>
                            <li><a href=""><i class="fa-solid fa-user-cog"></i><span>Help</span></a></li>
                          </ul>
                    </div>

                    <div class="second-sub">
                        <ul>
                        <li><a onclick="if (confirm('Are you Sure you Want to Log out?')) { logoutDet(); }" href="" id="log"><i class="fa-solid fa-arrow-left"></i><span>Logout</span></a></li>
                          <li><a href="setting.php" id="set"><i class="fa-solid fa-gears"></i><span>Settings</span></a></li>     
                          <li><a href="" id="abt"><i class="fa-solid fa-info-circle"></i><span>About Software</span></a></li>
                          </ul>
                    </div>

                </div>

        
            </section>



            <section id="main-content">


           <section id="profile-sec">
             <div class="user-pro">
              <div class="icon-header">
                <i class="fa-solid fa-user"></i>
                <h3>User Profile</h3>
              </div>

              <div class="list-det">
              </div>
             </div>

             <div class="facility-pro">
                <div class="icon-header">
                    <i class="fa-solid fa-hospital"></i>
                    <h3>Facility Profile</h3>
                  </div>

                  <div class="list-det">
                    </div>
                  </div>
             </div>
           </section>


           <section class="security-quiz">

           </section>
          
           <section id="data-backup">
            <div class="header-sec">
                <i class="fa-solid fa-database"></i>
                <h3>Database Backup</h3>
            </div>

            <div class="two-opt">
                <div class="opt-1">
                <label><i class="fa-solid fa-home-lg"></i>Local Backup</label>
                <div class="det-btn">
                    <button class="btn-opt-1" onclick="if (confirm('Are you Sure you Want to Backup Now?')) { UpdateOfflineData(); }">Backup Now</button>
                    <button class="btn-opt-2">View Info</button>
                </div>
                </div>
                
                <div class="opt-2">
                    <label><i class="fa-solid fa-globe"></i>Online Backup</label>
                    <div class="det-btn">
                        <button class="btn-opt-1" onclick="if (confirm('Are you Sure you Want to Backup Now?')) { UpdateOnlineData(); }">Backup Now</button>
                        <button class="btn-opt-2">View Info</button>
                    </div>
                </div>
            </div>
           </section>

    
          </section>






    </main>
   
    <script>
     $('.upper-left label #add').click(function(){
    $('#side-bar-menu').addClass('active')
    $('#side-bar-menu .main-menu ul li a span').addClass('active')
    $('#side-bar-menu .main-menu .second-sub ul li a span').addClass('active')
    $('#side-bar-menu .main-menu ul li').addClass('active')

    $('#add').addClass('active')
    $('#upper-nav').addClass('active')
    $('#rem').addClass('active')
    $('#main-content').addClass('active')
    });
    

    $('.upper-left label #rem').click(function(){
    $('#side-bar-menu').removeClass('active')
    $('#side-bar-menu .main-menu ul li a span').removeClass('active')
    $('#side-bar-menu .main-menu .second-sub ul li a span').removeClass('active')
    $('#side-bar-menu .main-menu ul li').removeClass('active')
    $('#add').removeClass('active')
    $('#rem').removeClass('active')
    $('#upper-nav').removeClass('active')
    $('#main-content').removeClass('active')
    });

    function showEditProfile(){

        $('#update-profile-card').addClass('active')
    
        $('#update-profile-card .field-form #canel-field-form').click(function(){
        $('#update-profile-card').removeClass('active')
        });
    }


    function editfacilitycont(){
        $('#update-biz-profile-card').addClass('active')
    
        $('#update-biz-profile-card .field-form #canel-field-form').click(function(){
        $('#update-biz-profile-card').removeClass('active')
        });
    }


 function addfacilitycont(){
        $('#add-biz-profile-card').addClass('active')
     
        $('#add-biz-profile-card .field-form #canel-field-form').click(function(){
        $('#add-biz-profile-card').removeClass('active')
        });
 }


 
        function ChangePassCont(){
        $('#update-passkey-card').addClass('active')
    
        $('#update-passkey-card .field-form #canel-field-form').click(function(){
        $('#update-passkey-card').removeClass('active')
        });
        }



        // $('#data-backup .two-opt .opt-1 .det-btn .btn-opt-1').click(function(){
        // $('#Security-card').addClass('active')
        // });
    
        // $('#Security-card .field-form #canel-field-form').click(function(){
        // $('#Security-card').removeClass('active')
        // });


        $('#data-backup .two-opt .opt-1 .det-btn .btn-opt-2').click(function(){
        $('#Offline-backup-card').addClass('active')
        });
    
        $('#Offline-backup-card .field-form #canel-field-form').click(function(){
        $('#Offline-backup-card').removeClass('active')
        });

        $('#data-backup .two-opt .opt-2 .det-btn .btn-opt-2').click(function(){
        $('#Online-backup-card').addClass('active')
        });
    
        $('#Online-backup-card .field-form #canel-field-form').click(function(){
        $('#Online-backup-card').removeClass('active')
        });

        

        $('.message-dis-err label').click(function(){
        $('.message-dis-err').addClass('active')
        });

        $('.message-dis label').click(function(){
        $('.message-dis').addClass('active')
        });

    </script>

<script type="text/javascript" src="settingJS.js"></script>
<script type="text/javascript">

  function removeMessage(){
    const  messagecont = document.querySelector("#update-profile-card .field-form .message-dis"),
           messageconterr= document.querySelector("#update-profile-card .field-form .message-dis-err");

        messagecont.style.display="none";
        messageconterr.style.display="none";
  }

  function removeMessage1(){
    const  messagecont = document.querySelector("#update-biz-profile-card .field-form .message-dis"),
           messageconterr= document.querySelector("#update-biz-profile-card .field-form .message-dis-err");

        messagecont.style.display="none";
        messageconterr.style.display="none";
  }

  function removeMessage2(){
    const  messagecont = document.querySelector("#add-biz-profile-card .field-form .message-dis"),
           messageconterr= document.querySelector("#add-biz-profile-card .field-form .message-dis-err");

        messagecont.style.display="none";
        messageconterr.style.display="none";
  }


  function removeMessage3(){
    const  messagecont = document.querySelector("#update-passkey-card .field-form .message-dis"),
           messageconterr= document.querySelector("#update-passkey-card .field-form .message-dis-err");

        messagecont.style.display="none";
        messageconterr.style.display="none";
  }

window.onload = function() {
  // Call your method here
  ShowStaffProfile();
  ShowfacilityProfile();
  changesecurityDetFields();
  checkBackupCookiesExpired();
};

function clearField(){
    var fieldText = document.getElementById('ansQuiz');
    fieldText.value ="";
  }







          // Function to check if cookies have expired and backupdata
          function checkBackupCookiesExpired() {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.open("GET", "checkifofflineSet.php", true);

            xmlhttp.onreadystatechange = function () {
                if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
                    var response = xmlhttp.responseText;
                    if (response === "expired") {
                        UpdateOfflineData();

                    }
                }
            };

            xmlhttp.send();
        }


 
        // Function to check if cookies have expired and redirect to login
        function checkCookiesExpired() {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.open("GET", "checkiflogin.php", true);

            xmlhttp.onreadystatechange = function () {
                if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
                    var response = xmlhttp.responseText;
                    if (response === "expired") {
                        // Cookies expired, redirect to login
                        window.location.href = "Login.php";
                    }
                }
            };

            xmlhttp.send();
        } 
   
        // Check cookies expiration every 500ms
        setInterval(checkCookiesExpired, 500);

         

</script>
<script type="text/javascript" src="DataBackJs.js"></script>
<script type="text/javascript" src="logoutJS.js"></script>   
</body>
</html>