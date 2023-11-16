<?php
require ("fpdf/fpdf.php");

function generateReceipt($info, $products_info) {
    class PDF extends FPDF {
        function Header(){
      
            //Display Company Info
            $this->SetFont('Arial','B',14);
            $this->Cell(50,10,"Travurr",0,1);
            $this->SetFont('Arial','',14);
            $this->Cell(50,7,"Jalan Tasik Raja Lumu U4/17,",0,1);
            $this->Cell(50,7,"40150 Shah Alam, Selangor",0,1);
            $this->Cell(50,7,"Phone: +601 67591246",0,1);
            
            //Display INVOICE text
            $this->SetY(15);
            $this->SetX(-40);
            $this->SetFont('Arial','B',18);
            $this->Cell(50,10,"INVOICE",0,1);
            
            //Display Horizontal line
            $this->Line(0,48,210,48);
          }
          
          function body($info,$products_info){
            
            //Billing Details
            $this->SetY(55);
            $this->SetX(10);
            $this->SetFont('Arial','B',12);
            $this->Cell(50,10,"Bill To: ",0,1);
            $this->SetFont('Arial','',12);
            $this->Cell(50,7,$info["customer"],0,1);
            $this->Cell(50,7,$info["address"],0,1);
            
            //Display Invoice no
            $this->SetY(55);
            $this->SetX(-60);
            $this->Cell(50,7,"Invoice No : ".$info["invoice_no"]);
            
            //Display Invoice date
            $this->SetY(63);
            $this->SetX(-60);
            $this->Cell(50,7,"Invoice Date : ".$info["invoice_date"]);
            
            //Display Table headings
            $this->SetY(95);
            $this->SetX(10);
            $this->SetFont('Arial','B',12);
            $this->Cell(80,9,"DESCRIPTION",1,0);
            $this->Cell(40,9,"PRICE",1,0,"C");
            $this->Cell(30,9,"QTY",1,0,"C");
            $this->Cell(40,9,"TOTAL",1,1,"C");
            $this->SetFont('Arial','',12);
            
            //Display table product rows
            foreach($products_info as $row){
              $this->Cell(80,9,$row["name"],"LR",0);
              $this->Cell(40,9,$row["price"],"R",0,"R");
              $this->Cell(30,9,$row["qty"],"R",0,"C");
              $this->Cell(40,9,$row["total"],"R",1,"R");
            }
            //Display table empty rows
            for($i=0;$i<12-count($products_info);$i++)
            {
              $this->Cell(80,9,"","LR",0);
              $this->Cell(40,9,"","R",0,"R");
              $this->Cell(30,9,"","R",0,"C");
              $this->Cell(40,9,"","R",1,"R");
            }
            //Display table total row
            $this->SetFont('Arial','B',12);
            $this->Cell(150,9,"TOTAL",1,0,"R");
            $this->Cell(40,9,$info["total_amt"],1,1,"R");
            
            //Display amount in words
            $this->SetY(225);
            $this->SetX(10);
            
          }
          function Footer(){
            
            //set footer position
            $this->SetY(-50);
            $this->SetFont('Arial','B',12);
            $this->Cell(0,10,"for Travurr Sdn Bhd",0,1,"R");
            $this->Ln(15);
            $this->SetFont('Arial','',12);
            $this->Cell(0,10,"No Signature require for E-receipt",0,1,"R");
            $this->SetFont('Arial','',10);
            
            //Display Footer Text
            $this->Cell(0,10,"This is a computer generated invoice",0,1,"C");
            
          }
    }
    ob_end_clean(); //    the buffer and never prints or returns anything.
    ob_start(); 
    $pdf = new PDF("P", "mm", "A4");
    $pdf->AddPage();
    $pdf->body($info, $products_info);
    $pdf->Output('I');
    ob_end_flush();
}