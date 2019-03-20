<?php 
ob_start();
	require "fpdf17/fpdf.php";
	$db = new PDO('mysql:host=localhost;dbname=pasodomo_pasodo','pasodomo_oscar','Oscar3296!!!');

	class myPDF extends FPDF{
		function header(){
			$this->Image('../../img/logo.png',10,10,10);
			$this->SetFont('Arial','B',14);
			$this->Cell(276,5,'ROTA FOR CHAMBER AND COMMITTEES - AUDIO OFFICERS',0,0,'C');
			$this->Ln();
			$this->SetFont('Times','',12);
			$this->Cell(276,10,'Blah Blah Blah',0,0,'C');
			$this->Ln(20);

			$this->SetFont('Times','B',12);
			$this->Cell(45, 10, "", 0,0);
			$this->Cell(70,10,'Morning',0,0,'C');
			$this->Cell(10,10,'',0,0,'C');
			$this->Cell(70,10,'Afternoon',0,0,'C');
			$this->Cell(81,10,'',0,0,'C');
			$this->Ln();
		}
		function footer(){
			$this->SetY(-15);
			$this->SetFont('Arial','',8);
			$this->Cell(0,10,'Page '.$this->PageNo(). '/{nb}',0,0,'C');
		}
		function headerTable(){
			$this->SetFont('Times','B',12);
			$this->Cell(10,10,'',1,0,'C');
			$this->Cell(35,10,'Name',1,0,'C');
			$this->Cell(35,10,'Duty',1,0,'C');
			$this->Cell(35,10,'Venue',1,0,'C');
			$this->Cell(10,10,'',1,0,'C');
			$this->Cell(35,10,'Duty',1,0,'C');
			$this->Cell(35,10,'Venue',1,0,'C');
			$this->Cell(20,10,'Sign',1,0,'C');
			$this->Cell(61,10,'Comment',1,0,'C');
			$this->Ln();
		}
		function viewTable($db){
			$this->SetFont('Times','',12);
			$stmt = $db->query('SELECT * FROM rotausersduty');
			while($data = $stmt->fetch(PDO::FETCH_OBJ)) {
				$this->Cell(10,10,'',1,0,'C');
				$this->Cell(35,10,$data->userName,1,0,'L');
				$this->Cell(35,10,$data->morningDuty,1,0,'L');
				$this->Cell(35,10,$data->morningVenue,1,0,'L');
				$this->Cell(10,10,'',1,0,'L');
				$this->Cell(35,10,$data->afternoonDuty,1,0,'L');
				$this->Cell(35,10,$data->afternoonVenue,1,0,'L');
				$this->Cell(20,10,'',1,0,'L');
				$this->Cell(61,10,$data->comment,1,0,'L');
				$this->Ln();
			}
		}
	}

	$pdf = new myPDF();
	$pdf->AliasNbPages();
	$pdf->AddPage('L','A4',0);
	$pdf->headerTable();
	$pdf->viewTable($db);
	$pdf->Output();

	ob_get_flush();
 ?>