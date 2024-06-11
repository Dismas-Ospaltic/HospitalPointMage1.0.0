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
        <link rel="stylesheet" href="dashboradStyle.css">
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
/* #overview-cards{

} */

body{
   background-image: url(resources/img/doct1.jpg);
 background-size:cover;
 background-position: center;
 background-repeat: no-repeat;
background-attachment: fixed;
}
#overview-cards .cards{
   display: grid;
   grid-template-columns: repeat(auto-fit, minmax(200px, 2fr));
   grid-gap:.5rem;
   margin-top: .2rem;
}
#overview-cards .cards .card-single{
   background: #fff;
   display: flex;
   justify-content: space-between;
   padding: .5rem;
   border-radius: 2px;
}
#overview-cards .cards .card-single div:last-child span{
   font-size: 2rem;
   color: var(--main-color);
}
#overview-cards .cards .card-single div:first-child span{
   color: var(--text-grey);
}
#overview-cards .cards .card-single:last-child {    
   background: var(--main-color);
}
#overview-cards .cards .card-single:last-child h1,
#overview-cards .cards .card-single:last-child div:last-child span,
#overview-cards .cards .card-single:last-child div:first-child span{
  color: #fff;
}
#date-sec{
   margin-top: 10px;
}
#date-sec .date-container{
  padding: .5rem;
  background: var(--white);
  border: 1px solid var(--secondary-color);
   width: fit-content;
   border-radius: 10px;
   cursor: pointer;
}
#date-sec .date-container strong{
   color: var(--secondary-color);
}
#date-sec .date-container strong i{
   padding-right: .5rem;
}



/* graph styling */
#statistics{
   background: var(--white);
   border: 1px solid #f17171;
   margin: 0 auto;
   margin-top: 20px;
   width: 100%;
   padding: 1rem;
   border-radius: 10px;
}
#statistics .stat-header{
   display: flex;
   justify-content: space-between;
}
#statistics .stat-header label p strong{
   color: var(--main-color);
}
#statistics .stat-header .stat-btns{
   display: flex;
   flex-direction: row;
}#statistics .stat-header .stat-btns .ybtn{
   background: #f17171;
}
#statistics .stat-header .stat-btns .mbtn{
   background: var(--coolor);
}
#statistics .stat-header .stat-btns .wbtn{
   background: var(--color-dark);
}
#statistics .stat-header .stat-btns button:hover{
   opacity: .7;
}
#statistics .stat-header .stat-btns button{
   padding: .5rem .7rem;
   margin-left: .5rem;
   color: var(--white);
   border-radius: 10px;
   cursor: pointer;
}
#statistics .graph-plot{
   margin: 0 auto;
   width: 100%;
   margin-top: 5px;
   padding: .5rem;
}


 .swiper-slide p span strong{
   color: var(--main-color);
 }
 .swiper-button-prev, .swiper-button-next {
   background: var(--color-dark);
   padding: .5rem;
   position: absolute;
   top: 50%;
}
.swiper-button-prev{
   border-top-left-radius: 10px;
   border-bottom-left-radius: 10px;
}
.swiper-button-next {
   border-top-right-radius: 10px;
   border-bottom-right-radius: 10px;
}

#week.display{
   display: initial;
   }
   #week.nodisplay{
       display: none;
}

#week .chart-item{
   width: calc(100% / 7); 
}
#month .chart-item{
   width: calc(100% / 31); 
}
#year .chart-item{
   width: calc(100% / 12); 
}
           
.container{
   margin: 0 auto;
   width: 100%;
}
.container-container{
   display: flex;
   text-align: center;
  width: 100%;
  margin: 0 auto;
}

.bar{
   position: relative;
   height: 300px;
   border-bottom: 1px solid var(--border-color);
   background-image: linear-gradient(var(--border-color) 1px, transparent 1px),
   linear-gradient(90deg, var(--border-color) 1px, transparent 1px);
   background-size: 100% 10%;
}

.bar-item{
   position: absolute;
   height: calc(var(--barSize) * 1%);
   width: 90%;
   bottom: 0;
   left: 0;
   right: 0;
   margin: 0 auto;
}
.bar-item:hover:before{
   content: attr(title1);
   position: absolute;
   background-color: #FFFFFF;
   padding: 4px 8px;
   top: -28px;
   left: 10px;
   border-radius: 4px;
   box-shadow: 0 0 4px 2px rgba(0,0,0,0.1);
   z-index: 2;
}
.bar-item:hover:after{
   content: '';
   position: absolute;
   width: 0;
   height: 0;
   top: -4px;
   left:  22px;
   border-left: 4px solid transparent;
   border-right: 4px solid transparent;
   border-top: 8px solid #FFFFFF;
   z-index: 999;
}
.bar-label{
   margin-top: 8px;
   font-size: .7rem;
   color: var(--color-dark);
}
.chart-item:last-child .bar{
   border-right: 1px solid var(--border-color);
}
.chart-item:nth-child(odd) .bar-item{
   background: #f17171;
  }
  .chart-item:nth-child(even) .bar-item{
   background: #71d7f1;
  }   
  #month{
   display: initial;
}
#month.display{
   display: initial;
}
#month.nodisplay{
   display: none;
}
#year{
   display: none;
}
#year.display{
   display: initial;
}
#year.nodisplay{
   display: none;
}

#week{
   display: none;
   }
#week.display{
display: initial;
}
#week.nodisplay{
   display: none;
}
#app-recent-sec{
   display: flex;
   justify-content: space-between;
   align-items: center;
   margin-top: 20px;
}
#app-recent-sec .app-sec{
   width: 40%;
   background: var(--white);
   border-radius: 10px;
   padding: .5rem;
}
#app-recent-sec .app-sec .header-sec-app{
   padding: .5rem;
   display: flex;
   align-items: center;
}
#app-recent-sec .app-sec .header-sec-app h3{
   color: var(--secondary-color);
   padding: 1rem;
}
#app-recent-sec .app-sec .header-sec-app .app-num{
    background: var(--coolor);
    padding: .5rem;
    margin-left: 1rem;
    color: var(--white);
    border-radius: 10px;
    
}
.app-list{
   overflow-y: auto;
   max-height: 350px;
}
.app-list .app-list-single{
   padding: .5rem;
   background: var(--light-bg-color);
    margin-bottom: .5rem;
    display: flex;
    justify-content: space-between;
    border: 1px solid var(--main-color);
}
.app-list .app-list-single .name-avatar i{
   color: var(--secondary-color);
   padding-right: .3rem;
}

#app-recent-sec .recent-patients{
   width: 55%;
   background: var(--white);
   border-radius: 10px;
   padding: .5rem;
}
#app-recent-sec .recent-patients .header-rec h3{
   padding: .5rem;
   color: var(--main-color);
}
#app-recent-sec .recent-patients .rec-list-pat{
   overflow-y: auto;
   max-height: 350px;
}
#app-recent-sec .recent-patients .rec-list-pat .rec-list-single{
   padding: .5rem;
   background: var(--light-bg-color);
    display: flex;
    justify-content: space-between;
    border: 1px solid var(--main-color);
    margin-top: 10px;
}
#app-recent-sec .recent-patients .rec-list-pat .rec-list-single .name-avatar i{
   color: var(--main-color);
   padding-right: .3rem;
}
#hspt-resource{
   display: flex;
   justify-content: space-between;
   align-items: center;
  margin-top: 10px;
}

#hspt-resource .resources-card{
   padding: .5rem;
   background: var(--white);
   border: 1px solid var(--border-color);
   width: 48%;
   border-radius: 10px;
   }
   #hspt-resource .resources-card p strong{
    background: var(--color-dark);
    color: whitesmoke;
    padding: .5rem;
    border-radius: 10px;
   }
   #hspt-resource .resources-card label{
       display: flex;
       justify-content: space-between;
       padding-top: 2px;
       border-bottom: 1px solid var(--border-color);
   }
   #single-resource{
       color: var(--color-dark);
       font-size: 1.5rem;
       text-overflow: ellipsis;
       white-space: nowrap;
       overflow: hidden;
       width: 80%;
   }
   #hspt-resource .resources-card .resource-list{
   padding: 1rem;
   overflow-y: auto;
   max-height: 300px;
   }

   #hspt-resource .staff-list{
       background: var(--white);
       padding: 1rem;
       min-height: 100px;
       width: 48%;
       border-radius: 10px;
       }
       #hspt-resource .staff-list p strong{
           background: var(--color-dark);
           color: whitesmoke;
           padding: .5rem;
           border-radius: 10px;
          }
       #hspt-resource .staff-list .inner-staff-list label{
           display: flex;
           justify-content: space-between;
           padding-top: 2px;
       }
       #hspt-resource .staff-list .inner-staff-list{
       
      max-height: 300px;
       overflow-y: auto;
       
       }
       #single-staff{
           width: 65%;
           text-overflow: ellipsis;
           white-space: nowrap;
           overflow: hidden;
       }
       #des{
           width: 30%;
           text-overflow: ellipsis;
           white-space: nowrap;
           overflow: hidden;
       }
         /* pop up select */


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
   #online-data-backup-card .field-form .main-container .loader-img img,
   #ofline-data-backup-card .field-form .main-container .loader-img img{
    width: 70px;
    display: block;
    margin: 0 auto;
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
                 /* @end */
       @media(max-width: 720px){

           #app-recent-sec{
              flex-direction: column;
            }
            #app-recent-sec .app-sec{
               width: 100%;
            }
            #app-recent-sec .recent-patients{
               width: 100%;
               margin-top: 10px;
            }
            #hspt-resource{
               flex-direction: column;
           }
           #hspt-resource .resources-card{
               width: 100%;
               }
               #hspt-resource .staff-list{
                   width: 100%;
                   margin-top: 10px;
                   }

       }

    </style>
        <script src="resources/CDN-links/jquery.min.js"></script>
    </head>
<body>

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
               <h2>Dashboard</h2>
            </label>
            </div>
            <div class="upper-right">
            <a href="patientVisit.php?repoDate=<?php echo $current_date; ?>"><i class="fa-solid fa-clipboard-list"></i>Today's Visits</a>
          
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
                        <li><a href="index.php" class="active"><i class="fa-solid fa-dashboard"></i><span>Dashboard</span></a></li>
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

            <section id="overview-cards">
                <div class="cards">
                    <div class="card-single staffNumcard">
                     <div>
                        <h1></h1>
                        <span>Staffs</span>
                     </div>
                     <div>
                        <span class="fa-solid fa-users"></span> 
                     </div>
                    </div> 
                    
          
                    <div class="card-single patientNumcard ">
                        <div>
                           <h1></h1>
                           <span>Patients</span>
                        </div>
                        <div>
                           <span class="fa-solid fa-hospital-user"></span> 
                        </div>
                       </div> 
          
                       <div class="card-single todayVisit">
                        <div>
                           <h1></h1>
                           <span>Today's Visits</span>
                        </div>
                        <div>
                           <span class="fa-solid fa-clipboard-check"></span> 
                        </div>
                       </div> 
          
                       <div class="card-single departmentNum">
                        <div>
                           <h1></h1>
                           <span>Departments</span>
                        </div>
                        <div>
                           <span class="fa-solid fa-tree-city"></span> 
                        </div>
                       </div> 
          
                       <div class="card-single">
                        <div>
                           <h1>0</h1>
                           <span>No of Drugs</span>
                        </div>
                        <div>
                           <span class="fa-solid fa-kit-medical"></span> 
                        </div>
                       </div> 
                    
                       <div class="card-single">
                        <div>
                           <h1>0</h1>
                           <span>Low Stock Drugs</span>
                        </div>
                        <div>
                           <span class="fa-solid fa-kit-medical"></span> 
                        </div>
                       </div>
                </div>
            </section>


            <section id="date-sec">
             <div class="date-container">
                <strong><i class="fa-solid fa-calendar"></i><span>Today -<?php echo $current_date; ?></span></strong>
             </div>
            </section>


            <section id="statistics">
                <div class="stat-header">
                    <label><p><Strong>Patient Visits</Strong></p></label>
                    <div class="stat-btns">
                     <button class="ybtn">Yearly</button> 
                     <button class="mbtn">monthly</button> 
                     <button class="wbtn">weekly</button> 
                    </div>
                  </div>


                  <div id="week">
                   
                    </div>


                    <div id="month">
                   
                      </div>

                      <div id="year">
                      
                      </div>

            </section>


          <section id="app-recent-sec">
            <div class="app-sec">
                
            </div>


            <div class="recent-patients">
               <div class="header-rec">
                <h3>Recent Patients</h3>
               </div>
               <div class="rec-list-pat">
                
               </div>
            </div>

          </section>

          <section id="hspt-resource">
            <div class="resources-card">
                <p><strong>Available Hospital equpments</strong></p>
                <div class="resource-list">
              
              </div>
                  </div>



                  <div class="staff-list">
                    <p><strong>Hospital Staffs</strong></p>
                <div class="inner-staff-list">
               
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


    // graphing stylings
    $('.mbtn').click(function(){
      $('#month').addClass('display');
      $('#month').removeClass('nodisplay');
      $('#week').addClass('nodisplay');
      $('#week').removeClass('display');
      $('#year').addClass('nodisplay');
      $('#year').removeClass('display');

  loadSwiper();
});
    
$('.wbtn').click(function(){
  $('#week').addClass('display');
  $('#week').removeClass('nodisplay');
  $('#month').addClass('nodisplay');
  $('#month').removeClass('display');
  $('#year').addClass('nodisplay');
  $('#year').removeClass('display');

  loadWeekSwiper();
});
  
$('.ybtn').click(function(){
  $('#year').addClass('display');
  $('#year').removeClass('nodisplay');
  $('#week').addClass('nodisplay');
    $('#week').removeClass('display');
  $('#month').addClass('nodisplay');
  $('#month').removeClass('display');

  loadYearSwiper();
});


    </script>


<!-- Swiper JS -->
<script src="resources/CDN-links/swiper-bundle.min.js"></script>
     <!-- Initialize Swiper -->
 <script>
window.onload = function() {
  // Call your method here
  
   showDataMonth();
  showDataweek();
  showDataYear();
  displayTodayAppointments();
  displayRecentPatients();
  displayHospitalEquipment();
  displayHospitalStaffs();
  loadSwiper();
  loadWeekSwiper();
  loadYearSwiper();
  displayHospitalStaffsNumcard();
  displayHospitalPatientNumcard();
  displayHospitalPatientVisitNumcard();
  displayHospitaldepartmentNumcard();
  checkBackupCookiesExpired();
};
 
function loadWeekSwiper(){
    var weekSwiper = new Swiper(".slide-container1", {
      slidesPerView: 2,
    //   slidesPerGroup: 1,
      spaceBetween: 20,
      centerSlide: "true",
      pagination: {
        el: ".swiper-pagination",
        clickable: true,
      },
      breakpoints: {

0:{
slidesPerView: 1,
 },
 280:{
slidesPerView: 1,
 },
 450:{
   slidesPerView: 1,
  },
  540:{
   slidesPerView: 1,
  },
600:{
   slidesPerView: 1,
  },

1000:{
   slidesPerView: 1,
  },
  1024:{
   slidesPerView: 2,
  }, 
   },
      navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },
      initialSlide: $('.slide-container1 .swiper-slide').length - 1, // Start from the last slide
    });
}

     function loadSwiper(){
        var swiper = new Swiper(".slide-container", {
      slidesPerView: 1,
      // slidesPerGroup: 4,
      spaceBetween: 20,
      centerSlide: "true",
      pagination: {
        el: ".swiper-pagination",
        clickable: true,
      },
      navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },
      initialSlide: $('.slide-container .swiper-slide').length - 1, // Start from the last slide
    });
}  


function loadYearSwiper(){
    var weekSwiper = new Swiper(".slide-container2", {
      slidesPerView: 1,
      // slidesPerGroup: 4,
      spaceBetween: 20,
      centerSlide: "true",
      pagination: {
        el: ".swiper-pagination",
        clickable: true,
      },
      navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },
      initialSlide: $('.slide-container2 .swiper-slide').length - 1, // Start from the last slide
    });
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

  <script type="text/javascript" src="indexJS.js"></script>
  <script type="text/javascript" src="logoutJS.js"></script>
  <script type="text/javascript" src="DataBackJs.js"></script>
</body>
</html>