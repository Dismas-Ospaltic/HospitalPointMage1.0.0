<?php 
require ("fpdf/fpdf.php");
if(isset($_GET["HSPN"]) && isset($_GET["V_ID"])){

    class PDF extends FPDF
    {
    function body(){
    @include 'config.php';
    $hospital_unique = mysqli_real_escape_string($conn, $_GET["HSPN"]);
    $VISIT_ID= mysqli_real_escape_string($conn, $_GET["V_ID"]);
   //select patient dets
   $patientExist = false;
   $select_patient_det = mysqli_query($conn, "SELECT first_name,last_name,middle_name,p_med_hist,age,gender,hospital_patient_no FROM patient_details WHERE hospital_patient_no='{$hospital_unique}'");
   if(mysqli_num_rows($select_patient_det) > 0){
    $patientExist = true;
    $row_det =mysqli_fetch_assoc($select_patient_det);
     $patient_name = $row_det["first_name"]." ".$row_det["middle_name"]." ".$row_det["last_name"];
    $hspt_reg =$row_det["hospital_patient_no"];
    $gender = $row_det["gender"];
    $age = $row_det["age"];
    $p_medical_hist = $row_det["p_med_hist"];
   }else{
    $patientExist = false;
   }
   //@end




   //select doc nots from sub visit
   $subvisitExists=false;
   $select_visits_det =mysqli_query($conn, "SELECT * FROM patient_sub_visit WHERE hospital_patient_no='{$hospital_unique}' AND visit_id='{$VISIT_ID}'");

   if(mysqli_num_rows($select_visits_det) > 0){
    $subvisitExists= true;
    $data1 = mysqli_fetch_assoc($select_visits_det);


   $res1=$data1['cheif_complaint'];
   $res2=$data1['doctor_note'];
   $res3=$data1['diagnosis'];
   $res4=$data1['medication'];

   $res1=explode(";",$res1);
   $res2=explode(";",$res2);
   $res3=explode(";",$res3);
   $res4=explode(";",$res4);

   $count1=count($res1)-1;
   $count2=count($res2)-1;
   $count3=count($res3)-1;
   $count4=count($res4)-1;

   }else{
    $subvisitExists=false;
   }
   //@end

if($subvisitExists && $patientExist){
$this->SetFont('Arial', 'B', 24);
$this->SetTextColor(9, 240, 163);
$this->Cell(0, 10, 'Patient visit overview Notes', 0, 1, 'C');

$this->SetTextColor(0, 0, 0);
$this->SetX(10);
$this->SetFont('Arial', '', 12);
$this->Ln(1);
$this->MultiCell(0, 10, "Patient Name: $patient_name $age year old $gender");

$x = $this->GetX();
$y = $this->GetY();
$w = $this->GetStringWidth("Hospital Reg No.: $hspt_reg") +10;
$h = 10;

$this->SetFillColor(0, 0, 9);
$this->Rect($x, $y, $w, $h, 'F');
$this->SetTextColor(255, 255, 255); // Set text color to white for the background cell
$this->MultiCell(0, 10, "Hospital Reg No.: $hspt_reg");


$this->SetFont('Arial', 'B', 15);
$this->SetTextColor(9, 240, 163);
$this->Cell(0, 10, 'Patient Medical History', 0, 1, 'L');
$this->SetFont('Arial', '', 10);
$this->SetTextColor(0, 0, 0);


if(!empty($p_medical_hist)){
    $select_med_history = mysqli_query($conn, "SELECT p_med_hist FROM patient_details WHERE hospital_patient_no='{$hospital_unique}'");
     $data5=mysqli_fetch_array($select_med_history);
     $res5=$data5['p_med_hist'];

     $res5=explode(";",$res5);

     $count5=count($res5)-1;

     for($i=0; $i<=$count5;$i++){
      $split_med_his=$res5[$i];
      $this->MultiCell(0,4,"$split_med_his");
    }

  }else{
  $this->MultiCell(0,10,"No Medical History To Show");
  }



  $this->SetFont('Arial', 'B', 15);
$this->SetTextColor(9, 240, 163);
$this->Cell(0, 10, 'Doctor\'s Note', 0, 1, 'L');
$this->SetFont('Arial', '', 10);
$this->SetTextColor(0, 0, 0);
for($i=0; $i<=$count2;$i++){
    $split_doc_notes=$res2[$i];
    if(!empty($split_doc_notes)){
        $this->MultiCell(0,4,"$split_doc_notes");
    }else{
        $this->MultiCell(0,4,"not added...");   
    }
  }


  $this->SetFont('Arial', 'B', 15);
$this->SetTextColor(9, 240, 163);
$this->Cell(0, 10, 'Cheif Complaits', 0, 1, 'L');
$this->SetFont('Arial', '', 10);
$this->SetTextColor(0, 0, 0);

for($i=0; $i<=$count1;$i++){
    $split_cheif_complaint=$res1[$i];

    if(!empty($split_cheif_complaint)){
        $this->MultiCell(0,4,"$split_cheif_complaint");
    }else{
        $this->MultiCell(0,4,"not added...");   
    }
  }

 
  $this->SetFont('Arial', 'B', 15);
$this->SetTextColor(9, 240, 163);
$this->Cell(0, 10, 'Diagnosis', 0, 1, 'L');
$this->SetFont('Arial', '', 10);
$this->SetTextColor(0, 0, 0);

for($i=0; $i<=$count3;$i++){
    $split_diagnosis=$res3[$i];

    if(!empty($split_diagnosis)){
        $this->MultiCell(0,4,"$split_diagnosis");
    }else{
        $this->MultiCell(0,4,"not added...");   
    }
  }



$this->SetFont('Arial', 'B', 15);
$this->SetTextColor(9, 240, 163);
$this->Cell(0, 10, 'Treatment And Medication', 0, 1, 'L');
$this->SetFont('Arial', '', 10);
$this->SetTextColor(0, 0, 0);

for($i=0; $i<=$count4;$i++){
    $split_medication=$res4[$i];

    if(!empty($split_medication)){
        $this->MultiCell(0,4,"$split_medication");
    }else{
        $this->MultiCell(0,4,"not added...");   
    }
 
}
}else{
    $this->SetFont('Arial', 'B', 24);
    $this->SetTextColor(9, 240, 163);
    $this->Cell(0, 100, 'Nothing to show', 0, 1, 'C');
}



    }


    
        function Footer() {
            $this->SetY(-15); // Move 15 units from the bottom (adjust as needed)
            $this->SetFont('Arial', '', 10); // Adjust font and size as needed
            $this->Cell(0, 10, "Page " . $this->PageNo() . " of {nb}", 0, 0, 'C');
            $this->SetY(-20);
            $this->SetTextColor(213, 9, 240); 
            $this->Cell(0, 10, "created by ospaltic software Solutions. EMAIL: ospaltic@gmail.com, CONTACT: +254742354784", 0, 1, 'C');
           
        } 
    
    }

    

    //Create A4 Page with Portrait 
  $pdf=new PDF("P","mm","A4");
  $pdf->AliasNbPages();
  $pdf->AddPage();
  $pdf->body();
  $pdf->Output();
  

}else{
    header("Location: patient.php");
}
?>