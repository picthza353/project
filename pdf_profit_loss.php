<?php

require_once('tcpdf/tcpdf.php');
session_start();
require("function/function.php");

$start_date = $_POST["date_start"];
$end_date = $_POST["date_end"];
$reportProfit = getReportProfit($start_date,$end_date);
$reportLoss = getReportLoss($start_date,$end_date);

$currentMonth = date("m");
$currentDate = '<h5 align="right">วันที่ออกรายงาน '.dateThaiFull(date("Y-m-d")).'</h5>';
// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('ร้าน ซื้อขายเหล็ก ทองแดง และทองเหลืองชนิด');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// remove default header/footer
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

//set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_RIGHT);

//set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

//set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

//set some language-dependent strings
$pdf->setLanguageArray($l);

// ---------------------------------------------------------
// set font

//$fontname = $pdf->addTTFfont('fonts/Browa.ttf', 'TrueTypeUnicode', '', 32);
$pdf->SetFont('angsanaupc', '', 16, '', true);


$line_html="";
//PAGE 3 >> PAGE 1
$pdf->AddPage();

$pdf->setPageOrientation ('L', $autopagebreak='', $bottommargin='');
// get the current page break margin
$bMargin = $pdf->getBreakMargin();
// get current auto-page-break mode
$auto_page_break = $pdf->getAutoPageBreak();
// disable auto-page-break
$pdf->SetAutoPageBreak(true, 0);
// Set some content to print

//$total_price = $price + 40;
$countDate = 0;
$i = 0;
$total_profit = 0;
$total_loss = 0;

foreach($reportProfit as $data){
    $allSaleBuyDetail = getAllSaleBuyDetail($data["id"]);
    $line_det1 = "";
    $line_det2 = "";
    $line_det3 = "";
    $line_det4 = "";
foreach($allSaleBuyDetail as $dataDet){
$cPrice = number_format($dataDet["price"]);
$cSumPrice = number_format($dataDet["summary"]);
$total_profit += $dataDet["summary"];
$line_det1  .= <<<EOD
{$dataDet['prod_name']}<br/>
EOD;
$line_det2  .= <<<EOD
{$dataDet['amount']}<br/>
EOD;
$line_det3  .= <<<EOD
{$cPrice}<br/>
EOD;
$line_det4  .= <<<EOD
{$cSumPrice}<br/>
EOD;
}


    $countDate++;
    $i++;
    $crdate = formatDateFull($data["date_create"]);
    

    $line_html1  .= <<<EOD
        <tr>
            <td style="text-align:center;">{$i}</td>
            <td style="text-align:center;">{$crdate}</td>
            <td style="text-align:center;">{$data['run_number']}</td>
            <td style="text-align:center;">{$data['customer_name']}</td>
            <td style="text-align:center;">{$data['customer_address']}</td>
            <td style="text-align:center;">{$data['firstname']} {$data['lastname']}</td>
            <td style="text-align:center;">{$line_det1}</td>
            <td style="text-align:center;">{$line_det2}</td>
            <td style="text-align:center;">{$line_det3}</td>
            <td style="text-align:center;">{$line_det4}</td>
        </tr>
        

EOD;
}

foreach($reportLoss as $dataLos){
    $allSaleBuyDetail = getAllSaleBuyDetail($dataLos["id"]);
    $line_det5 = "";
    $line_det6 = "";
    $line_det7 = "";
    $line_det8 = "";
foreach($allSaleBuyDetail as $dataDetLoss){
$cPriceLoss = number_format($dataDetLoss["price"]);
$cSumPriceLoss = number_format($dataDetLoss["summary"]);
$total_loss += $dataDetLoss["summary"];
$line_det5  .= <<<EOD
{$dataDetLoss['prod_name']}<br/>
EOD;
$line_det6  .= <<<EOD
{$dataDetLoss['amount']}<br/>
EOD;
$line_det7  .= <<<EOD
{$cPriceLoss}<br/>
EOD;
$line_det8  .= <<<EOD
{$cSumPriceLoss}<br/>
EOD;
}


    $countDate++;
    $i++;
    $crdate = formatDateFull($dataLos["date_create"]);
    

    $line_html2  .= <<<EOD
        <tr>
            <td style="text-align:center;">{$i}</td>
            <td style="text-align:center;">{$crdate}</td>
            <td style="text-align:center;">{$dataLos['run_number']}</td>
            <td style="text-align:center;">{$dataLos['customer_name']}</td>
            <td style="text-align:center;">{$dataLos['customer_address']}</td>
            <td style="text-align:center;">{$dataLos['firstname']} {$dataLos['lastname']}</td>
            <td style="text-align:center;">{$line_det1}</td>
            <td style="text-align:center;">{$line_det2}</td>
            <td style="text-align:center;">{$line_det3}</td>
            <td style="text-align:center;">{$line_det4}</td>
        </tr>
        

EOD;
}

$cTotalProfit = number_format($total_profit);
$cTotalLoss = number_format($total_loss);
$cBalance = number_format($total_profit - $total_loss);
$header_html  .= <<<EOD
<div style="text-align:center;margin:0">
<b style="font-size:26px;">ร้าน ซื้อขายเหล็ก ทองแดง และทองเหลือง</b><br />
<b style="font-size:26px;">สรุปผลกำไร - ขาดทุน</b><br />
<b style="font-size:26px;">จากวันที่ {$start_date} ถึง {$end_date}</b><br />
</div>
{$currentDate}
EOD;
$body_html  .= <<<EOD
<legend><b>ข้อมูลการขาย</b></legend>
<br/>
<table border="0">
    <tr>
        <td style="border-bottom: 1px solid #000;text-align:center;border-top: 1px solid #000;">ลำดับ</td>
        <td style="border-bottom: 1px solid #000;text-align:center;border-top: 1px solid #000;">วันที่</td>
        <td style="border-bottom: 1px solid #000;text-align:center;border-top: 1px solid #000;">เลขที่การขาย</td>
        <td style="border-bottom: 1px solid #000;text-align:center;border-top: 1px solid #000;">ลูกค้า</td>
        <td style="border-bottom: 1px solid #000;text-align:center;border-top: 1px solid #000;">ที่อยู่</td>
        <td style="border-bottom: 1px solid #000;text-align:center;border-top: 1px solid #000;">บันทึกโดย</td>
        <td style="border-bottom: 1px solid #000;text-align:center;border-top: 1px solid #000;">สินค้า</td>
        <td style="border-bottom: 1px solid #000;text-align:center;border-top: 1px solid #000;">จำนวน</td>
        <td style="border-bottom: 1px solid #000;text-align:center;border-top: 1px solid #000;">ราคาต่อหน่วย</td>
        <td style="border-bottom: 1px solid #000;text-align:center;border-top: 1px solid #000;">รวม</td>
        
        
    </tr>
    {$line_html1}
    
</table>
<br/>
<legend><b>ข้อมูลการซื้อ</b></legend>
<br/>
<table border="0">
    <tr>
        <td style="border-bottom: 1px solid #000;text-align:center;border-top: 1px solid #000;">ลำดับ</td>
        <td style="border-bottom: 1px solid #000;text-align:center;border-top: 1px solid #000;">วันที่</td>
        <td style="border-bottom: 1px solid #000;text-align:center;border-top: 1px solid #000;">เลขที่การซื้อ</td>
        <td style="border-bottom: 1px solid #000;text-align:center;border-top: 1px solid #000;">ลูกค้า</td>
        <td style="border-bottom: 1px solid #000;text-align:center;border-top: 1px solid #000;">ที่อยู่</td>
        <td style="border-bottom: 1px solid #000;text-align:center;border-top: 1px solid #000;">บันทึกโดย</td>
        <td style="border-bottom: 1px solid #000;text-align:center;border-top: 1px solid #000;">สินค้า</td>
        <td style="border-bottom: 1px solid #000;text-align:center;border-top: 1px solid #000;">จำนวน</td>
        <td style="border-bottom: 1px solid #000;text-align:center;border-top: 1px solid #000;">ราคาต่อหน่วย</td>
        <td style="border-bottom: 1px solid #000;text-align:center;border-top: 1px solid #000;">รวม</td>
        
        
    </tr>
    {$line_html2}
    
</table>

<table>
    <tr>
        <td colspan="4" style="text-align:right;">รวมราคาขาย</td>
        <td style="text-align:center;">{$cTotalProfit}</td>
        <td style="text-align:left;">บาท</td>
    </tr>
    <tr>
        <td colspan="4" style="text-align:right;">รวมราคาซื้อ</td>
        <td style="text-align:center;">{$cTotalLoss}</td>
        <td style="text-align:left;">บาท</td>
    </tr>
    <tr>
        <td colspan="4" style="text-align:right;">กำไรขาดทุนสุทธิ</td>
        <td style="text-align:center;">{$cBalance}</td>
        <td style="text-align:left;">บาท</td>
    </tr>
    
</table>
EOD;

$html = <<<EOD
{$header_html}
{$body_html}
<div style="text-align:center;">
</div>
EOD;


// Print text using writeHTMLCell()
$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

// ---------------------------------------------------------

// Close and output PDF document
// This method has several options, check the source code documentation for more information.
ob_end_clean();
$pdf->Output('รายงาน.pdf', 'I');
?>

<?php die(); ?>
