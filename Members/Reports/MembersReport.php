<?php
//include pdf_mc_table.php, not fpdf17/fpdf.php
include('pdf_mc_table.php');
$conn = mysqli_connect("localhost", "pasodomo_oscar", "Oscar3296!!!", "pasodomo_pasodo");

//make new object
$pdf = new PDF_MC_Table();
$pdf->AliasNbPages('{pages}');

//add page, set font
$pdf->AddPage();
$pdf->SetFont('Arial','',14);

//set width for each column (6 columns)
$pdf->SetWidths(Array(10,25,25,25,10,25,25,20,25));

//set alignment
//$pdf->SetAligns(Array('','R','C','','',''));

//set line height. This is the height of each lines, not rows.
$pdf->SetLineHeight(5);

//Query the Database
	$sql = "SELECT * FROM rotausersduty";
	$result = $conn->query($sql);
	$x = 1;
	while($row = $result->fetch_assoc()){
		//User Details
		$pdf->Cell(10,5,$x,1,0,'',false);
		$pdf->Cell(25,5,$row['userName'],1,0,'',false);
		$pdf->Cell(25,5,$row['morningDuty'],1,0,'',false);
		$pdf->Cell(25,5,$row['morningVenue'],1,0,'',false);
		$pdf->Cell(10,5,'',1,0,'',false);
		$pdf->Cell(25,5,$row['afternoonDuty'],1,0,'',false);
		$pdf->Cell(25,5,$row['afternoonVenue'],1,0,'',false);
		$pdf->Cell(20,5,' ',1,0,'',false);
		$pdf->Cell(25,5,$row['comment'],1,1,'',false);

		$x++;
	}

//output the pdf
$pdf->Output();

