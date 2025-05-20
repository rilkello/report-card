<?php
require "fpdf.php";

class mypdf extends fpdf{
function header(){
$this->Image('logo2.jpg',10,10,30,30);
$this->Ln();

//$this->Ln();
//$this->cell(48,8,'Kimathi Road',0,0,'R');
//$this->cell(142,8,'Tel: 0783038893 | 07946474747',0,0,'R');
//$this->Ln();
/*
$this->setfont('Times','B',14);
$this->cell(180,5,'Kanombe,Kicukiro',0,0,'C'); */
//$this->cell(144,8,'Email: infoefotec@gmail.com',0,0,'R');
//$this->Ln();  
//$this->cell(190,8,'Website: www.eskanombe.com',0,0,'C');
//$this->Ln();
///$this->cell(190,8,'Website: www.eskanombe.com',0,0,'C');
///////$this->Ln();


}
function footer(){
$this->setY(-30);
$this->setfont('Arial','i',12);
$this->cell(70,8,'Class Teacher signature',0,0,'L');
$this->cell(190,8,'Headmaster signature',0,0,'C');
//$this -> SetLineWidth(1);
//$this -> Line(0, 275, 279,275);
//////$this->Ln(); 
$this->cell(0,8,'For Quality Education to Take You Places.',0,0,'C');
}

function headertable(){
include 'config/db.php';
$class = "S1A";
$term = $_POST['term'];

$sql ="SELECT  * from marks where class like '%$class%' and term like '%$term%' group by fname order by fname ASC";
$result = $conn->query($sql);

while($row = mysqli_fetch_assoc($result)){
$this -> SetLineWidth(2);
$this -> Line(0, 55, 210, 55);
$this -> SetLineWidth(0.2);


//$this->Ln();
$this->setfont('Times','B',14);
//$fname = $row["fname"];


$this->setfont('Times','B','12');
$this->cell(160,5,'REPUBLIC OF RWANDA',0,0,'C');
$this->cell(-24,5,'class :',0,0,'R');
$this->setfont('Times','i',14);
$this->cell(80,5,$class,0,0,'L');
$this->Ln();

$this->setfont('Times','B',14);
$this->cell(160,8,'Kanombe,Kicukiro',0,0,'C');
$this->cell(-23,8,'Term :',0,0,'R');
$this->setfont('Times','i',12);
$this->cell(80,8,$term,0,0,'L');
$this->Ln();

$this->setfont('Times','B',14);
$this->cell(160,8,'Kanombe,Kicukiro',0,0,'C');
$this->setfont('Times','B',14);
$this->cell(-5,8,'Student name :',0,0,'R');
$this->setfont('Times','i',14);
$this->cell(80,8,($row["fname"]),0,0,'L');
$this->Ln();

$fname = $row['fname'];

$this->setfont('Times','B',14);
$this->cell(160,8,'Kanombe,Kicukiro',0,0,'C');
$this->cell(8,8,'Student reg number :',0,0,'R');
$this->setfont('Times','i',14);
//$this->cell(80,8,($row["regno"]),0,0,'L');
$this->Ln();
    
$this->setfont('Times','B',14);
$this->cell(53,10,'ATTENDANCE :',0,0,'L');
$this->setfont('Times','',14);
$this->cell(50,10,'Very Good : .............',0,0,'L');
$this->cell(50,10,'Good : .............',0,0,'L');
$this->cell(50,10,'Poor : .............',0,0,'L');
$this->Ln();
$this->Ln();

$this->setfont('Times','B',12);
$this->cell(73,8,'TOTAL',1,0,'C');
$this->cell(38,8,' TERM 1 ',1,0,'C');
$this->cell(38,8,'TERM 2',1,0,'C');
$this->cell(38,8,'TERM 3',1,0,'C');

$this->Ln();
$this->setfont('Times','B',12);
$this->cell(35,8,'SUBJECTS',1,0,'C');
$this->cell(12,8,' CAT ',1,0,'C');
$this->cell(12,8,' EX ',1,0,'C');
$this->cell(14,8,' TOT ',1,0,'C');
 
$this->cell( 12,8,' CAT ',1,0,'C');
$this->cell(12,8,' EX ',1,0,'C');
$this->cell( 14,8,' TOT ',1,0,'C');

$this->cell( 12,8,' CAT ',1,0,'C');
$this->cell(12,8,' EX ',1,0,'C');
$this->cell(14,8,' TOT ',1,0,'C');
 
$this->cell( 12,8,' CAT ',1,0,'C');
$this->cell(12,8,' EX ',1,0,'C');
$this->cell(14,8,' TOT ',1,0,'C');

$this->Ln();
    
$sqlm ="SELECT * from marks where term like '%$term%' and class like '%$class%' and fname like '%$fname%' group by subject order by subject DESC";
$resultm = $conn->query($sqlm);
    

while($row =  mysqli_fetch_assoc($resultm)){
$this->setfont('Times','',12);

$this->cell(35,8,($row["subject"]),1,0,'L');
$this->cell(12,8,($row["outof"]),1,0,'C');
$this->cell(12,8,($row["value"]),1,0,'C');
$this->cell(14,8,($row["outof"]),1,0,'C');
$this->cell(12,8,($row["value"]),1,0,'C');
$this->cell(12,8,($row["outof"]),1,0,'C');
$this->cell(14,8,' ',1,0,'C');
$this->cell(12,8,($row["outof"]),1,0,'C');
$this->cell(12,8,($row["value"]),1,0,'C');
$this->cell(14,8,($row["outof"]),1,0,'C');
$this->cell(12,8,($row["value"]),1,0,'C');
$this->cell(12,8,($row["outof"]),1,0,'C');
$this->cell(14,8,' ',1,0,'C'); 
$this->Ln();
} 
$this->Ln();
/*$total = 0;
$sql = "select average from marks where admno = '$admno' ";
$result = $conn->query($sql);
while($row =  mysqli_fetch_assoc($result)){
$total = $total+($row["average"]);
} 
$this->cell(55,12,'Total Marks',0,0,'L');
$this->cell(40,12,round($total,2),0,0,'L');

$this->cell(55,12,'Mean Grade',0,0,'L');

if($total/11 < 30){
$this->cell(40,12,'E',0,0,'L');
}
else if($total/11 < 40){
$this->cell(40,12,'D',0,0,'L');
}
else if($total/11 < 60){
$this->cell(40,12,'C',0,0,'L');
}
else if($total/11 < 80){
$this->cell(40,12,'B',0,0,'L');
}
else if($total/11 <= 100){
$this->cell(40,12,'A',0,0,'L');
}
else{
$this->cell(40,12,'Invalid',0,0,'L');
} */

$this->Ln();
$this->setfont('Times','B',14);
$this->cell(35,10,'REMARKS :',0,0,'L');
//$this->setfont('Arial','iu',14);
$this->cell(40,10,'Work hard to maintain your Grade',0,0,'L');

$this->Ln();


$this->setfont('Times','B',14);
//$this->cell(70,15,'Principal',0,0,'L');
//$this->cell(190,15,'Class Teacher',0,0,'C');
$this -> Line(10, 265, 50,265);
$this -> Line(150, 265, 200,265);
$this->AddPage();
//$this -> Line(5, 55, 205, 55);
$this->Ln();
$this->setfont('Times','B',20);
}
}//////////////////////////
}

$pdf = new mypdf();
$pdf->AliasNbpages();
$pdf->Addpage('P','A4',0);
$pdf->headertable();
$pdf->Output();
?>
