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
        <link rel="stylesheet" href="billingStyle.css">
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
.auto-list-cont{
   position: relative;
}
.auto-list-cont .search-auto-list{
background: var(--white);
position: absolute;
width: 80%;
border: 1px solid var(--color-dark);
border-bottom-left-radius: 10px;
border-bottom-right-radius: 10px;
padding: .4rem;
display: none;

}
.list-container{
   max-height: 500px;
   overflow-y: auto; 
}
.single-result{
   padding: .3rem;
   cursor: pointer;
   background: var(--light-bg-color);
   margin-top: .5rem;
   border-radius: 5px;
}
.single-result:hover{
  background: var(--coolor);
}
#over-view-note{
   display: flex;
   align-items: center;
   justify-content: space-between;
   margin-top: 10px;
}
.invoice-exist{
   width: 55%;
   background: var(--white);
   border: 1px solid var(--color-dark);
   border-radius: 5px;
   padding: .5rem;
}
.inv-pat-det{
   width: 42%;
   background: var(--white);
   border: 1px solid var(--color-dark);
   border-radius: 5px;
   padding: .5rem;
}
.inv-det{
   margin-bottom: .5rem;
}
.pat-det h4,
.inv-det h4{
color: crimson;
}
.pat-det p strong,
.inv-det p strong{
   color: var(--main-color);
}
.invoice-exist .table-container{
   width: 100%;
   overflow-x: auto;
   max-height: 600px;
   overflow-y: auto;
   /* min-width: 600px; */
   }
   .invoice-exist .table-container table{
       border-collapse: collapse;
       width: 100%;
       margin-bottom: 20px;
        min-width: 500px;
     }
     .invoice-exist .table-container table td{
       border: 1px solid var(--border-color);
       /* font-size: 13px;
       padding: 10px; */
      }
      .invoice-exist .table-container table tbody tr{
       cursor: pointer;
      
      }
      .invoice-exist .table-container table tbody tr td{
      padding: .2rem;
      }
      .invoice-exist .table-container table tbody tr:hover{
       /* background: var(--coolor); */
       background: rgba(65,105,255, 0.2);
      }
      .invoice-exist .table-container table thead tr{
     color: var(--coolor);
      }
      #head-1-s{
       width: 60%;
      }
      #head-2-s{
        width: 10%;
      }
      #head-3-s{
        width: 10%;
      }
      #head-4-s{
        width: 20%;
      }


      
      
      
      .match-1-s{
       width: 60%;
      }
      .match-2-s{
       width: 10%;
      }
      .match-3-s{
       width: 10%;
      }
      .match-4-s{
       width: 20%;
       text-align: center;
      }
      .match-4-s .delete{
       color: crimson;
      }
      .match-4-s .edit{
       color: var(--green);
       padding-left: .5rem;
      }

      /* #match-6{
        width: 15%;
        font-size: .8rem;
        color: crimson;
      } */
      
      .match-2-s p{
        overflow: hidden;
        display: -webkit-box;
        -webkit-box-orient: vertical;
        -webkit-line-clamp: 2;
        white-space: wrap;
      }

      #no-det h3{
       color: crimson;
       text-align: center;
       padding: .5rem;
       }
       .print-btn button{
           padding: .4rem .9rem;
           color: white;
           background: var(--green);
           cursor: pointer;
       }
       .print-btn button:hover{
           opacity: .7;
       }



       .table-cont{
  
           margin: 0 auto;
           margin-top: 20px;
           margin-bottom: 20px;
           /* width: 97%; */
           border-radius: 10px;
           background: var(--white);
           padding: 1rem;
           overflow-x: auto;
       }
       .table-cont table{
           border-collapse: collapse;
           width: 100%;
       }
       .table-cont table td{
           /* width: 100%; */
           border: 1px solid var(--border-color);
           font-size: 13px;
           padding: 10px;
        }
       
        .table-cont table td input[type="text"]{
           border: 1px solid var(--color-dark);
           background: var(--light-bg-color);
           color: var(--color-dark);
           height: 30px;
           width: 300px;
           border-radius: 10px;
        }
        .table-cont table td input[type="number"]{
           background: var(--light-bg-color);
           color: var(--color-dark);
           height: 30px;
           border-radius: 10px;
        }
        .table-cont table tbody td input[type="button"]{
       color: var(--white);
       background: crimson;
       padding: .5rem;
       border-radius: 10px;
        }
        .table-cont table tfoot td input[type="button"]{
       color: var(--white);
       background: var(--main-color);
       padding: .5rem 1rem;
       border-radius: 10px;
        }
        #text-align{
           text-align: right;
        }
        #save-btn{
           padding: .3rem .8rem;
           color: var(--white);
           background: crimson;
           margin-top: 10px;
           font-size: 1.3rem;
           border-radius: 10px;
           /* float: right; */
        }

        /* pop ups */


        #Show-pat-invo-card{
          background: rgba(65,105,255, 0.3);
          padding: 0rem;
          position: fixed;
          top: 0;
          bottom: 0;
          left: 0;
          right: 0;
          z-index: 99999;
        margin: auto;
        display: none;
        }
/* #Show-pat-invo-card, */
#Edit-pat-invo-card{
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
#Show-pat-invo-card.active,
#Edit-pat-invo-card.active{
  display: initial;
}    
#Show-pat-invo-card .field-form{
   width: 60%;
    background-color: var(--white); 
   margin: 0 auto;
   padding: .1rem;
   border-radius: 10px;
   border: 1px solid var(--black);
 }
#Edit-pat-invo-card .field-form{
  width: 50%;
   background-color: var(--white); 
  margin: 0 auto;
  padding: .1rem;
  border-radius: 10px;
}
#Show-pat-invo-card .field-form #canel-field-form,
#Edit-pat-invo-card .field-form #canel-field-form{
  float: right;
  padding: .6rem;
  border-radius: 10px;
}
#Show-pat-invo-card .field-form #canel-field-form:hover,
#Edit-pat-invo-card .field-form #canel-field-form:hover{
    background: var(--border-color);
}
#Show-pat-invo-card .field-form h2,
#Edit-pat-invo-card .field-form h2{
  margin-top: 1rem; 
    color: var(--main-color);
    text-align: center;
}
#Show-pat-invo-card .field-form .main-container,
#Edit-pat-invo-card .field-form .main-container{
 width: 100%;
 overflow-y: auto;
 max-height: 550px;
 padding: 1rem;
}
.main-par{
   border: 1px solid var(--main-color);
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
     color: var(--green);
}
.field-form .input-wrapper textarea{
resize: vertical;
border: 1px solid var(--main-color);
height: 100px;
padding: .5rem;
color: var(--color-dark);
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
   background: var(--white);
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
           background: var(--white);
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
/* invoice Styling */
#invoice{
   position: relative;
   
}
#invoice .invo-head-det{
   display: flex;
   justify-content: space-between;
   border-bottom: 1px groove var(--beautiful);
}
.left-sec-head h1{
color: var(--main-color);
}
.left-sec-head label{
   display: flex;
}
.left-sec-head label span{
   padding-left: .5rem;
}
.right-sec-head{
   display: flex;
}
.right-sec-head i{
   font-size: 2rem;
   padding-right: .5rem;
   color: var(--beautiful);
}


.invo-pat-intro-det{
   display: flex;
   justify-content: space-between;
   margin-top: 5px;
   border-top: 1px groove var(--beautiful);  
}
.left-sec-intro label{
   display: flex;
   align-items: baseline;
}
.left-sec-intro label h1{
   color: var(--main-color);
}
.left-sec-intro label span{
   padding-left: .5rem;
}


.right-sec-intro label h1{
   color: crimson;
}


.right-sec-intro label{
   display: flex;
   align-items: baseline;
}
.right-sec-intro label span{
   padding-left: .5rem;
}
#invoice .invo-table-container{
width: 100%;
margin: 0 auto;
margin-bottom: 10px;
}

#invoice .invo-table-container table{
   border-collapse: collapse;
   width: 100%;

}
#invoice .invo-table-container table td{
 
   border: 1px solid var(--color-dark);
   padding: .2rem;
}

#match-1-inf{
   text-align: right;
}
#man-water-mark{
   position: relative;
   bottom: 0;
}
#man-water-mark label span{
   color: var(--main-color);
}
#man-water-mark label i{
   padding-left: .25rem;
   padding-right: .25rem;
}

#stamp{
   margin-top: 20px;
}


/* table style */
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
   max-height: 600px;
   overflow-y: auto;
 /* min-width: 600px; */
 }
  
 #outer-table .table-container table{
   border-collapse: collapse;
   width: 100%;
   margin-bottom: 20px;
    min-width: 600px;
 }
 #outer-table .table-container table td{
  border: 1px solid var(--border-color);
 }
 
 #outer-table .table-container table tbody tr{
  cursor: pointer;
 
 }
 #outer-table .table-container table tbody tr td{
 padding: .2rem;
 }
 #outer-table .table-container table tbody tr:hover{
  /* background: var(--coolor); */
  background: rgba(65,105,255, 0.2);
 }
 
 #head-1{
  width: 20%;
 }
 #head-2{
   width: 10%;
 }
 #head-3{
   width: 10%;
 }
 #head-4{
   width: 20%;
 }
 #head-5{
   width: 20%;
 }
 #head-6{
   width: 20%;
 }
 
 
 
 
 #match-1{
   width: 20%;
 }
 #match-2{
   width: 10%;
 }
 #match-3{
   width: 10%;
 }
 #match-4{
   width: 20%;
 }
 #match-5{
   width: 20%;
 }
 #match-6{
   width: 20%;
 }
 #no-det-invo{
   background: var(--text-grey);
   width: fit-content;
   border-radius: 10px;
   margin: 0 auto;
 }
 #no-det-invo h3{
   color: var(--beautiful);
   text-align: center;
   padding: .5rem;
   }

   .search-container .other-sort{
       display: flex;
       align-items: center;
       }
       .search-container .other-sort .select-wrapper{
       border: 1px solid var(--coolor);
       display: flex;
       }


       .btn-opp button{
           background: var(--main-color);
           padding: .5rem 1rem;
           color: var(--white);
           font-size: 1.2rem;
           border-radius: 5px;
       }

@media(max-width: 920px){
   #over-view-note{
   flex-direction: column;
   }
   .invoice-exist{
       width: 100%;
    margin-top: 10px;
   }
   .inv-pat-det{
       width: 100%;
     margin-top: 10px;
   }  
}

@media print{
   body *{
       visibility: hidden;
   }
   #invoice, #invoice *{
   visibility: visible;
   } 
   #invoice{
       position: absolute;
       /* position: relative; */
       left: 0;
       right: 0;
       top: 0;
       overflow-y: visible;
       page-break-inside: avoid;
   }
/* .invo-table-container table tr{
   
   page-break-inside: avoid;
} */

   #man-water-mark{
       position: fixed;
       bottom: 0;
    }
}
    </style>

        <script src="resources/CDN-links/jquery.min.js"></script>
    </head>
<body>


  
    <section id="Edit-pat-invo-card">
        <div class="field-form">
        <div id="canel-field-form"><i class="fa-solid fa-times"></i></div>
        <h2>Edit Invoice</h2>
        <div class="message-dis">
          <p></p>
          <label onclick="remMessage1()"><i class="fa-solid fa-times-square"></i></label>
        </div>
    
        <div class="message-dis-err">
          <p></p>
          <label onclick="remMessage1()"><i class="fa-solid fa-times-square"></i></label>
        </div>
    
        <div class="main-container">

        </div>
        </div>
        </section>



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
               <h2>Billing & Payments</h2>
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
                <section class="auto-list-cont">
                    <section class="search-container">
                        <div class="search-input-wrapper">
                         <input type="search" id="searchPatVisitInvoice" placeholder="search here...">
                         <i class="fa-solid fa-magnifying-glass"></i>
                        </div>
                        </section>
                        <div class="search-auto-list">
                        <p><strong>Search auto Suggestion...</strong></p>
                        <div class="list-container">

                        </div>
                        </div>
                </section>


                <section id="over-view-note">
                  
                </section>
 

                <div class="table-cont add-more-invo-service">
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
                    <input  id="save-btn" type="submit" onclick="AddServiceBillingInvoice()" value="Save invoice">
                    </form>
                    </div>




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
                        <section id="outer-table">
                            <div class="table-container">
                                
                        
                        
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


function showEditServiceCont(){
        $('#Edit-pat-invo-card').addClass('active')

        $('#Edit-pat-invo-card .field-form #canel-field-form').click(function(){
        $('#Edit-pat-invo-card').removeClass('active')
        remMessage1();
        });

}



         function viewInvoiceDetails(){
        $('#Show-pat-invo-card').addClass('active')

        $('#Show-pat-invo-card .field-form #canel-field-form').click(function(){
        $('#Show-pat-invo-card').removeClass('active')
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


            $("body").on("keyup",".txt_price",function(){
               var txt_price =Number($(this).val());
               var txt_qty = Number($(this).closest("#Edit-pat-invo-card .field-form .main-container form").find(".txt_qty").val());
               $(this).closest("#Edit-pat-invo-card .field-form .main-container form").find(".txt_total").val(txt_price*txt_qty);
               txt_grand_total ();
            });

          function txt_grand_total(){
                var txt_tot=0;
                $(".txt_total").each(function(){
                txt_tot += Number($(this).val());
                });
            }


            $("body").on("keyup",".txt_qty",function(){
               var txt_qty =Number($(this).val());
               var txt_price = Number($(this).closest("#Edit-pat-invo-card .field-form .main-container form").find(".txt_price").val());
               $(this).closest("#Edit-pat-invo-card .field-form .main-container form").find(".txt_total").val(txt_price*txt_qty);
               txt_grand_total();
            });


        });


             



    </script>
    <script type="text/javascript">
        function printInvoice(){
 
            window.print();
        
        }

 
        window.onload = function() {
  // Call your method here
  SearchPatientVisitInvoice();
  removeStates();
  changeVisitAllPatientInvoice();
  SearchPatientSingleVisitInvoice();
};


function removeStates(){
    window.history.replaceState(null, '', '/HMSMage/billing.php');
}


function remMessage1(){

const messagecont = document.querySelector("#Edit-pat-invo-card  .field-form .message-dis"),
messageconterr= document.querySelector("#Edit-pat-invo-card  .field-form .message-dis-err");

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

 
//         function DeleteListInvoice1(){
//   // display = document.querySelector("#Edit-pat-invo-card .field-form .main-container"),
//   const urlParams = new URLSearchParams(window.location.search),
//   paramValue = urlParams.get('product_name'),
//   paramValue1 = urlParams.get('V_ID'),
//   paramValue2 = urlParams.get('INVO_NUM'),
//   paramValue3 = urlParams.get('num_det');

  
//   var xmlhttp = new XMLHttpRequest();
//   xmlhttp.open("GET", "DeletListInvoice.php?product_name=" + paramValue + "&V_ID=" + paramValue1 + "&INVO_NUM=" + paramValue2 + "&num_det=" + encodeURIComponent(paramValue3), false);
//   xmlhttp.send(null);
//   // display.innerHTML=xmlhttp.responseText;
//   data = xmlhttp.responseText;
  
//   if(data == "success"){
//     alert("Deleted Successfully");
//   }


//   if(data == "failed"){
//     alert(" failed to Delete!");
//   }

//   if(data == "not set"){
//     alert("Can't Delete at this time");
//   }
  
//   }

    
//     ///edit services
// function EditServiceBillingInvoice1(){
     
//      const form = document.querySelector("#Edit-pat-invo-card .field-form .main-container form"),
//       loader = document.getElementById("loader"),
//       messagedis = document.querySelector("#Edit-pat-invo-card .field-form .message-dis p"),
//       messagecont = document.querySelector("#Edit-pat-invo-card .field-form .message-dis"),
//       messagediserr=document.querySelector("#Edit-pat-invo-card .field-form .message-dis-err p"),
//       messageconterr= document.querySelector("#Edit-pat-invo-card .field-form .message-dis-err"),
//       urlParams = new URLSearchParams(window.location.search),
//       paramValue = urlParams.get('product_name'),
//      paramValue1 = urlParams.get('V_ID'),
//      paramValue2 = urlParams.get('INVO_NUM'),
//      paramValue3 = urlParams.get('num_det');
   
//    form.onsubmit = (e)=>{
//      e.preventDefault();
//     //prevent form  submitting
//    } 
   
   
//     loader.style.display = "initial";
   
//    //Ajax code
//    let xhr = new XMLHttpRequest();
//    //create Xml oject
//    xhr.open("POST", "BillingbillingMore.php?product_name=" + encodeURIComponent(paramValue) + "&V_ID=" + encodeURIComponent(paramValue1) + "&INVO_NUM=" + encodeURIComponent(paramValue2) + "&num_det=" + encodeURIComponent(paramValue3), true);
//    xhr.onload = ()=>{
//    if(xhr.readyState === XMLHttpRequest.DONE){
//       if(xhr.status === 200){
       
//    loader.style.display = "none";
   
//     let data = xhr.response;
//     console.log(data);
   
   
//      if(data == "success"){
//        messagedis.innerHTML="Invoice updated Successfully!";
//        messagecont.style.display = "flex";
//        messageconterr.style.display = "none";  
//    }
   
//    if(data == "failed"){
//        messagediserr.innerHTML="Failed to update, Please cancel this window and Try Again";
//        messageconterr.style.display = "flex";
//        messagecont.style.display = "none";  
//    }
   
//    if(data == "empty"){
//      messagediserr.innerHTML="Please Fill All The fields";
//      messageconterr.style.display = "flex";
//      messagecont.style.display = "none";  
//    }
   
//    if(data == "not set"){
//      messagediserr.innerHTML="System error occurred Close this dialog window and try again!";
//      messageconterr.style.display = "flex";
//      messagecont.style.display = "none";  
//    }
   
//    ChangeInvoice();
   
//       }  
//    }
//    }
//    //send the form data throught ajax to php
//    let formData = new FormData(form); 
//    //new formData object
   
//    xhr.send(formData);
//    }
    </script>
 <script type="text/javascript" src="billingJS.js"></script>
 <script type="text/javascript" src="logoutJS.js"></script>

</body>
</html>