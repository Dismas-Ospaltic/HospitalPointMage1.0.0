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

if($session_role != "admin" && $session_role != "doctor" && $session_role != "nurse"){
  header("Location: accessPage.php");
}

   
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
        <link rel="stylesheet" href="doctorpStyle.css">
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
 body{
   background-image: url(resources/img/doct1.jpg);
 background-size:cover;
 background-position: center;
 background-repeat: no-repeat;
 background-attachment: fixed;
 }
 
 #gretting-sec{
 background: var(--white);
 padding: .4rem;
 }
 #gretting-sec h1 .first-sec{
   color: var(--main-color);
 }
 #gretting-sec h1 .last-sec{
   color: crimson;
 }
 #gretting-sec button{
   padding: .3rem .7rem;
   color: var(--white);
  background: crimson;
  border-radius: 5px;
 }
 #overview-det{
   width: 100%;
   margin: 0 auto;
   margin-top: 10px;
 }
 #overview-det .doc-repo-cards{
   display: grid;
   grid-template-columns: repeat(auto-fit, minmax(200px, 2fr));
   grid-gap:.5rem;
  
 }
 #overview-det .doc-repo-cards .single-repo-card{
 background: var(--white);
 border-radius: 10px;
 border: 1px solid crimson;
 padding: .3rem;
 display: flex;
 flex-direction: column;
 align-items: center;
 cursor: pointer;
 transition: .6s ease;
 text-align: center;
 }
 
 #overview-det .doc-repo-cards .single-repo-card i{
   background: var(--light-bg-color);
   color: crimson;
   padding: .5rem;
   font-size: 1.2rem;
   border-radius: 5px;
 }
 #overview-det .doc-repo-cards .single-repo-card p{
   color: var(--text-grey);
   padding-top: .2rem;
   padding-bottom: .2rem;
   
 }
 #overview-det .doc-repo-cards .single-repo-card label{
   font-size: 1rem;
   padding: .2rem;
   background: var(--main-color);
   color: var(--white);
   border-radius: 10px;
   width: 100%;
   text-align: center;
 }
 
 #sys{
   margin-top: 10px;
   }
   #sys h2{
   color: var(--color-dark);
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
       width: 20%;
      
      }
      .head-2{
       width: 13%;
      }
      .head-3{
       width: 17%;
      }
      .head-4{
       width: 20%;
      }
      .head-5{
       width: 12%;
      }
      .head-6{
      width: 8%;
      }
      .head-7{
       width: 10%;
     }
 
 
 
 
 
     .match-1{
       width: 20%;
       padding: .2rem;
       font-size: .9rem;
      }
      .match-2{
       width: 13%;
       padding: .2rem;
       font-size: .9rem;
      }
      .match-3{
       width: 17%;
       padding: .2rem;
       font-size: .9rem;
      }
      .match-4{
       width: 20%;
       padding: .2rem;
       font-size: .9rem;
      }
      .match-5{
       width: 12%;
       padding: .2rem;
       font-size: .9rem;
      }
      .match-6{
       width: 8%;
       padding: .2rem;
       font-size: .9rem;
      }
      .match-7{
       width: 10%;
       padding: .2rem;
       font-size: .8rem;
     }
 
     
     .match-2 p,
     .match-3 p,
     .match-5 p,
     .match-6 p,
     .match-7 p{
       text-overflow: ellipsis;
       white-space: nowrap;
       overflow: hidden;
     }
     .match-4 p,
      .match-1 p{
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
 
       #appointment-recent{
           display: flex;
        margin-top: 20px;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
       }
       #appointment-recent .appointment-sec{
       width: 50%;
       background: var(--white);
        padding: .5rem;
 
       }
       .appointment-container{
         max-height: 600px;
         overflow-y: auto;
       }
    .single-cont{
       background: var(--light-bg-color);
       border: 1px solid var(--main-color);
       border-radius: 5px;
       padding: .3rem;
       margin-top: .5rem;
       display: flex;
       justify-content: space-between;
 
    }
    .single-cont .left-sec .avatar-name i{
    color: var(--main-color);
    font-size: 1.5rem;
    }
    .single-cont .left-sec .name-reason p{
       color: var(--color-dark);
       }
       .single-cont .left-sec .name-reason small{
           color: var(--main-color);
       }
       .single-cont .left-sec label{
        color: var(--color-dark);
       }
    .single-cont .right-sec{
   display: flex;
   flex-direction: column;
    }
    .single-cont .right-sec label{
       margin-top: .3rem;
       cursor: pointer;
    }
    .single-cont .right-sec label:hover{
       background: var(--white);
    }
    
    .single-cont .right-sec .label-1{
       color: crimson;
    }
    .single-cont .right-sec .label-2{
       color: var(--green);
       
    }
    .single-cont .right-sec .label-3{
       color: var(--beautiful);
       
    }
 
 
       #appointment-recent .recent-sec{
           width: 47%;
           background: var(--white);
            padding: .5rem;
           }
 
       .recent-container{
           width: 100%;
           max-height: 600px;
           overflow-y: auto;
        }
        .main-container-table-recent{
           width: 100%;
           min-width: 400px;
           overflow-x: auto;
        }
 
           .head-11{
               width: 60%;
              }
              /* .head-22{
               width: 25%;
              } */
              .head-33{
               width: 40%;
              }
 
       
       
             .match-11{
               width: 60%;
               padding: .2rem;
               font-size: .9rem;
              }
              /* .match-22{
               width: 25%;
               padding: .2rem;
               font-size: .9rem;
              } */
              .match-33{
               width: 40%;
               padding: .2rem;
               font-size: .9rem;
              }
              .match-11 p,
              .match-33 p{
                overflow: hidden;
                display: -webkit-box;
                -webkit-box-orient: vertical;
                -webkit-line-clamp: 1;
                white-space: wrap;
               
              }
              
               /* .match-33 p{
                overflow: visible;
               } */
 
              /* incoming lab test */
 
              .head-L11{
               width: 30%;
              }
              .head-L22{
               width: 20%;
              }
              .head-L33{
               width: 20%;
              }
              .head-L44{
               width: 15%;
              }
              .head-L55{
               width: 15%;
              }
 
       
       
             .match-L11{
               width: 30%;
               padding: .2rem;
               font-size: .9rem;
              }
              .match-L22{
               width: 20%;
               padding: .2rem;
               font-size: .9rem;
              }
              .match-L33{
               width: 20%;
               padding: .2rem;
               font-size: .9rem;
              }
              .match-L44{
               width: 15%;
               padding: .2rem;
               font-size: .9rem;
              }
              .match-L55{
               width: 15%;
               padding: .2rem;
               font-size: .9rem;
              }
              .match-L11 p,
               .match-L22 p,
               .match-L33 p{
                overflow: hidden;
                display: -webkit-box;
                -webkit-box-orient: vertical;
                -webkit-line-clamp: 2;
                white-space: wrap;
               
              }
 
              /* all pateint style */
 
              #sys{
               margin-top: 10px;
               }
               #sys h2{
               color: var(--color-dark);
               }
 
              .head-1ap{
               width: 20%;
              
              }
              .head-2ap{
               width: 10%;
              }
              .head-3ap{
               width: 17%;
              }
              .head-4ap{
               width: 10%;
              }
              .head-5ap{
               width: 10%;
              }
              .head-6ap{
              width: 15%;
              }
              .head-7ap{
               width: 8%;
             }
             .head-8ap{
               width: 10%;
             }
 
 
 
 
             .match-1ap{
               width: 20%;
               padding: .2rem;
               font-size: .9rem;
              }
              .match-2ap{
               width: 10%;
               padding: .2rem;
               font-size: .9rem;
              }
              .match-3ap{
               width: 17%;
               padding: .2rem;
               font-size: .9rem;
              }
              .match-4ap{
               width: 10%;
               padding: .2rem;
               font-size: .9rem;
              }
              .match-5ap{
               width: 10%;
               padding: .2rem;
               font-size: .9rem;
              }
              .match-6ap{
               width: 15%;
               padding: .2rem;
               font-size: .9rem;
              }
              .match-7ap{
               width: 8%;
               padding: .2rem;
               font-size: .8rem;
             }
             .match-8ap{
         width: 10%;
         padding: .2rem;
         font-size: .9rem;
             }
             
             .match-2ap p,
             .match-3ap p,
             .match-4ap p,
             .match-5ap p,
             .match-6ap p,
             .match-7ap p,
             .match-8ap p{
               text-overflow: ellipsis;
               white-space: nowrap;
               overflow: hidden;
             }
              .match-1ap p{
               overflow: hidden;
               display: -webkit-box;
               -webkit-box-orient: vertical;
               -webkit-line-clamp: 2;
               white-space: pre-wrap;
              
             }
 
             .search-container .other-sort{
               display: flex;
               align-items: center;
               }
               .search-container .other-sort .select-wrapper{
               border: 1px solid var(--coolor);
               display: flex;
               
               }
               /* @end */
 
 @media(max-width: 920px){
   #overview-det{
       width: 100%;
   }
   #appointment-recent{
  flex-direction: column;
   }
 
 
   #appointment-recent .recent-sec{
       width: 100%;
       margin-top: 20px;
       }
    #appointment-recent .appointment-sec{
    width: 100%;
 
   }
 }
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
 
        <section id="upper-nav">
            <div class="upper-left">
            <label>
                <i class="fa-solid fa-bars" id="add"></i>

                <i class="fa-solid fa-bars" id="rem"></i>
               <h2>Doctor's Panel</h2>
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
                            <li><a href="index.php"><i class="fa-solid fa-dashboard"></i><span>Dashboard</span></a></li>
                            <li><a href="patient.php"><i class="fa-solid fa-hospital-user"></i><span>Patient</span></a></li> 
                            <?php
                            if($session_role == "admin" || $session_role == "doctor" || $session_role == "nurse"){
                            ?>
                            <li><a href="doctor.php" class="active"><i class="fa-solid fa-user-nurse"></i><span>Doctor</span></a></li>
                            <?php
                            }else{
                            ?>
                            <li><a href="" class="active" onclick="alert('Sorry Seems You do not have rights to access This page')"><i class="fa-solid fa-user-nurse"></i><span>Doctor</span></a></li>
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

         <section id="gretting-sec">
                <h1><span class="first-sec">Hello,  </span><span class="last-sec"><?php echo $adminName; ?></span></h1>
                <p>Here are some important task to be done.
                  Manage Patients from your Dashboard.
                </p>
                <button>View Profile</button>
         </section>
     
           <section id="overview-det">

            <div class="doc-repo-cards">
                <div class="single-repo-card inco-pati-card">
                <i class="fa-solid fa-hospital-user"></i>
                <p>Incoming patients</p>
                <label></label>
                </div> 
           
                <div class="single-repo-card inco-lab-test">
                 <i class="fa-solid fa-hospital-user"></i>
                 <p>Incoming Lab Results</p>
                 <label></label>
                 </div>
           
           
                 <div class="single-repo-card inco-appoint">
                   <i class="fa-solid fa-clipboard-check"></i>
                   <p>Appointments</p>
                   <label></label>
                   </div>
           
                   <div class="single-repo-card">
                     <i class="fa-solid fa-message"></i>
                     <p>Unread Messages</p>
                     <label>0</label>
                     </div>
                    </div>
           </section>
        
           <div id="sys">
            <h2>Incoming Patients</h2>
            </div>

            <section class="search-container">
                <div class="search-input-wrapper">
                 <input type="search" id="incomingPatientList" placeholder="search here...">
                 <i class="fa-solid fa-magnifying-glass"></i>
                </div>
                </section>

           <section id="outer-table">
            <div class="table-container inco-patient">
          
        
            </div>
        </section>



        <div id="sys">
          <h2>Incoming Lab Test Results</h2>
          </div>

          <section class="search-container">
              <div class="search-input-wrapper">
               <input type="search" id="incomingPatientLabList" placeholder="search here...">
               <i class="fa-solid fa-magnifying-glass"></i>
              </div>
              </section>

         <section id="outer-table">
          <div class="table-container inco-Lab">

            
      
          </div>
      </section>
    
  

        <section id="appointment-recent">
        <div class="appointment-sec">
        <h4>Upcomming Appontments</h4>
        <div class="appointment-container">
        </div>
        </div>

        <div class="recent-sec">
        <h4>Recent Patients</h4>
        <div class="recent-container">
            

        </div>
        </div>
        </section>
    



        <section class="search-container">
           <div class="search-input-wrapper">
            <input type="search" id="searchPat" placeholder="search here...">
            <i class="fa-solid fa-magnifying-glass"></i>
           </div>

           <div class="other-sort">
           <div class="select-wrapper">
           <label>Sort By</label>
           <select>
            <option value="Default">Default</option>
            <option value="Date">Date</option>
            <option value="Gender">Gender</option>
            <option value="Age">Age</option>
           </select>
           </div>
           </div>
           </section>

        <div id="sys">
            <h2>All patients in the System</h2>
            </div>

           <section id="outer-table">
            <div class="table-container doc-pat-sec">

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
    </script>
 <script type="text/javascript" src="docJS.js"></script>
 <script type="text/javascript">
 

      window.onload = function() {
  // Call your method here
  changeTableIncominPatients();
  changeTableIncominLabTest();
  changeTableupcomingAppoint();
  changeTableRecentPatient();
  SearchIncomingPatient();
  SearchIncomingPatientLabTest();
  displaycardincomingPat();
  displaycardincomingLabtest();
displaycardincomingAppoint();
changeTable();
SearchPatient();
};


setInterval(()=>{
  displaycardincomingPat();
  displaycardincomingLabtest();
   displaycardincomingAppoint();
  changeTableupcomingAppoint();

}, 500);




let intervalIncoPat = setInterval(()=>{
  changeTableIncominPatients();
}, 500);
 

let intervalIncoLab = setInterval(()=>{
  changeTableIncominLabTest();
}, 500);

    //this function will run frequently after 500ms
   
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
 <script type="text/javascript" src="logoutJS.js"></script>
</body>
</html>