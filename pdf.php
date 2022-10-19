<?php
session_start();
include("connect.php");
if ($_GET['uid']) {
	$user_id = $_GET['uid'] / 69;

	
} else {
	if ($_SESSION['id']) {
		$user_id = $_SESSION['id'];
	} else {
		header("Location: https://sommernachtstraum.me/");
	}
}

$sql_user = "SELECT * FROM kunden_demo WHERE id = '$user_id'";
$result_user = mysqli_query($connect, $sql_user);
$fetch_user = mysqli_fetch_assoc($result_user);


$aufführung = $fetch_user['Auffuerung'];

$payment_method = $fetch_user['Payment_method'];
$paid = $fetch_user['Paid'];

if ($paid == "Nein") {
	$paid = '<b color="red">Unbezahlt</b> (' . $fetch_user['Datum'] . ')';
} else {
    if($paid == "Ja"){
	$paid = '<b color="green">Bezahlt</b>';
    }
    else{
        $paid = '<b color="orange">Unbekannt</b> (' . $fetch_user['Datum'] . ')';
        
    }
}

$sql_place = "SELECT * FROM plätze_demo WHERE usr_id = '$user_id'";
$result_place = mysqli_query($connect, $sql_place);

$plätze = array();

while ($row = mysqli_fetch_assoc($result_place)) {
	$location = $row['Location'];
	$locationArray = explode('/', $location);
	$aufführung = $row['aufführung'];

	if ($aufführung == 1) {
		$date = "12 Mai";
		$time = "18:30";
		$first_check = 1;
	}
	if ($aufführung == 2) {
		$date = "13 Mai";
		$time = "18:30";
		$second_check = 1;
	}

	if ($row['kinder'] == 1) {
		$price = 20;
	} else {
		$price = 25;
	}

	if ($locationArray[1] == 1) {
		$table = "A";
	}
	if ($locationArray[1] == 2) {
		$table = "B";
	}
	if ($locationArray[1] == 3) {
		$table = "C";
	}
	if ($locationArray[1] == 4) {
		$table = "D";
	}
	if ($locationArray[1] == 5) {
		$table = "E";
	}
	if ($locationArray[1] == 6) {
		$table = "F";
	}
	if ($locationArray[1] == 7) {
		$table = "G";
	}
	if ($locationArray[1] == 8) {
		$table = "H";
	}
	array_push($plätze, array($table, $locationArray[0], $price, $date, $time));
}

require_once('TCPDF/TCPDF-main/examples/tcpdf_include.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Valentin Nussbaumer');
$pdf->SetTitle('Ticket_' . $user_id . '');
$pdf->SetSubject('Ticket_' . $user_id . '');
// set default header data
$pdf->setFooterData(array(0,64,0), array(0,64,128));

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->setDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->setMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->setHeaderMargin(PDF_MARGIN_HEADER);
$pdf->setFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->setAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set default font subsetting mode
$pdf->setFontSubsetting(true);

// Set font
// dejavusans is a UTF-8 Unicode font, if you only need to
// print standard ASCII chars, you can use core fonts like
// helvetica or times to reduce file size.
$pdf->setFont('dejavusans', '', 14, '', true);

// Add a page
// This method has several options, check the source code documentation for more information.
$pdf->AddPage();

// set text shadow effect
$pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));

// Set some content to print
$header = '
<b style="font-size: 22px;">Ein Sommernachtstraum</b>
<a style="color:gray; font-size: 13px;" href="mailto: contact@sommernachtstraum.me">contact@@sommernachtstraum.me</a>
<a style="color:gray; font-size: 13px;" href="https://sommernachtstraum.me">sommernachtstraum.me</a>';

if ($first_check == 1 && $second_check == 1) {
	$date_time = "";
} else {
	$date_time = '<br><br><b>Datum: ' . $date . '
Zeit: ' . $time . '</b><br>';
}

$footer = "
<b>Zahlungsmethode:</b> $payment_method
$paid";


$pdfName = 'Ticket_' . $user_id . '.pdf';


$html = '
<table cellpadding="5" cellspacing="0" style="width: 100%; ">
	<tr>
		<td>' . nl2br(trim($header)) . '</td>
	   <td style="text-align: right">
	   Riedsteegsaal<br>
	   Bergstrasse 111<br>
	    8707 Uetikon am See<br> 
		</td>
	</tr>

	<tr>
		 <td style="font-size:20px; font-weight: bold;">
<br><br>
Ihre Tickets
		 </td>
	</tr>
	<tr>
		<td colspan="2">' . nl2br(trim($date_time)) . '</td>
	</tr>

</table>

<table cellpadding="5" cellspacing="0" style="width: 100%;" border="0">
	<tr style="background-color: #cccccc; padding:5px;">
		<td style="padding:5px;"><b>TISCH</b></td>
		<td style="padding:5px;"><b>PLATZ</b></td>
		<td style="padding:5px;"><b>DATUM</b></td>
		<td style="padding:5px;"><b>ZEIT</b></td>
		<td style="text-align:right"><b>Preis</b></td>
	</tr>';


$gesamtpreis = 0;

foreach ($plätze as $posten) {
	$gesamtpreis += $posten[2];
	$html .= '<tr>

				<td>' . $posten[0] . '</td>		
				<td>' . $posten[1] . '</td>	
				<td>' . $posten[3] . '</td>	
				<td>' . $posten[4] . '</td>	
                <td style="text-align:right">CHF ' . $posten[2] . '</td>
              </tr>';
}
$html .= "</table>";



$html .= '
<hr>
<table cellpadding="5" cellspacing="0" style="width: 100%;" border="0">';

$html .= '
            <tr>
                <td colspan="3"><b>Gesamtsumme: </b></td>
                <td style="text-align: right;"><b>CHF ' . number_format($gesamtpreis, 2, ',', '') . '</b></td>
            </tr>			
        </table>
<br><br><br>';



$html .= nl2br($footer);

// Print text using writeHTMLCell()
$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

// ---------------------------------------------------------

// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$pdf->Output('example_001.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
