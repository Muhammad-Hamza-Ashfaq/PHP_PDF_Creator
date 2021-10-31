<?php
 function fetch_data()  
 {  
      $output = '';  
      $connect = mysqli_connect("localhost", "root", "", "state");  
      $sql = "SELECT * FROM employee ORDER BY id ASC";  
      $result = mysqli_query($connect, $sql);  
      while($row = mysqli_fetch_array($result))  
      {       
      $output .= '<tr>  
                          <td><b>'.$row["id"].'</b></td>  
                          <td>'.$row["name"].'</td>  
                          <td>'.$row["gender"].'</td>  
                          <td>'.$row["designation"].'</td>  
                          <td>'.$row["age"].'</td>  
                     </tr>  
                          ';  
      }  
      return $output;  
 }  
 if(isset($_POST["create_pdf"]))  
 {
require_once "tcpdf/tcpdf.php";
require_once "tcpdf/config/tcpdf_config.php";

class MyPdf extends TCPDF{
    public function Header()
    {
        $imageFile = K_PATH_IMAGES.'logo1.png';
        $this->Image($imageFile, 20, 6, 20, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        $this->Ln(5); //font name size style
        $this->setFont('helvetica', 'B',12);
        //189 IS TOTAL WIDTH OF A4 SIZE PAGE
        //$this->Cell(Width, Height, text, border, line )
        $this->Cell(189,5,'Muhammad Hamza Ashfaq',0,1,'C');
        $this->SetFont('helvetica', '', 8);
        $this->Cell(189,4,'Roll No: 14921',0,1,'C');
        $this->Cell(189,3,'Class: BSCS 7th (Morning)',0,1,'C');
        $this->Cell(189,3,'Ph: +923030424951',0,1,'C');
        $this->Cell(189,3,'Reg No: 2017-GCUF-05323',0,1,'C');
        $this->Cell(189,3,'Email: h.ashfaq16@gmail.com',0,1,'C');
        $this->SetFont('helvetica','B',11);
        $this->Ln(2); //space
        $this->Cell(189, 8, 'STUDENT INFORMATION', 0, 1,'C');

    }

    public function Footer(){
        $this->SetY(-148); //Position at 15 mm from Bottom
        $this->ln(5);
        $this->SetFont('times','B', 10);
        $this->MultiCell(189, 3, 'I __________ S/O __________ is a student at GCUF. I am doing
        ___________degree at ___________ campus of GCUF. I am a student of batch __________.
        My CNIC is _____________________ and my registration number is _____________.',0,'J',0,1,'','',true);
        $this->Ln(2);
        $this->Cell(20,1,'________________________',0,0);
        $this->Cell(118,1,'',0,0);
        $this->Cell(51,1,'________________________',0,1);
        $this->Cell(20,5,'Authorized Signature',0,0);
        $this->Cell(118,5,'',0,0);
        $this->Cell(51,5,'Student Signature',0,1);
        

        $this->Cell(8,1,'',0,0);
        $this->Cell(181,8,'(Offce Use)',0,0);
        $this->Ln(5);
        $this->Cell(100,15,'Student Information Validation Form',0,1,'R');
        $this->Cell(110,5,'Please Attach relevant Documents',0,1,'C');
        $this->Cell(79,5,'',0,1,'C');
        $this->Cell(110,5,'DSE Clearing A/C -----------------------------',0,0);
        $this->Cell(79,5,'Exchange ID------------------------------------',0,1,'C');
        $this->Ln(5);
        $this->Cell(110,5,'CSE Clearing A/C -----------------------------',0,0);
        $this->Cell(79,5,'Exchange ID------------------------------------',0,1,'C');
        $this->Ln(4);
        $this->setFont('times', 'B', 10);
        $this->Cell(189,5,"DECLARATION", 0, 1,'L');
        
        $this->setFont('times', '', 10);
        $html = '<p style="text-align:justify">The Rules And Regulations of GCUF are very strict in the context
        of Validation.Please Provide exact information to the Authorities of Campus. Otherwise in case of
        miscellaneous information, the candidate would be liable to have been canceled from the candidature.
        It is a declaration that, I declare that I have provided sufficient and full authentic information
        as far as I know. I declare that the particulars provided by me are true and I agree that in case of
        any misleading information, I would be charged/Punished by the University.</p> ';
        $this->writeHTML($html, true, false, true, false, ""  );
    
        $this->Ln(2);
        $this->Cell(20,1,'________________________',0,0);
        $this->Cell(118,1,'',0,0);
        $this->Cell(51,1,'________________________',0,1);
        $this->Cell(20,5,'Authorized Signature',0,0);
        $this->Cell(118,5,'',0,0);
        $this->Cell(51,5,'Student Signature',0,1);

        $this->setFont('helvetica','I',8);
        date_default_timezone_set("Asia/Dhaka");
        $today = date("F j, Y/ g:i A", time());
        $this->Cell(25,5,'Generation Date/Time: '. $today, 0, 0, 'L');
        $this->Cell(164, 5, 'Page'. $this->getAliasNumPage().' of  ' . $this->getAliasNbPages(),0, false, 'R', 0, '',0,false, 'T', 'M');
    
    
    
    
    }

}
$pdf = new MyPdf('P', 'mm', 'A4', true, 'UTF-8' , false);
$pdf->setCreator(PDF_CREATOR);
$pdf->setAuthor('M.Hamza Ashfaq');
$pdf->setTitle("GCUF_PORTFOLIO_PDF");
$pdf->setHeaderData(PDF_HEADER_LOGO, '25', 'GCUF_PORTFOLIO_PDF', "By M.Hamza Ashfaq",array(55,23,155), array(0,64,228));
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
$pdf->SetDefaultMonospacedFont('helvetica');
$pdf->setMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->setHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
$pdf->setAutoPageBreak(TRUE, '10');
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
$pdf->setFont('times', '', 12);
$pdf->AddPage();

// $this->Cell(0, 15, '<< M.Hamza Ashfaq >>', 0, false, 'C', 0, '', 0, false, 'M', 'M');

//(M.Hamza Ashfaq, 14921) we are Customizing page header and footer are defined by extending the TCPDF class and overriding the Header() and Footer() methods/functions.
//EOD;

$content = '';  
      $content .= '  
       <h3 align="center"></h3><br /><br />
       <h3 align="center"></h3><br /><br />
       <h3 align="center" style="background-color:darkred;color:white;">Candidates List</h3><br /><br />
       <h3 align="center" style="color:darkred";>If your name exists in the List, Then Provide your information below!</h3><br /><br />  
       <table border="1" cellspacing="0" cellpadding="5" style="background-color:pink;">  
           <tr>  
                <th width="5%">ID</th>  
                <th width="30%">Name</th>  
                <th width="10%">Gender</th>  
                <th width="45%">Designation</th>  
                <th width="10%">Age</th>  
           </tr>  
      ';  
      $content .= fetch_data();  
      $content .= '</table>';  
      $pdf->writeHTML($content);  



$pdf->Output('gcugeneratepdf.pdf', 'I');
 }  
?>
<!DOCTYPE html>  
 <html>  
      <head>  
           <title>14921_M.Hamza Ashfaq</title>  
           <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />            
      </head>  
      <body style="background-color:pink;">  
           <br /><br />  
           <div class="container" style="width:700px;">  
                <h3 align="center" style="background-color:darkred;color:white;">Exporting HTML Table data to PDF using TCPDF in PHP</h3><br />  
                <div class="table-responsive">  
                     <table class="table table-bordered" style="background-color:darkred;color:pink;height:360px">  
                          <tr>  
                               <th width="5%">ID</th>  
                               <th width="30%">Name</th>  
                               <th width="10%">Gender</th>  
                               <th width="45%">Designation</th>  
                               <th width="10%">Age</th>  
                          </tr>  
                     <?php  
                     echo fetch_data();  
                     ?>  
                     </table>  
                     <br />  
                     <form method="post">  
                          <input type="submit" name="create_pdf" class="btn btn-danger" value="Create PDF" />  
                     </form>  
                </div>  
           </div>  
      </body>  
 </html>  
 
 <!--14921-Muhammad Hamza Ashfaq-->