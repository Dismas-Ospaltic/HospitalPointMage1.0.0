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
        <link rel="stylesheet" href="invoiceStyle.css">
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


    <section id="Show-pat-invo-card">
        <div class="field-form">
        <div id="canel-field-form"><i class="fa-solid fa-times"></i></div>
        <h2>Invoice Details</h2>

    
        <div class="main-container">
       <div id="invoice">
  
       </div>

        </div>
    <div class="btn-opp">
        <button onclick="printInvoice()"><i class="fa-solid fa-print"></i> Print Invoice</button>
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
               <h2>Invoices</h2>
            </label>
            </div>
            <div class="upper-right">

            <a href="patientInvoices.php?repoDate=<?php echo $current_date; ?>"><i class="fa-solid fa-clipboard-list"></i>Today's Invoices</a>
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
                            <li><a href="billing.php" class="active"><i class="fa-solid fa-clipboard-list"></i><span>Billing & Payments</span></a></li>
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
             
                <section class="search-container">
                    <div class="search-input-wrapper">
                     <input type="search" id="searchSingleVisitInvoice" placeholder="search here...">
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
             
            <section id="visit-cont">
              
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

   
    function ShowInvoCont(){
    // $(' #outer-table .table-container table tbody tr').click(function(){
        $('#Show-pat-invo-card').addClass('active')
        // });

        $('#Show-pat-invo-card .field-form #canel-field-form').click(function(){
        $('#Show-pat-invo-card').removeClass('active')
        });
    }
    </script>

<script type="text/javascript">
    function printInvoice(){
        window.print();
      
    }

    window.onload = function() {
  // Call your method here
  changePatientInvoice();
  SearchPatientSingleVisitInvoice();
};


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
<script type="text/javascript" src="RepoJS.js"></script>
<script type="text/javascript" src="logoutJS.js"></script>
</body>
</html>   