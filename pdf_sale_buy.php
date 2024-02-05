<?php

require_once('tcpdf/tcpdf.php');
session_start();
require("function/function.php");

$currentSaleBuy = getCurrentSaleBuy($_GET["id"]);
$allSaleBuyDetail = getAllSaleBuyDetail($_GET["id"]);
$sale_buy_map = array( 1=>'ขายสินค้า',2=>'ซื้อสินค้า');

$cMapType = $sale_buy_map[$currentSaleBuy["types"]];
$yThai = date("Y")+543;
$dateNow = date("d/m/").$yThai;

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('เว็บแอปพลิเคชันซื้อขายเหล็ก ทองแดง และทองเหลือง');
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
$pdf->setPageOrientation ('P', $autopagebreak='', $bottommargin='');
// get the current page break margin
$bMargin = $pdf->getBreakMargin();
// get current auto-page-break mode
$auto_page_break = $pdf->getAutoPageBreak();
// disable auto-page-break
$pdf->SetAutoPageBreak(true, 0);
// Set some content to print

$total_price = 0;
$total_weight = 0;
foreach($allSaleBuyDetail as $data){
    $sum_price = 0;
    $a++;
    $cPrice = number_format($data['price']);
    $cTot = number_format($data['summary']);
    $total_price += $data['summary'];

$line_html  .= <<<EOD
                <tr>
                    <td align="center" style="border-right-width:0.1px;">{$a}</td>
                    <td style="border-right-width:0.1px;">{$data['prod_name']}</td>
                    <td style="text-align:center;border-right-width:0.1px;">{$data['amount']} กก.</td>
                    <td style="text-align:right;border-right-width:0.1px;">{$cPrice} บาท/กก.</td>
                    <td style="text-align:right;border-right-width:0.1px;">{$cTot} บาท</td> 
                </tr>
EOD;
}

$cTotal = number_format($total_price);
$cTextSum = convertMoneyToText($cTotal);

$header_html  .= <<<EOD
<table style="width:100%;">
    <tr>
        <td style"width:50%;">
            <div style="text-align:right;">
                <b>ร้านซื้อ-ขายเหล็ก ทองแดง และทองเหลือง</b><br/>
                บ้านเลขที่90 หมู่13 ตำบลพรานกระต่าย อำเภอพรานกระต่าย<br/>
            </div>
        </td>
    </tr>
</table>
<div style="text-align:center;margin:0;"><b style="font-size:30px;">ใบกำกับภาษี/ใบเสร็จรับเงิน</b></div>
<div style="text-align:right;margin:0;">
</div>
                
EOD;

$header_b  .= <<<EOD
    <table style="width:100%">
        <tr>
            <td style="border: 1px solid black; width:60%">
                    <table>
                    <tr>
                            <td style="width:320px;text-align:left;">ชื่อผู้ซื้อขาย : {$currentSaleBuy['customer_name']}</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td style="width:500px;text-align:left;">ที่อยู่ : {$currentSaleBuy['customer_address']} </td>
                        </tr>
                        <tr>
                            <td style="width:320px;text-align:left;">เบอร์โทรศัพท์ : {$currentSaleBuy['customer_telephone']} </td>
                        </tr>
                    </table>
            </td>
            <td style="border: 1px solid black; width:40%">
                    <table>
                        <tr>
                            <td style="text-align:left;">เล่มที่ {$currentSaleBuy['sid']}</td>
                            <td style="width:160px;text-align:left;">เลขที่ {$currentSaleBuy['run_number']}</td>
                        </tr>
                        <tr>
                            <td style="width:165px;text-align:left;">วันที่ {$dateNow}</td>
                            <td style="width:160px;text-align:left;"></td>
                        </tr>
                        <tr>
                            <td style="width:115px;text-align:left;">ประเภท</td>
                            <td style="width:155px;text-align:left;">{$cMapType}</td>
                        </tr>
                    </table>
            </td>
        </tr>
    </table>
EOD;

$body_html  .= <<<EOD

<table style="width:100%;" border="1">
    <tr>
        <td style="width:10%;text-align:center;"><b>ลำดับ</b></td>
        <td style="width:40%;text-align:center;"><b>รายการสินค้าหรือบริการ</b></td>
        <td style="width:15%;text-align:center;"><b>จำนวนหน่วย</b></td>
        <td style="width:15%;text-align:center;"><b>ราคาต่อหน่วย</b></td>
        <td style="width:20%;text-align:center;"><b>จำนวนเงิน</b></td>
    </tr>
    {$line_html}
</table>

EOD;

$footer_html2  .= <<<EOD
            <table>
                <tr>
                    <td>
                        <div align="left" border="1">
                           <table>
                            <tr>
                                <td>หมายเหตุ </td>
                            </tr>
                           </table>
                        </div>
                    </td>
                    <td>
                        <div align="left" border="1">
                            <table>
                            <tr>
                                <td>ราคารวม</td>
                                <td>{$cTotal}</td>
                                <td>บาท</td>
                            </tr>
                           </table>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td align="right" colspan="2" border="1">
                    {$cTextSum}
                    </td>
                </tr>

            </table>

EOD;
$html = <<<EOD
{$header_html}
{$header_b}
{$body_html}
{$footer_html2}

            <table>
                <tr>
                    <td>
                        <div align="center" >
                            &nbsp;&nbsp;&nbsp;<br /><br />
                            ผู้รับสินค้า..............................................
                            <br/>
                            ผู้รับสินค้า
                        </div>
                    </td>
                    <td>
                        <div align="center" >
                            &nbsp;&nbsp;&nbsp;<br /><br />
                            ผู้ส่งสินค้า..............................................
                            <br/>
                            ผู้ส่งสินค้า
                        </div>
                    </td>
                </tr>
            </table>
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
