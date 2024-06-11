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

  
if($session_role != "admin" && $session_role != "doctor" && $session_role != "nurse" && $session_role != "Lab Tech"){
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
        <link rel="stylesheet" href="laboratoryStyle.css">
        <link rel="stylesheet" href="resources/css/all.min.css">
        <link rel="stylesheet" href="resources/css/fontawesome.min.css">
         <!-- Link Swiper's CSS -->
    <link
    rel="stylesheet"
    href="resources/CDN-links/swiper-bundle.css"
  />

        <script src="resources/CDN-links/jquery.min.js"></script>
    </head>
<body>



    <section id="Add-pat-labtest-card">
        <div class="field-form">
        <div id="canel-field-form"><i class="fa-solid fa-times"></i></div>
        <h2>Add Laboratory Test</h2>
        <div class="message-dis">
          <p>Patient add successfully</p>
          <label onclick="removemessage()"><i class="fa-solid fa-times-square"></i></label>
        </div>
    
        <div class="message-dis-err">
          <p>Patient add falied</p>
          <label onclick="removemessage()"><i class="fa-solid fa-times-square"></i></label>
        </div>
    
        <div class="main-container">
        <form action="#" method="post">
            <p><strong>Note: use semi-colon (;) at end of each statement to separate lines *</strong></p>

            <div class="input-wrapper">
                <label>Samples *</label>
                <input type="text" name="text_sampleno" placeholder="enter sample no...">
               </div>

           <div class="input-wrapper">
            <label>Samples *</label>
            <textarea  name="samle-list" placeholder="Specify tests to be conducted by lab tech etc..."></textarea>
           </div>

           <div class="input-wrapper">
            <label>Tests *</label>
            <textarea name="text_test" placeholder="Specify the samples to be collected e.g blood, urine etc..."></textarea>
           </div>

           <div class="input-wrapper">
            <label>Tests Results *</label>
            <textarea name="test_result" placeholder="Specify the samples to be collected e.g blood, urine etc..."></textarea>
           </div>

           <div class="input-wrapper">
            <label>Other Additional details</label>
            <textarea name="text_info" placeholder="Any other additional info here..."></textarea>
           </div>
         
           <div class="btn-wrapper">
            <button class="save-btn"><i class="fa-solid fa-plus"></i>Save Changes</button>
           </div>
          </form>
        </div>
        </div>
    </section>



 
    <section id="View-lab-card-inco">
        <div class="field-form">
        <div id="canel-field-form"><i class="fa-solid fa-times"></i></div>
        <h2>View Lab Test Order Details</h2>    
        <div class="main-container">
  
        </div>
        </div>
        </section>
      
        <section id="View-lab-card-comp">
            <div class="field-form">
            <div id="canel-field-form"><i class="fa-solid fa-times"></i></div>
            <h2>View Lab Test Order Details</h2>    
            <div class="main-container">
              
            </div>
            <div class="btn-opp">
                <button onclick="printDischargeLab()"><i class="fa-solid fa-print"></i> Print Details</button>
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
               <h2>Laboratory Section</h2>
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
                            <li><a href="doctor.php"><i class="fa-solid fa-user-nurse"></i><span>Doctor</span></a></li>
                            <?php
                            }else{
                            ?>
                            <li><a href=""onclick="alert('Sorry Seems You do not have rights to access This page')"><i class="fa-solid fa-user-nurse"></i><span>Doctor</span></a></li>
                             <?php
                            }
                            ?>
                            <?php
                            if($session_role == "admin" || $session_role == "doctor" || $session_role == "nurse" || $session_role == "Lab Tech"){
                            ?>
                           <li><a href="laboratory.php"  class="active"><i class="fa-solid fa-house-medical"></i><span>Laboratory</span></a></li>           
                            <?php
                            }else{
                            ?>
                            <li><a href=""  class="active" onclick="alert('Sorry Seems You do not have rights to access This page')"><i class="fa-solid fa-house-medical"></i><span>Laboratory</span></a></li>
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

             <section id="top-overview">
            <div class="user-det-greet">
                <section id="gretting-sec">
                    <h1><span class="first-sec">Hello,  </span><span class="last-sec"><?php echo $adminName; ?></span></h1>
                    <p>Here are some important task to be done.
                      Manage Patients Lab tests from your Dashboard. Make Sure to Assign Sample numbers to Sample Collected.
                    </p>
                    <button>View Profile</button>
             </section>
            </div>

            <div class="card-stats">
                <div class="cards">
                    <div class="card-single incoNum">
                     <div>
                        <h1></h1>
                        <span>Incoming Lab Test Orders</span>
                     </div>
                     <div>
                        <span class="fa-solid fa-users"></span> 
                     </div>
                    </div> 
                    
          
                    <div class="card-single completeNum">
                        <div>
                           <h1></h1>
                           <span>Completed Lab Tests</span>
                        </div>
                        <div>
                           <span class="fa-solid fa-hospital-user"></span> 
                        </div>
                       </div> 
          
                       <div class="card-single tdayPendingNum">
                        <div>
                           <h1></h1>
                           <span>Pending Lab test Order</span>
                        </div>
                        <div>
                           <span class="fa-solid fa-clipboard-question"></span> 
                        </div>
                       </div> 
          
                       <div class="card-single predayPendingNum ">
                        <div>
                           <h1></h1>
                           <span>Pending Lab test for Previous Days</span>
                        </div>
                        <div>
                           <span class="fa-solid fa-clipboard-question"></span> 
                        </div>
                       </div> 
          
                </div>
            </div>

            </section>


     <section id="inco-cont">
            <section class="search-container">
                <div class="search-input-wrapper">
                 <input type="search" id="searchIncoLab" placeholder="search here...">
                 <i class="fa-solid fa-magnifying-glass"></i>
                </div>
                </section>

 
            <div class="incoming-sec">
                <h4>Incoming Lab Test Order</h4>
                <div class="incoming-container">
                 
                </div>
                </div>
            </section>



            <section id="comp-cont">

                <section class="search-container">
                    <div class="search-input-wrapper">
                     <input type="search" id="searchTodayCompleteLab" placeholder="search here...">
                     <i class="fa-solid fa-magnifying-glass"></i>
                    </div>
                    </section>
    
    
                <div class="complete-sec">
                    <h4>Today's Completed Lab Test Order</h4>
                    <div class="complete-container">
                       
                    </div>
                    </div>
                </section>

              <section id="lab-hist-cont">

                <div id="sys">
                    <h2>Lab Test History</h2>
                    </div>

                <section class="search-container">
                    <div class="search-input-wrapper">
                     <input type="search" id="searchPrevCompleteLab" placeholder="search here...">
                     <i class="fa-solid fa-magnifying-glass"></i>
                    </div>
                    </section>

            
                    <section id="outer-table">
                        <div class="table-container table-container-hist">
                            
                    
                        </div>
                    </section>
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

    function displayAddLabResCard(){
        $('#Add-pat-labtest-card').addClass('active')
      
        $('#Add-pat-labtest-card .field-form #canel-field-form').click(function(){
        $('#Add-pat-labtest-card').removeClass('active')
        });
      }

        function displayDetailsInco(){
        $('#View-lab-card-inco').addClass('active')

        $('#View-lab-card-inco .field-form #canel-field-form').click(function(){
        $('#View-lab-card-inco').removeClass('active')
        });
      }


        function displayLabDetCardForComp(){
        $('#View-lab-card-comp').addClass('active')

        $('#View-lab-card-comp .field-form #canel-field-form').click(function(){
        $('#View-lab-card-comp').removeClass('active')
        });
      }

        $('#outer-table .table-container table tbody tr').click(function(){
        $('#View-lab-card-comp').addClass('active')
        });
        
    </script>

<script type="text/javascript">

    function printDischargeLab(){
      window.print();
  }


  window.onload = function() {
        // Call your method here
        displayIncomingLab();
        displayCompleteLabTest();
        displayLabHist();
        displayIncomingLabNum();
        displayCompleteLabNum();
        displayTodayPendingLabNum();
        displayPreviousPendingLabNum();
        SearchIncomingLabOrder();
        SearchTodayCompleteLabOrder();
        SearchPrevCompleteLabOrder();
        };

        setInterval(()=>{
          displayIncomingLabNum();
    }, 500);

let intervalIncoPatLabOrder = setInterval(()=>{
          displayIncomingLab();
}, 500);


 
  function removemessage(){
    const messagecont = document.querySelector("#Add-pat-labtest-card .field-form .message-dis"),
     messageconterr= document.querySelector("#Add-pat-labtest-card .field-form .message-dis-err");
     messagecont.style.display="none";
     messageconterr.style.display="none";
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
    <script type="text/javascript" src="labJS.js"></script>
    <script type="text/javascript" src="logoutJS.js"></script>
</body>
</html>