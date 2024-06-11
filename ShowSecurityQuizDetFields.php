<?php
session_start();
@include 'config.php';
$current_date = date("Y-m-d");


echo '<label><i class="fa-solid fa-question-circle"></i><span>Security Question.</span></label>';
if(isset($_COOKIE['text_role_hms']) && isset($_COOKIE['text_mail_hms'])){


$_SESSION['text_mail_hms']=$_COOKIE['text_mail_hms'];
$_SESSION['text_role_hms']=$_COOKIE['text_role_hms'];

$session_user=$_SESSION['text_mail_hms'];
$session_role=$_SESSION['text_role_hms'];

if($session_role == "admin"){
$select_admin_det = mysqli_query($conn, "SELECT security_quiz,quiz_ans FROM admin_data WHERE email_address='{$session_user}'");
if(mysqli_num_rows($select_admin_det) > 0){
  $row = mysqli_fetch_assoc($select_admin_det);
  $quiz = $row["security_quiz"];
  $ans= $row["quiz_ans"];
 
echo '
<form action="#" method="post">
<div class="select-cont">
<div class="wrapp-cont-security">
    <select name="text_security" onchange="clearField()">';
    if(!empty($quiz)){
       echo '<option value="'.$quiz.'">'.$quiz.'</option>';
    }
        echo '<option value="">--Select Security Quiz--</option>
        <option value="What is Your Favorite Hobby">What\'s Your Favorite Hobby</option>
        <option value="What is Your date of Birth">What\'s Your date of Birth</option>
        <option value="What is Your place of birth">What\'s Your place of birth</option>
        <option value="What is Your Favorite Meal">What\'s Your Favorite Meal</option>
        <option value="What is Your favorite Childhood Memory">What\'s Your favorite Childhood Memory</option>
        <option value="What is the nick name of your partner">What is the nick name of your partner</option>
        <option value="What is Your Favorite City">Name Your Favorite City</option>
        <option value="What is Your Favorite Pet">Name Your Favorite Pet</option>
        <option value="Type A random fun fact">Type A random fun fact</option>
        </select>
</div>
<div class="wrapp-cont-security">';
if(!empty($ans)){
echo '<input type="text" name="text_answer" id="ansQuiz" placeholder="enter answer..." value="-Answered-">';
}else{
    echo '<input type="text" id="ansQuiz" name="text_answer" placeholder="enter answer..." value="not Set...">';   
}

echo '</div>

</div>
<div class="btn-cont-opps">
    <button class="btn-add-answer" onclick="AddsecurityQuiz()"><i class="fa-solid fa-save"></i>Save Answer</button>
</div>
</form>
';
   
}else{
echo '

';
}
}else{
  $select_other_det = mysqli_query($conn, "SELECT security_quiz,quiz_ans FROM employee_data WHERE email_address='{$session_user}'");
if(mysqli_num_rows($select_other_det) > 0){
  $row = mysqli_fetch_assoc($select_other_det);
  $quiz = $row["security_quiz"];
  $ans= $row["quiz_ans"];

  echo '
  <form action="#" method="post">
  <div class="select-cont">
  <div class="wrapp-cont-security">
      <select name="text_security" onchange="clearField()">';
      if(!empty($quiz)){
         echo '<option value="'.$quiz.'">'.$quiz.'</option>';
      }
          echo '<option value="">--Select Security Quiz--</option>
          <option value="What is Your Favorite Hobby">What\'s Your Favorite Hobby</option>
          <option value="What is Your date of Birth">What\'s Your date of Birth</option>
          <option value="What is Your place of birth">What\'s Your place of birth</option>
          <option value="What is Your Favorite Meal">What\'s Your Favorite Meal</option>
          <option value="What is Your favorite Childhood Memory">What\'s Your favorite Childhood Memory</option>
          <option value="What is the nick name of your partner">What is the nick name of your partner</option>
          <option value="Type A random fun fact">Type A random fun fact</option>
          </select>
  </div>
  <div class="wrapp-cont-security">';
  if(!empty($ans)){
  echo '<input type="text" name="text_answer" placeholder="enter answer..." id="ansQuiz" value="-Answered-">';
  }else{
      echo '<input type="text" name="text_answer" placeholder="enter answer..." id="ansQuiz" value="not Set...">';   
  }
  
  echo '</div>
  
  </div>
  <div class="btn-cont-opps">
      <button class="btn-add-answer" onclick="AddsecurityQuiz()"><i class="fa-solid fa-save"></i>Save Answer</button>
  </div>
  </form>
  ';
}else{
echo '

';
}
}

}else{

echo '
<div class="not-data-sec">
<h3>No Data Available...</h3>
</div>';

}



?>