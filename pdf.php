<?php
session_start();
include("connect.php");
if ($_GET['uid']) {
	$user_id = $_GET['uid'];

	
} else {
	if ($_SESSION['uid']) {
		$user_id = $_SESSION['uid'];
	} else {
		header("Location: index.html");
	}
}

$sql_user = "SELECT * FROM customers WHERE id = '$user_id'";
$result_user = mysqli_query($connect, $sql_user);
$fetch_user = mysqli_fetch_assoc($result_user);


$payment_method = $fetch_user['payment_method'];
$paid = $fetch_user['paid'];

if ($paid == "No") {
	$paid = '<b color="red">Unpaid</b>';
} else {
    if($paid == "Yes"){
	$paid = '<b color="green">Paid</b>';
    }
    else{
        $paid = '<b color="orange">Unknown</b>';
        
    }
}

$products = json_decode($fetch_user['products'], true);

require_once('TCPDF/TCPDF-main/examples/tcpdf_include.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Valentin Nussbaumer');
$pdf->SetTitle('Bill_' . $user_id . '');
$pdf->SetSubject('Bill_' . $user_id . '');
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
<b style="font-size: 22px;">VHD Shop</b>
<a style="color:gray; font-size: 13px;" href="mailto: vali7799@icloud.com">contact@VHD.shop</a>
<a style="color:gray; font-size: 13px;" href="https://VHD.shop">VHD.shop</a>';



$footer = "
<b>Payment method:</b> $payment_method
$paid
<br>
".$fetch_user['prename']." ".$fetch_user['name']."<br>"
.$fetch_user['adress']."<br>"
.$fetch_user['post_code']." ".$fetch_user['village']."<br>"
.$fetch_user['email']." | ".$fetch_user['phone']."<br>";


$pdfName = 'Ticket_' . $user_id . '.pdf';


$html = '
<table cellpadding="5" cellspacing="0" style="width: 100%; ">
	<tr>
		<td>' . nl2br(trim($header)) . '</td>
	   <td style="text-align: right">
	   VHD Office<br>
	   VHD Street<br>
	   9999 VHD City<br> 
		</td>
	</tr>

	<tr>
		 <td style="font-size:20px; font-weight: bold;">
<br><br>
Your Order
		 </td>
	</tr>
	<tr>
		<td colspan="2">'.$fetch_user["date"].'</td>
	</tr>

</table>

<table cellpadding="5" cellspacing="0" style="width: 100%;" border="0">
	<tr style="background-color: #cccccc; padding:5px;">
		<td style="padding:5px;"><b>Product Name</b></td>
		<td style="text-align:right"><b>Price</b></td>
	</tr>';


$gesamtpreis = 0;

foreach ($products as $product) {
	$sql = "SELECT * FROM products WHERE id = '$product'";
	$result = mysqli_query($connect, $sql);
	if (!$result) {
		echo "<script> alert('Daten konnten nicht geladen Werden.'); </script>";
	}

	$row = mysqli_fetch_assoc($result);
	$html .= '<tr>
				<td>' . $row['name'] . '</td>		
                <td style="text-align:right">CHF ' . $row['price'] . '</td>
    </tr>';
	$gesamtpreis += $row['price'];
	
}
$html .= "</table>";



$html .= '
<hr>
<table cellpadding="5" cellspacing="0" style="width: 100%;" border="0">';

$html .= '
            <tr>
                <td colspan="3"><b>Total: </b></td>
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
