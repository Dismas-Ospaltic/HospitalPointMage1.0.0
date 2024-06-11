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
   
   

if($session_role != "admin"){
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
        <link rel="stylesheet" href="managereasourceStyle.css">
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

    <section id="add-emp-card">
        <div class="field-form">
        <div id="canel-field-form"><i class="fa-solid fa-times"></i></div>
        <h2>Add New Staff</h2>

        <div id="message-dis">
          <p></p>
          <label onclick="remMessage()"><i class="fa-solid fa-times-square"></i></label>
        </div>
  
        <div id="message-err-dis">
          <p></p>
          <label onclick="remMessage()"><i class="fa-solid fa-times-square"></i></label>
        </div>

        <div class="main-container">
       <form action="#" method="post">
          <div class="input-wrapper">
            <label>First Name *</label>
            <input type="text" name="text_fname" placeholder="please enter first name...">
           </div>
  
           <div class="input-wrapper">
            <label>Middle Name</label>
            <input type="text" name="text_mname" placeholder="please enter middle name...">
           </div>

           <div class="input-wrapper">
            <label>Last Name *</label>
            <input type="text" name="text_lname" placeholder="please enter last name...">
           </div>
  
  
           <div class="input-wrapper">
            <label>National ID *</label>
            <input type="text" name="text_idno" placeholder="please enter number of national document...">
           </div>



           <div class="input-wrapper">
            <label>Gender</label>
            <select name="text_gender">
          <option value="">--Select Gender--</option>
          <option value="male">Male</option>
          <option value="female">Female</option>
            </select>
           </div> 
  
           <div class="input-wrapper">
            <label>email Address *</label>
            <input type="email" name="text_email" placeholder="please enter email address...">
           </div>
  
           <div class="input-wrapper">
            <label>Phone No. *</label>
            <input type="text" name="text_phone" placeholder="please enter Phone number...">
           </div>
  
           <div class="input-wrapper">
            <label>Role *</label>
            <select name="text_role">
          <option value="">--Select Role--</option>
          <option value="doctor">Doctor</option>
          <option value="nurse">Nurse</option>
          <option value="reception">Reception</option>
          <option value="Lab Tech">Lab Tech</option>
            </select>
           </div> 
  

           <?php
       $selcect_dept_data1 = mysqli_query($conn, "SELECT * FROM department_data");
         ?>
               <div class="input-wrapper">
                <label>Department</label>
                <select name="text_dept">
                <option value="">--Select Department--</option>
                  <?php 
           if(mysqli_num_rows($selcect_dept_data1) > 0){
             while($row1 = mysqli_fetch_assoc($selcect_dept_data1)){
                  ?>
              
              <option value="<?php echo $row1["dept_name"]; ?>"><?php echo $row1["dept_name"]; ?></option>
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
            <label>Staff No.</label>
            <input type="text" name="text_staff" placeholder="please enter Staff No...">
           </div>

         
           <div class="btn-wrapper">
            <button class="emp-save" onclick="addEmp()" >Save</button>
           </div>
   </form>
        </div>
        </div>
        </section>

      
        <section id="update-emp-card">
            <div class="field-form">
            <div id="canel-field-form"><i class="fa-solid fa-times"></i></div>
            <h2>Update Staff</h2>
    
            <div id="message-dis">
              <p></p>
              <label onclick="remMessage1()"><i class="fa-solid fa-times-square"></i></label>
            </div>
      
            <div id="message-err-dis">
              <p></p>
              <label onclick="remMessage1()"><i class="fa-solid fa-times-square"></i></label>
            </div>
    
            <div class="main-container">
    
            </div>
            </div>
            </section>



        <section id="add-equipment-card">
            <div class="field-form">
            <div id="canel-field-form"><i class="fa-solid fa-times"></i></div>
            <h2>Add New Equipment</h2>
    
            <div id="message-dis">
              <p></p>
              <label onclick="remMessage2()"><i class="fa-solid fa-times-square"></i></label>
            </div>
      
            <div id="message-err-dis">
              <p></p>
              <label onclick="remMessage2()"><i class="fa-solid fa-times-square"></i></label>
            </div>
    
            <div class="main-container">
            <form action="#" method="post">
              <div class="input-wrapper">
                <label>Product Name*</label>
                <input type="text" name="text_name" placeholder="please enter name...">
               </div>
      
               <div class="input-wrapper">
                <label>Product Code/ Serial No*</label>
                <input type="text" name="text_code" placeholder="please enter serial No. ...">
               </div>
    
               <div class="input-wrapper">
                <label>Qty*</label>
                <input type="number" name="text_qty" placeholder="please enter last name...">
               </div>
      
      
               <div class="input-wrapper">
                <label>Price</label>
                <input type="number" name="text_price" placeholder="please enter buying Price...">
               </div>
    
    
          <?php
       $selcect_dept_data = mysqli_query($conn, "SELECT * FROM department_data");
         ?>
               <div class="input-wrapper">
                <label>Department</label>
                <select name="text_dept">
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
                <label>Description</label>
                <textarea name="txt_description" placeholder="write a small description..."></textarea>
               </div> 
    
             
               <div class="btn-wrapper">
                <button class="emp-save" onclick="addEquip()">Save</button>
               </div>
         </form>
            </div>
            </div>
            </section>



            <section id="update-equipment-card">
                <div class="field-form">
                <div id="canel-field-form"><i class="fa-solid fa-times"></i></div>
                <h2>Update Equipment</h2>
        
                <div id="message-dis">
                  <p></p>
                  <label onclick="remMessage3()"><i class="fa-solid fa-times-square"></i></label>
                </div>
          
                <div id="message-err-dis">
                  <p></p>
                  <label onclick="remMessage3()"><i class="fa-solid fa-times-square"></i></label>
                </div>
        
                <div class="main-container">
          
                 
                </div>
                </div>
                </section>


                <section id="department-card">
                  <div class="field-form">
                  <div id="canel-field-form"><i class="fa-solid fa-times"></i></div>
                  <h2>Add Departments</h2>
    
      
                  <div class="main-container">
                    <form action="#" method="post">
                    <div class="input-btn-wrapper">
                      <input type="text" name="text_dept" placeholder="enter department Name...">
                      <button onclick="AddNewdept()"><i class="fa-solid fa-plus-circle"></i>Add</button>
                    </div>
                   </form>
                 
                    <div class="depart-list">
                 
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
               <h2>Manage Hospital Resources</h2>
            </label>
            </div>
            <div class="upper-right">
          
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
                            if($session_role == "admin" && $session_role == "doctor" && $session_role == "nurse"){
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
                            if($session_role == "admin" && $session_role == "doctor" && $session_role == "nurse" && $session_role == "Lab Tech"){
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
                              <li><a href="managereasource.php"  class="active"><i class="fa-solid fa-people-group"></i><span>Hospital Resources</span></a></li>
                             <?php
                             }else{
                              ?>
                             <li><a href=""  class="active" onclick="alert('Sorry Seems You do not have rights to access This page')"><i class="fa-solid fa-people-group"></i><span>Hospital Resources</span></a></li>
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
                <section id="btn-opps">
                    <div class="btn-wrapper-opp add-emp">
                       <label><i class="fa-solid fa-user-plus"></i></label> 
                       <label>Add Staff</label>
                    </div>
                    
                    <div class="btn-wrapper-opp add-equip">
                        <label><i class="fa-solid fa-toolbox"></i></label> 
                        <label>Add Equipments</label>
                     </div>

                     <div class="btn-wrapper-opp department" onclick="showDepartCont()">
                      <label><i class="fa-solid fa-book"></i></label> 
                      <label>Add Departments</label>
                   </div>

                     <div class="btn-wrapper-opp">
                        <label><i class="fa-solid fa-toolbox"></i></label> 
                        <label>Add Medicine & Medical Equipments</label>
                     </div>
                    
                    </section>




                    <div id="sys">
                        <h2>All Employees in the System</h2>
                        </div>
                        
                    <section id="outer-table">
                        <div class="table-container table-staff">
                      
                  
                        </div>
                    </section>

   


                    <div id="sys">
                        <h2>All Hospital Equipment in the System</h2>
                        </div>
                        
                    <section id="outer-table">
                        <div class="table-container table-equip">
                            
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


    $('#btn-opps .add-emp').click(function(){
        $('#add-emp-card').addClass('active')
        });

        $('#add-emp-card .field-form #canel-field-form').click(function(){
        $('#add-emp-card').removeClass('active')
        });

        
    $('#btn-opps .add-equip').click(function(){
        $('#add-equipment-card').addClass('active')
        });

        $('#add-equipment-card .field-form #canel-field-form').click(function(){
        $('#add-equipment-card').removeClass('active')
        });


        function showEmpDetCont(){
        $('#update-emp-card').addClass('active')
       

        $('#update-emp-card .field-form #canel-field-form').click(function(){
        $('#update-emp-card').removeClass('active')
        removeStates();
        });
      }

      function showEquipDetCont(){
        $('#update-equipment-card').addClass('active')

        $('#update-equipment-card .field-form #canel-field-form').click(function(){
        $('#update-equipment-card').removeClass('active')
        removeStates();
        });
      } 
 
      function showDepartCont(){
        $('#department-card').addClass('active')

        $('#department-card .field-form #canel-field-form').click(function(){
        $('#department-card').removeClass('active')
        });
      }
    </script>
     <script type="text/javascript">  
 window.onload = function() {
  // Call your method here
  changeempTable();
  changeEquipTable();
  removeStates();
  changeDeptDet();
};


function remMessage(){

const messagecont = document.querySelector("#add-emp-card .field-form #message-dis"),
messageconterr= document.querySelector("#add-emp-card .field-form #message-err-dis");


messageconterr.style.display = "none";
messagecont.style.display = "none"; 
}


function remMessage1(){

const messagecont = document.querySelector("#update-emp-card .field-form #message-dis"),
messageconterr= document.querySelector("#update-emp-card .field-form #message-err-dis");


messageconterr.style.display = "none";
messagecont.style.display = "none"; 
} 


function remMessage2(){

const messagecont = document.querySelector("#add-equipment-card .field-form #message-dis"),
messageconterr= document.querySelector("#add-equipment-card .field-form #message-err-dis");


messageconterr.style.display = "none";
messagecont.style.display = "none"; 
} 

function remMessage3(){

const messagecont = document.querySelector("#update-equipment-card .field-form #message-dis"),
messageconterr= document.querySelector("#update-equipment-card .field-form #message-err-dis");


messageconterr.style.display = "none";
messagecont.style.display = "none"; 
} 


function removeStates(){
    window.history.replaceState(null, '', '/HMSMage/managereasource.php');
}


function AddNewdept(){   
  
  const form = document.querySelector("#department-card .field-form .main-container form"),
  loader = document.getElementById("loader");

  
  
  form.onsubmit = (e)=>{
     e.preventDefault();
    //prevent form  submitting
  } 
  

      loader.style.display = "initial";
   
      //Ajax code
      let xhr = new XMLHttpRequest();//create Xml oject
      xhr.open("POST", "addNewDepertment.php", true);
  
      xhr.onload = ()=>{
      if(xhr.readyState === XMLHttpRequest.DONE){
          if(xhr.status === 200){
            loader.style.display = "none";
            
      
        let data = xhr.response;
        console.log(data);
      
        if(data == "added"){
         alert("Department added successfully!");
       
        }

        if(data == "add fail"){
         alert("Department failed to add Try again!");
        }

        if(data == "exist"){
         alert("Department Already exist!");
        }

        if(data == "empty"){
         alert("Please enter Department Name");
        }
  
        changeDeptDet();
          }
      }
      }
      //send the form data throught ajax to php
      let formData = new FormData(form); //new formData object
      xhr.send(formData);
     

  }



  function changeDeptDet(){
    const display = document.querySelector("#department-card .field-form .main-container .depart-list");
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET", "ShowDepts.php", false);
     xmlhttp.send(null);
     display.innerHTML=xmlhttp.responseText;
  }



  function Deletedept(){
    const urlParams = new URLSearchParams(window.location.search),
             paramValue = urlParams.get('dept_name'),
             paramValue1 = urlParams.get('deptid'),
               loader = document.getElementById("loader");
                  
                   
                   loader.style.display = "initial";
                
                   //Ajax code
                   let xhr = new XMLHttpRequest();//create Xml oject
                   xhr.open("GET", "DeleteDeptt.php?dept_name=" + paramValue + "&deptid=" +paramValue1, true);
               
                   xhr.onload = ()=>{
                   if(xhr.readyState === XMLHttpRequest.DONE){
                       if(xhr.status === 200){
                         loader.style.display = "none";
                         
                   
                     let data = xhr.response;
                     console.log(data);
                   
                        if(data == "deleted"){
                        alert("Delete successfully");
                        changeDeptDet();
                        }
                        if(data == "failed"){
                          alert("Delete Failed Try Again"); 
                        }
                            
                        
                       }
                   }
                   }
                   xhr.send();
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
    <script type="text/javascript" src="ShowEmpJS.js"></script>
    <script type="text/javascript" src="showEquip.js"></script>
    <script type="text/javascript" src="logoutJS.js"></script>
</body>
</html>