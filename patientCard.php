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
        <link rel="stylesheet" href="patientCardstyle.css">
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
  
   --color-dark: #1D2231;
   --text-grey: #8390A2;
   --coolor: #6ea1e9;
   --blueViolet: blueviolet;
   --beautiful: #6e25f5;
   /* color: rgb(9, 240, 163) */
 } 
    
 
 .main-patient-card{
   background: var(--white);
   border-radius: 10px;
   display: flex;
   flex-direction: row;
   }
   .main-patient-card .left-card{
       background: var(--main-color);
       /* background: var(--beautiful); */
       /* background: linear-gradient(to right, var(--beautiful) 6%, var(--coolor) 50%, crimson 100%); */
       border-radius: 10px;
       padding: .2rem;
       width: 40%;
       }
       .main-patient-card .right-card{
           border-radius: 10px;
           padding: .2rem;
           width: 60%;
           }
           #avatar-name-age{
               display: flex;
              flex-wrap: wrap;
               align-items: flex-start;
       
           }
           #avatar-name-age img{
               width: 50px;
               border-radius: 10px;
               border: 1px solid var(--white);
               margin-right: 1rem;
           }
           #avatar-name-age label{
           
             color: var(--white); 
            
           }
           #avatar-name-age label p{
          padding: 0.1rem;
             }
             #gender{
               color: chartreuse;
               padding-left: .5rem;
             }
             #height-weight-blood{
               display: flex;
               justify-content: space-between;
               flex-wrap: wrap;
               align-items: flex-start;
               padding-top: 1rem;
           }
           #height-weight-blood label{
               color: var(--white);
               padding: 0.5rem;
           } 
 
           #other-det{
               box-sizing: border-box;
            }
            #other-det .other-det-container{
            display: flex;
            flex-direction: row;
            }
            #other-det .other-det-container small{
                color: var(--text-grey);
            }
            #other-det .other-det-container p{
                color: var(--color-dark);
            }
            #other-det .other-det-container label{
           width: 50%;
            }
 
            .patient-btn-opps{
               display: flex;
               flex-wrap: wrap;
               justify-content: space-between;
               background: var(--white);
               margin-top: 10px;
               padding: .5rem;
               border-radius: 5px;
            }
 
            .patient-btn-opps button{
               padding: .2rem .4rem;
               color: var(--white);
               border-radius: 2px;
               margin: .5rem;
               cursor: pointer;
            }
            .patient-btn-opps button:hover{
               opacity: .7;
            }
            #btn1{
               background: var(--beautiful);
            }
            #btn2{
               background: var(--main-color);
            }
            #btn3{
               background: var(--main-color);
            }
            #btn4{
               background: var(--main-color);
            }
 
 
 
 
            /* table display */
            
           #sys{
               margin-top: 10px;
               }
               #sys h2{
               color: var(--coolor);
               }
                   
               #outer-table{
                 background: var(--white);
                 padding: .3rem;
                 margin: 0 auto;
                 width: 100%;
                 margin-top: 10px;
               
               }
               #outer-table .table-container{
               width: 100%;
               overflow-x: auto;
               max-height: 700px;
               overflow-y: auto;
               
               }
               .main-container-table{
                 border-collapse: collapse;
                 width: 100%;
                 margin-bottom: 20px;
                 min-width: 700px;
               }
               #head-det{
                 display: flex;
                flex-direction: row;
                color: #6e25f5;
               }
  
               .body-det{
                 display: flex;
                 flex-direction: row; 
                 cursor: pointer;
                 color: var(--color-dark);
               }
               .body-det:hover{
                 background: rgba(65,105,255, 0.2); 
               }
               .body-det .bdy{
                 border: 1px solid var(--border-color);
                 margin-top: -1px;
                 margin-right: -1px;
               }
 
                 .head-1{
                   width: 10%;
                  
                  }
                  .head-2{
                   width: 20%;
                  }
                  .head-3{
                   width: 20%;
                  }
                  .head-4{
                   width: 15%;
                  }
                  .head-5{
                   width: 15%;
                  }
                  .head-6{
                  width: 20%;
                  }
 
 
 
 
 
                 .match-1{
                   width: 10%;
                   padding: .2rem;
                   font-size: .9rem;
                  }
                  .match-2{
                   width: 20%;
                   padding: .2rem;
                   font-size: .9rem;
                  }
                  .match-3{
                   width: 20%;
                   padding: .2rem;
                   font-size: .9rem;
                  }
                  .match-4{
                   width: 15%;
                   padding: .2rem;
                   font-size: .9rem;
                  }
                  .match-5{
                   width: 15%;
                   padding: .2rem;
                   font-size: .9rem;
                  }
                  .match-6{
                   width: 20%;
                   padding: .2rem;
                   font-size: .9rem;
                  }
 
                 
                 .match-1 p, 
                 .match-3 p,
                 .match-4 p,
                 .match-5 p,
                 .match-6 p,
                 .match-7 p,
                 .match-8 p{
                   text-overflow: ellipsis;
                   white-space: nowrap;
                   overflow: hidden;
                 }
                 .match-2 p{
                   overflow: hidden;
                   display: -webkit-box;
                   -webkit-box-orient: vertical;
                   -webkit-line-clamp: 2;
                   white-space: pre-wrap;
                  
                 }
                 #no-det h3{
                   color: crimson;
                   text-align: center;
                   padding: .5rem;
                   }
 
                   /* top nav additional */
      .upper-right .appointment-hist{
       margin-right: .5rem;
       position: relative;
       width: 100%;
      }
      .upper-right .appointment-hist label{
       color: var(--main-color);
       cursor: pointer;
       padding: .2rem;
      }
      .upper-right .appointment-hist .list-hit-apt{
       background: var(--white);
       border: 1px solid var(--color-dark);
       border-radius: 5px;
       position: absolute;
       width: 100%;
       padding: .2rem;
       max-height: 300px;
       overflow-y: auto;
       overflow-x: hidden;
       display: none;
      }
      .single-list{
    display: flex;
    justify-content: space-between;
     margin-top: .3rem;
     cursor: pointer;
     }
     .single-list:hover{
       background: var(--light-bg-color);
     }
     .upper-right .appointment-hist .list-hit-apt.visible{
       display: block;
     }
     /* @end */
 
 
 
     /* pop ups */
     #Add-pat-appointment-card,
     #Add-pat-visit-card,
     #Edit-pat-card{
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
     #Add-pat-appointment-card.active,
     #Add-pat-visit-card.active,
     #Edit-pat-card.active{
       display: initial;
     }
     #Add-pat-appointment-card .field-form,
     #Add-pat-visit-card .field-form,
     #Edit-pat-card .field-form{
       width: 50%;
       background-color: var(--white);
       margin: 0 auto;
       padding: .1rem;
       border-radius: 10px;
     }
     #Add-pat-appointment-card .field-form #canel-field-form,
     #Add-pat-visit-card .field-form #canel-field-form,
     #Edit-pat-card .field-form #canel-field-form{
       float: right;
       padding: .6rem;
       border-radius: 10px;
     }
     #Add-pat-appointment-card .field-form #canel-field-form:hover,
     #Add-pat-visit-card .field-form #canel-field-form:hover,
     #Edit-pat-card .field-form #canel-field-form:hover{
         background: var(--border-color);
     }
     #Add-pat-appointment-card .field-form h2,
     #Add-pat-visit-card .field-form h2,
     #Edit-pat-card .field-form h2{
       margin-top: 1rem;
         color: var(--main-color);
         text-align: center;
     }
     #Add-pat-appointment-card .field-form .main-container,
     #Add-pat-visit-card .field-form .main-container,
     #Edit-pat-card .field-form .main-container{
      width: 100%;
      overflow-y: auto;
      max-height: 550px;
      padding: 1rem;
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
           font-size: 1rem;
           /* border-radius: px; */
           color: var(--green);
     }
     .field-form .input-wrapper label{
       font-size: 1rem;
       color: var(--main-color);
     }
     .btn-wrapper {
     margin-top: 10px;
     display: flex;
     align-items: center;
     justify-content: center;
     }
     .btn-wrapper .save-btn{
     padding: .5rem 1rem;
     color: var(--white);
     background: var(--main-color);
     border-radius: 5px;
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
     
     /* @ends */
 
            @media(max-width: 920px){
               #other-det .other-det-container{
                   flex-direction: column;
                   }
                   #other-det .other-det-container label{
                     
                       width: 100%;
                      
                        }
            
                       .main-patient-card{
                           flex-direction: column;
                           }
                          .main-patient-card .left-card{
                               width: 100%;
                               }
                              .main-patient-card .right-card{
                       
                                   width: 100%;
                                   }
                                   .upper-right .appointment-hist{
                                       display: none;
                                   }
                                   
            }
</style>
        <script src="resources/CDN-links/jquery.min.js"></script>
    </head>
<body> 
 
  <section id="Edit-pat-card">
    <div class="field-form">
    <div id="canel-field-form"><i class="fa-solid fa-times"></i></div>
    <h2>Update Patient Details</h2>
    <div class="message-dis">
      <p></p>
      <label onclick="remMessage();"><i class="fa-solid fa-times-square"></i></label>
    </div>

    <div class="message-dis-err">
      <p></p>
      <label onclick="remMessage();"><i class="fa-solid fa-times-square"></i></label>
    </div>

    <div class="main-container">
   
    </div>
    </div>
    </section>


    <section id="Add-pat-visit-card">
      <div class="field-form">
      <div id="canel-field-form" onclick="remMessage1();"><i class="fa-solid fa-times"></i></div>
      <h2>Add Patient Visit</h2>
      <div class="message-dis">
        <p>Patient add successfully</p>
        <label onclick="remMessage1();"><i class="fa-solid fa-times-square"></i></label>
      </div>
  
      <div class="message-dis-err">
        <p>Patient add falied</p>
        <label onclick="remMessage1();" ><i class="fa-solid fa-times-square"></i></label>
      </div>
  
      <div class="main-container">
      <form action="#" method="post">

  
         <div class="input-wrapper">
          <label>Visit Reason *</label>
          <select name="text_reason">
            <option value="">--Select Reason--</option>
            <option value="Illness or Disease">Illness or Disease</option>
             <option value="Injury or Accident">Injury or Accident</option>
             <option value="Routine Check-ups">Routine Check-ups</option>
             <option value="Chronic Condition Management">Chronic Condition Management</option>
             <option value="Surgery or Procedures">Surgery or Procedures</option>
             <option value="Maternity and Obstetrics">Maternity and Obstetrics</option>
             <option value="Emergency Care">Emergency Care</option>
             <option value="Specialist Consultation">Specialist Consultation</option>
             <option value="Mental Health Concerns">Mental Health Concerns</option>
             <option value="Diagnostic Testing">Diagnostic Testing</option>
             <option value="Rehabilitation">Rehabilitation</option>
             <option value="Palliative Care and End-of-Life Care">Palliative Care and End-of-Life Care</option>
             <option value="Other">Other</option>
          </select>
         </div> 
         

         <?php
       $selcect_dept_data = mysqli_query($conn, "SELECT * FROM department_data");
         ?>
               <div class="input-wrapper">
                <label>Department</label>
                <select name="text_dep">
                <option value="">--Select Department--</option>
                  <?php 
           if(mysqli_num_rows($selcect_dept_data) > 0){
             while($row = mysqli_fetch_assoc($selcect_dept_data)){
                  ?>
              
              <option value="<?php echo $row["dept_name"]; ?>"><?php echo $row["dept_name"]; ?></option>
              <?php
            }
           }else{
            ?>
            <option value="">--Department Not Added--</option>
            <?php 
            }
         ?>
                </select>
               </div>

         <div class="input-wrapper">
          <label>Visit Type</label>
          <select name="text_vtype">
        <option value="out patient">out patient</option>
        <option value="in patient">in patient</option>
          </select>
         </div>

         <div class="input-wrapper">
          <label>Visit Status</label>
          <select name="text_vstatus">
          <option value="">--select Emergency or non-emergency--</option>
        <option value="Non Emergency">Non-Emergency</option>
        <option value="Emergency">Emergency</option>
          </select>
         </div>
  
         <div class="btn-wrapper">
          <button class="save-btn" onclick="AddNewPatientVisit();"><i class="fa-solid fa-plus"></i>Add Visit</button>
         </div>
        </form>
      </div>
      </div>
      </section>


      <section id="Add-pat-appointment-card">
                        <div class="field-form">
                        <div id="canel-field-form"><i class="fa-solid fa-times"></i></div>
                        <h2>Add Appointment</h2>
                        <div class="message-dis">
                          <p></p>
                          <label onclick="remMessage7()"><i class="fa-solid fa-times-square"></i></label>
                        </div>
                    
                        <div class="message-dis-err">
                          <p></p>
                          <label onclick="remMessage7()"><i class="fa-solid fa-times-square"></i></label>
                        </div>
                    
                        <div class="main-container">
                        <form action="#" method="post">
                            <div class="input-wrapper">
                                <label>Appointment Date *</label>
                               <input type="date" name="text_AppDate" placeholder="Please enter Date">
                               </div>    
    
                               <div class="input-wrapper">
                                <label>Start Time *</label>
                               <input type="time" name="text_Stime" placeholder="Please enter Start Time">
                               </div>
    
    
                               <div class="input-wrapper">
                                <label>Finish Time*</label>
                               <input type="time" name="text_Ftime" placeholder="Please enter Finish time">
                               </div>
         
    
                            <div class="input-wrapper">
                                <label>Appointment Reason *</label>
                               <input type="text" name="text_appReason" placeholder="Please enter appointment reason">
                            </div>
    
    
                           <div class="btn-wrapper">
                            <button class="save-btn" onclick="AddApointMent()"><i class="fa-solid fa-plus"></i>Add Appointment</button>
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

        <section id="upper-nav">
            <div class="upper-left">
            <label>
                <i class="fa-solid fa-bars" id="add"></i>

                <i class="fa-solid fa-bars" id="rem"></i>
               <h2>patient's Card</h2>
            </label>
            </div>
            <div class="upper-right">
            <!-- <a href="report.html"><i class="fa-solid fa-clipboard-list"></i>Today's Visits</a> -->
              <div class="appointment-hist">
              <label><strong>Appointment History</strong><i class="fa-solid fa-angle-down"></i></label>
              <div class="list-hit-apt">
              <div class="single-list">
                <p>0000-00-00</p>
                <p><i class="fa-solid fa-info-circle"></i></p>
              </div>
             
              <h4>No data To show...</h4>
              </div>
              </div>
          
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
                            <li><a href="patient.php" class="active"><i class="fa-solid fa-hospital-user"></i><span>Patient</span></a></li> 
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

            <div class="main-patient-card">
                
                 </div>


                <div class="patient-btn-opps">
        
                </div>


                <div id="sys">
                    <h2>patients Visit History</h2>
                    </div>

                    <section class="search-container">
                        <div class="search-input-wrapper">
                         <input type="search" placeholder="search here..." id="searchPatVisitHist">
                         <i class="fa-solid fa-magnifying-glass"></i>
                        </div>
                        </section>
        
                   <section id="outer-table">
                    <div class="table-container">
        
                      
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

    
  $(function(){
    $('.upper-right .appointment-hist label').hover(
      function(){
        $('.upper-right .appointment-hist .list-hit-apt').addClass('visible');
      }
    );

    $('#main-content').hover(
      function(){
        $('.upper-right .appointment-hist .list-hit-apt').removeClass('visible');
      }
    );
    
    $('#side-bar-menu').hover(
      function(){
        $('.upper-right .appointment-hist .list-hit-apt').removeClass('visible');
      }
    );

    $('.upper-right .appointment-hist .list-hit-apt').hover(function(){},function(){
      $(this).removeClass('visible');
    })
    
  });

  function displayUpdateCard(){
        $('#Edit-pat-card').addClass('active')

        $('#Edit-pat-card .field-form #canel-field-form').click(function(){
        $('#Edit-pat-card').removeClass('active')
        remMessage();
        });
  }



    function Addvisitvisible(){
        $('#Add-pat-visit-card').addClass('active')
        

        $('#Add-pat-visit-card .field-form #canel-field-form').click(function(){
        $('#Add-pat-visit-card').removeClass('active')
        });

     }

     function displayAppointmentCard(){
        $('#Add-pat-appointment-card').addClass('active')

        $('#Add-pat-appointment-card .field-form #canel-field-form').click(function(){
        $('#Add-pat-appointment-card').removeClass('active')
        });
      }
       
     //remove message

function remMessage7(){

const messagecont = document.querySelector("#Add-pat-appointment-card .field-form .message-dis"),
messageconterr= document.querySelector("#Add-pat-appointment-card .field-form .message-dis-err");

messageconterr.style.display = "none";
messagecont.style.display = "none"; 
}
    </script> 
      <script type="text/javascript" src="patientCardJS.js"></script>
      <script type="text/javascript">
        window.onload = function() {
        // Call your method here
        changePatientDetails();
        changePatientDetailsbtns();
        changePatientHISTDetails();
        SearchPatientVisitHist();
        };


function remMessage(){

const messagecont = document.querySelector(".message-dis"),
messageconterr= document.querySelector(".message-dis-err");

messageconterr.style.display = "none";
messagecont.style.display = "none"; 
}

 
function remMessage1(){

const messagecont = document.querySelector("#Add-pat-visit-card .field-form .message-dis"),
messageconterr= document.querySelector("#Add-pat-visit-card .field-form .message-dis-err");

messageconterr.style.display = "none";
messagecont.style.display = "none"; 
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



              // add appointment

      function AddApointMent(){
        const form = document.querySelector("#Add-pat-appointment-card .field-form .main-container form"),
         messagedis = document.querySelector("#Add-pat-appointment-card .field-form .message-dis p"),
         messagecont = document.querySelector("#Add-pat-appointment-card .field-form .message-dis"),
         messagediserr=document.querySelector("#Add-pat-appointment-card .field-form .message-dis-err p"),
         messageconterr= document.querySelector("#Add-pat-appointment-card .field-form .message-dis-err"),
         loader = document.getElementById("loader"),
         urlParams = new URLSearchParams(window.location.search),
         paramValue = urlParams.get('HSPN');
     
     form.onsubmit = (e)=>{
        e.preventDefault();
       //prevent form  submitting
     } 
      
     
       loader.style.display = "initial";
         
     //Ajax code
     let xhr = new XMLHttpRequest();
     //create Xml oject
     xhr.open("POST", "AddApointment.php?HSPN=" + encodeURIComponent(paramValue), true);
     xhr.onload = ()=>{
     if(xhr.readyState === XMLHttpRequest.DONE){
         if(xhr.status === 200){
          
      loader.style.display = "none";
     
       let data = xhr.response;
       console.log(data);
     
     
     
     if(data == "failed"){
     messagediserr.innerHTML="Failed to add Appointment Please try again!";
     messageconterr.style.display = "flex";
     messagecont.style.display = "none";  
     }
    
     if(data == "empty"){
        messagediserr.innerHTML="Please fill up the field! with *";
        messageconterr.style.display = "flex";
        messagecont.style.display = "none";  
        }
    
    
            if(data == "success"){
                messagedis.innerHTML="Added Successfully!";
                messageconterr.style.display = "none";
                messagecont.style.display = "flex";  
                }
                if(data == "no data"){
                    messagediserr.innerHTML="Patient details not Found!";
                    messageconterr.style.display = "flex";
                    messagecont.style.display = "none";  
                    } 
                    if(data == "exist"){
                    messagediserr.innerHTML="Appointment For this Date Exists!";
                    messageconterr.style.display = "flex";
                    messagecont.style.display = "none";  
                    }
                
                    if(data == "not set"){
                        messagediserr.innerHTML="Technical Error Quit this window and open it again!";
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
    </script>
  <script type="text/javascript" src="logoutJS.js"></script>
</body>
</html>