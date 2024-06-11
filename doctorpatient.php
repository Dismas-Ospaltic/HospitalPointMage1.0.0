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
        <link rel="stylesheet" href="doctorpatientStyle.css">
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





    <section id="Add-pat-medHist-card">
        <div class="field-form">
        <div id="canel-field-form"><i class="fa-solid fa-times"></i></div>
        <h2>Add Patient Medical History</h2>
        <div class="message-dis">
          <p></p>
          <label onclick="remMessage2()"><i class="fa-solid fa-times-square"></i></label>
        </div>
    
        <div class="message-dis-err">
          <p></p>
          <label onclick="remMessage2()" ><i class="fa-solid fa-times-square"></i></label>
        </div>
    
        <div class="main-container">
        </div>
        </div>
        </section>
    


        <section id="Edit-pat-medHist-card">
            <div class="field-form">
            <div id="canel-field-form"><i class="fa-solid fa-times"></i></div>
            <h2>Edit Patient Medical History</h2>
            <div class="message-dis">
              <p></p>
              <label onclick="remMessage3()"><i class="fa-solid fa-times-square"></i></label>
            </div>
        
            <div class="message-dis-err">
              <p></p>
              <label onclick="remMessage3()"><i class="fa-solid fa-times-square"></i></label>
            </div>
        
            <div class="main-container">
            </div>
            </div>
            </section>



            <section id="View-pat-medHist-card">
                <div class="field-form">
                <div id="canel-field-form"><i class="fa-solid fa-times"></i></div>
                <h2>Patient Medical History</h2>
                <div class="main-container">
                  <div class="main-par">
                  </div>
                </div>
                </div>
                </section>
    

                <section id="Order-pat-labtest-card">
                    <div class="field-form">
                    <div id="canel-field-form"><i class="fa-solid fa-times"></i></div>
                    <h2>Order Laboratory Test</h2>
                    <div class="message-dis">
                      <p></p>
                      <label onclick="remMessage4()"><i class="fa-solid fa-times-square"></i></label>
                    </div>
                
                    <div class="message-dis-err">
                      <p></p>
                      <label onclick="remMessage4()"><i class="fa-solid fa-times-square"></i></label>
                    </div>
                
                    <div class="main-container">
                    <form action="#" method="post">
                        <p><strong>Note: use semi-colon (;) at end of each statement to separate lines *</strong></p>
                       <div class="input-wrapper">
                        <label>Specify tests *</label>
                        <textarea name="text_test_spec" placeholder="Specify tests to be conducted by lab tech etc..."></textarea>
                       </div>

                       <div class="input-wrapper">
                        <label>Samples *</label>
                        <textarea name="text_sample" placeholder="Specify the samples to be collected e.g blood, urine etc..."></textarea>
                       </div>
                       <div class="input-wrapper">
                        <label>Other details</label>
                        <textarea name="other_spec" placeholder="Any other additional info here..."></textarea>
                       </div>
                     
                       <div class="btn-wrapper">
                        <button class="save-btn" onclick="orderLabTest()"><i class="fa-solid fa-plus"></i>Save Changes</button>
                       </div>
                      </form>
                    </div>
                    </div>
                </section>



                <section id="Edit-pat-det-card">
                    <div class="field-form">
                    <div id="canel-field-form"><i class="fa-solid fa-times"></i></div>
                    <h2>Edit Patient's Details</h2>
                    <div class="message-dis">
                      <p></p>
                      <label onclick="remMessage5()"><i class="fa-solid fa-times-square"></i></label>
                    </div>
                
                    <div class="message-dis-err">
                      <p></p>
                      <label onclick="remMessage5()"><i class="fa-solid fa-times-square"></i></label>
                    </div>
                
                    <div class="main-container">
                  
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

                        <section id="Add-pat-vital-card">
                            <div class="field-form">
                            <div id="canel-field-form"><i class="fa-solid fa-times"></i></div>
                            <h2>Record Vitals</h2>
                            <div class="message-dis">
                              <p>Patient add successfully</p>
                              <label><i class="fa-solid fa-times-square"></i></label>
                            </div>
                        
                            <div class="message-dis-err">
                              <p>Patient add falied</p>
                              <label><i class="fa-solid fa-times-square"></i></label>
                            </div>
                        
                            <div class="main-container">
                            <form action="#" method="post">
                                
        
                              
                        
                               <div class="btn-wrapper">
                                <button class="save-btn"><i class="fa-solid fa-plus"></i>Save</button>
                               </div>
                              </form>
                            </div>
                            </div>
                            </section>


                            <section id="Add-pat-medNotes-card">
                                <div class="field-form">
                                <div id="canel-field-form"><i class="fa-solid fa-times"></i></div>
                                <h2>Add Medical Notes</h2>
                                <div class="message-dis">
                                  <p></p>
                                  <label onclick="remMessage6()"><i class="fa-solid fa-times-square"></i></label>
                                </div>
                            
                                <div class="message-dis-err">
                                  <p></p>
                                  <label onclick="remMessage6()"><i class="fa-solid fa-times-square"></i></label>
                                </div>
                            
                                <div class="main-container">
                              
                                </div>
                                </div>
                                </section>

                                <section id="Add-pat-bill-card">
                                  <div class="field-form">
                                  <div id="canel-field-form"><i class="fa-solid fa-times"></i></div>
                                  <h2>Add Medical Bills And Services For current Visit</h2>
                                  <div class="message-dis">
                                    <p></p>
                                    <label onclick="remMessage1()"><i class="fa-solid fa-times-square"></i></label>
                                  </div>
                              
                                  <div class="message-dis-err">
                                    <p></p>
                                    <label onclick="remMessage1()"><i class="fa-solid fa-times-square"></i></label>
                                  </div>
                              
                                  <div class="main-container">


                                    <div class="table-cont">
                                      <h4>Add more Service</h4>
                                      <form ation="#" method="post">
                                      <table class="table">
                                      <thead>
                                          <tr>
                                              <th>Product/Services</th>
                                              <th>Price</th>
                                              <th>Quantity</th>
                                              <th>Total</th>
                                              <th>Action</th>
                                          </tr>
                                      </thead>
                                      <tbody id="product_tbody">
                                      <tr>
                                          <td><input type="text" name="pname[]" placeholder="enter service/product name..." required></td>
                                          <td><input type="number" name="price[]" min="1" class="price" placeholder="enter price" required></td>
                                          <td><input type="number" name="qty[]" min="1" value="1" class="qty" required></td>
                                          <td><input type="number" name="total[]"  class="total" readonly></td>
                                          <td><input type="button" value="X" class="btn-row-remove" required></td>
                                      </tr>
                                      </tbody>
                                      <tfoot>
                                          <tr>
                                              <td><input type="button" value="+ add row" id="btn-add-row"></td>
                                              <td colspan="2" id="text-align">Total</td>
                                              <td><input type="number" name="grand_total" id="grand_total" readonly></td>
                                          </tr>
                                      </tfoot>
                                      </table>
                                      <input  id="save-btn" type="submit" onclick="AddServiceBeforeInvoice()" value="Save invoice">
                                 </form>
                                      </div>
                                  </div>
                                  </div>
                                  </section>


                                  <section id="ViewMorHist-card">
                                    <div class="field-form">
                                    <div id="canel-field-form"><i class="fa-solid fa-times"></i></div>
                                    <h2>Patient Visit Details</h2>
                                
                                    <div class="main-container">
 
                                    </div>
                                    </div>
                                </section>

  
                                <section id="View-discharge-card">
                                        <div class="field-form">
                                        <div id="canel-field-form"><i class="fa-solid fa-times"></i></div>
                                        <h2>View Discharge Summary</h2>    
                                        <div class="main-container">
                                     
                                        </div>
                                        </div>
                                        </section>

                                        <section id="View-lab-card">
                                          <div class="field-form">
                                          <div id="canel-field-form"><i class="fa-solid fa-times"></i></div>
                                          <h2>View Lab Test Results</h2>    
                                          <div class="main-container">
                                            <div id="discharge">
                                          
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
               <h2>Doctor Patient's Card</h2>
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
 
                   <div class="main-patient-card">
                 
                     </div>
   


                     <div class="patient-btn-opps">

                     </div>






                    <section class="patient-Visit-card">

                    </section>


                 
                    <div id="sys">
                      <h2>Patient Visit History</h2>
                      </div>
          
                      <section class="search-container">
                          <div class="search-input-wrapper">
                           <input type="search" id="searchPatVisitHist" placeholder="search here...">
                           <i class="fa-solid fa-magnifying-glass"></i>
                          </div>
                          </section>

                          
                          <section id="outer-table">
                            <div class="table-container hist-patient">
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


    function displayMedHistContainerAddNew(){
        $('#Add-pat-medHist-card').addClass('active')
        

        $('#Add-pat-medHist-card .field-form #canel-field-form').click(function(){
        $('#Add-pat-medHist-card').removeClass('active')
        });
      }



        function displayMedHistContainer(){
        $('#Edit-pat-medHist-card').addClass('active')

        $('#Edit-pat-medHist-card .field-form #canel-field-form').click(function(){
        $('#Edit-pat-medHist-card').removeClass('active')
        });
       }



       function displayMedHistmoreDetContainer(){
        $('#View-pat-medHist-card').addClass('active')

        $('#View-pat-medHist-card .field-form #canel-field-form').click(function(){
        $('#View-pat-medHist-card').removeClass('active')
        });
      }
        

 function showDetWindoPatient(){
        $('#Edit-pat-det-card').addClass('active')

        $('#Edit-pat-det-card .field-form #canel-field-form').click(function(){
        $('#Edit-pat-det-card').removeClass('active')
        });
      }


     function OrderlLabWindow(){
        $('#Order-pat-labtest-card').addClass('active')

        $('#Order-pat-labtest-card .field-form #canel-field-form').click(function(){
        $('#Order-pat-labtest-card').removeClass('active')
        });
      }

     function displayAppointmentCard(){
        $('#Add-pat-appointment-card').addClass('active')

        $('#Add-pat-appointment-card .field-form #canel-field-form').click(function(){
        $('#Add-pat-appointment-card').removeClass('active')
        });
      } 

        $('.btn11').click(function(){
        $('#Add-pat-vital-card').addClass('active')
        });

        $('#Add-pat-vital-card .field-form #canel-field-form').click(function(){
        $('#Add-pat-vital-card').removeClass('active')
        });


        function displayMedicalNoteWindow(){
        $('#Add-pat-medNotes-card').addClass('active')

        $('#Add-pat-medNotes-card .field-form #canel-field-form').click(function(){
        $('#Add-pat-medNotes-card').removeClass('active')
        });
        }

        function displayBillCard(){
        $('#Add-pat-bill-card').addClass('active')

        $('#Add-pat-bill-card .field-form #canel-field-form').click(function(){
        $('#Add-pat-bill-card').removeClass('active')
        });
        }


        function displayVistDataHist(){
        $('#ViewMorHist-card').addClass('active')

        $('#ViewMorHist-card .field-form #canel-field-form').click(function(){
        $('#ViewMorHist-card').removeClass('active')
        });
      }
        
   function displayDischargeCard(){
        $('#View-discharge-card').addClass('active')
  
        $('#View-discharge-card .field-form #canel-field-form').click(function(){
        $('#View-discharge-card').removeClass('active')
        });
   }
     
      function displayLabCard(){
        $('#View-lab-card').addClass('active')

        $('#View-lab-card .field-form #canel-field-form').click(function(){
        $('#View-lab-card').removeClass('active')
        });
      }
        
        $('.message-dis-err label').click(function(){
        $('.message-dis-err').addClass('active')
        });

        $('.message-dis label').click(function(){
        $('.message-dis').addClass('active')
        });





          ////invoice calculate
          $(document).ready(function(){
            $("#btn-add-row").click(function(){
                
                var row ='<tr><td><input type="text" name="pname[]" placeholder="enter service/product name..." required></td><td><input type="number" name="price[]" min="1" class="price" placeholder="enter price" required></td><td><input type="number" name="qty[]" min="1" value="1" class="qty" required></td><td><input type="number" name="total[]"  class="total" readonly></td><td><input type="button" value="X" class="btn-row-remove" required></td></tr>';
                $("#product_tbody").append(row);
            });

            $("body").on("click",".btn-row-remove",function(){
                if(confirm("Remove row?")){
             $(this).closest("tr").remove();
              grand_total ();
                }
            });


            $("body").on("keyup",".price",function(){
               var price =Number($(this).val());
               var qty = Number($(this).closest("tr").find(".qty").val());
               $(this).closest("tr").find(".total").val(price*qty);
               grand_total ();
            });

          function grand_total (){
                var tot=0;
                $(".total").each(function(){
                tot += Number($(this).val());
                });
                $("#grand_total").val(tot);
            }


            $("body").on("keyup",".qty",function(){
               var qty =Number($(this).val());
               var price = Number($(this).closest("tr").find(".price").val());
               $(this).closest("tr").find(".total").val(price*qty);
               grand_total ();
            });

        });
    </script>
<script type="text/javascript">
    window.onload = function() {
  // Call your method here
  changedoctPatientCardDetails();
  displayVisitCard();
  makebtnsReady();
  displaypatientVisitHistorytoFacility();
  SearchPatientVisitHistory()
};

//remove message
function remMessage1(){

const messagecont = document.querySelector("#Add-pat-bill-card .field-form .message-dis"),
messageconterr= document.querySelector("#Add-pat-bill-card .field-form .message-dis-err");

messageconterr.style.display = "none";
messagecont.style.display = "none"; 
}


//remove message
function remMessage2(){

const messagecont = document.querySelector("#Add-pat-medHist-card .field-form .message-dis"),
messageconterr= document.querySelector("#Add-pat-medHist-card .field-form .message-dis-err");

messageconterr.style.display = "none";
messagecont.style.display = "none"; 
}


//remove message
function remMessage3(){

const messagecont = document.querySelector("#Edit-pat-medHist-card .field-form .message-dis"),
messageconterr= document.querySelector("#Edit-pat-medHist-card .field-form .message-dis-err");

messageconterr.style.display = "none";
messagecont.style.display = "none"; 
}

//remove message
function remMessage4(){

const messagecont = document.querySelector("#Order-pat-labtest-card .field-form .message-dis"),
messageconterr= document.querySelector("#Order-pat-labtest-card .field-form .message-dis-err");

messageconterr.style.display = "none";
messagecont.style.display = "none"; 
}
 
//remove message
function remMessage5(){

const messagecont = document.querySelector("#Edit-pat-det-card .field-form .message-dis"),
messageconterr= document.querySelector("#Edit-pat-det-card .field-form .message-dis-err");

messageconterr.style.display = "none";
messagecont.style.display = "none"; 
}
 
//remove message
function remMessage6(){

const messagecont = document.querySelector("#Add-pat-medNotes-card .field-form .message-dis"),
messageconterr= document.querySelector("#Add-pat-medNotes-card .field-form .message-dis-err");

messageconterr.style.display = "none";
messagecont.style.display = "none"; 
}


//remove message

function remMessage7(){

const messagecont = document.querySelector("#Add-pat-appointment-card .field-form .message-dis"),
messageconterr= document.querySelector("#Add-pat-appointment-card .field-form .message-dis-err");

messageconterr.style.display = "none";
messagecont.style.display = "none"; 
}

function printDischarge(){
        var DisContainer =document.getElementById("View-discharge-card");
        var DisDiv =document.getElementById("discharge");

        DisContainer.style.display = "initial";
        window.print();
        DisContainer.style.display = "none";
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

     <script type="text/javascript" src="DoctorJs.js"></script>
     <script type="text/javascript" src="logoutJS.js"></script>
</body>
</html>