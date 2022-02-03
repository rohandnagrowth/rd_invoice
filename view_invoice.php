<?php
session_start();
include 'Invoice.php';
$invoice = new Invoice();
$invoice->checkLoggedIn();
if(!empty($_GET['invoice_id']) && $_GET['invoice_id']) {
	//echo $_GET['invoice_id'];
	$invoiceValues = $invoice->getInvoice($_GET['invoice_id']);		
    //print_r($invoiceValues) ;
	$invoiceItems = $invoice->getInvoiceItems($_GET['invoice_id']);		
    //print_r($invoiceItems[0]['order_id']) ;
}
$invoiceDate = date("d/M/Y", strtotime($invoiceValues['order_date']));

//print_r($invoiceDate) ;

// Create a function for converting the amount in words
function AmountInWords(float $amount)
{
   $amount_after_decimal = round($amount - ($num = floor($amount)), 2) * 100;
   // Check if there is any number after decimal
   $amt_hundred = null;
   $count_length = strlen($num);
   $x = 0;
   $string = array();
   $change_words = array(0 => '', 1 => 'One', 2 => 'Two',
     3 => 'Three', 4 => 'Four', 5 => 'Five', 6 => 'Six',
     7 => 'Seven', 8 => 'Eight', 9 => 'Nine',
     10 => 'Ten', 11 => 'Eleven', 12 => 'Twelve',
     13 => 'Thirteen', 14 => 'Fourteen', 15 => 'Fifteen',
     16 => 'Sixteen', 17 => 'Seventeen', 18 => 'Eighteen',
     19 => 'Nineteen', 20 => 'Twenty', 30 => 'Thirty',
     40 => 'Forty', 50 => 'Fifty', 60 => 'Sixty',
     70 => 'Seventy', 80 => 'Eighty', 90 => 'Ninety');
    $here_digits = array('', 'Hundred','Thousand','Lakh', 'Crore');
    while( $x < $count_length ) {
      $get_divider = ($x == 2) ? 10 : 100;
      $amount = floor($num % $get_divider);
      $num = floor($num / $get_divider);
      $x += $get_divider == 10 ? 1 : 2;
      if ($amount) {
       $add_plural = (($counter = count($string)) && $amount > 9) ? 's' : null;
       $amt_hundred = ($counter == 1 && $string[0]) ? ' and ' : null;
       $string [] = ($amount < 21) ? $change_words[$amount].' '. $here_digits[$counter]. $add_plural.' 
       '.$amt_hundred:$change_words[floor($amount / 10) * 10].' '.$change_words[$amount % 10]. ' 
       '.$here_digits[$counter].$add_plural.' '.$amt_hundred;
        }
   else $string[] = null;
   }
   $implode_to_Rupees = implode('', array_reverse($string));
   $get_paise = ($amount_after_decimal > 0) ? "And " . ($change_words[$amount_after_decimal / 10] . " 
   " . $change_words[$amount_after_decimal % 10]) . ' Paise' : '';
   return ($implode_to_Rupees ? $implode_to_Rupees . 'Rupees ' : '') . $get_paise;
}
?>

<!-- call the function here -->
 <?php
//  $amt_words=$invoiceValues['order_item_final_amount'];
 
 $amt_words1=$invoiceValues['order_total_before_tax'];
 $amt_words2=$invoiceValues['order_total_tax'];
 $amt_words3=$invoiceValues['order_total_after_tax'];

 $amt_words4=$invoiceValues['order_amount_paid'];

 $amt_words5=$invoiceValues['order_total_amount_due'];
 $amt_words6=$invoiceValues['order_tax_per'];
 
  // nummeric value in variable
// $get_amount= AmountInWords($amt_words);
 
 $get_amount1= AmountInWords($amt_words1);
 $get_amount2= AmountInWords($amt_words2);

 $get_amount3= AmountInWords($amt_words3);

 $get_amount4= AmountInWords($amt_words4);

 $get_amount5= AmountInWords($amt_words5);
 $get_amount6= AmountInWords($amt_words6);



?>  

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>TAX INVOICE</title>
<link href="https://fonts.googleapis.com/css2?family=Muli:wght@200;300;400;500;700&display=swap" rel="stylesheet">
<style type="text/css">
   .print
   {
	   width:140px;
	   height:35px;
	   line-height:32px;
	   text-align:center;
	   border:none;
	   border-radius:20px;
	   background:#f60;
	   margin-bottom:20px;
	   cursor:pointer;
	   color:#fff;
	   font-family: 'Muli', sans-serif;
       margin-left: 853px;
       margin-top: 10px;
   }
</style>


  <script> 
        function printDiv() { 
            var divContents = document.getElementById("panel").innerHTML; 
            var a = window.open('', '', 'height=800, width=800'); 
            a.document.write('<html>'); 
            a.document.write('<body > <h1>RD INFOTECH BILL <br>'); 
            a.document.write(divContents); 
            a.document.write('</body></html>'); 
            a.document.close(); 
            a.print(); 
        } 
    </script> 



</head>

<body>

<div id="panel">
<table style="border:1px solid #999999;" width="100%" border="0" cellpadding="0" cellspacing="0" class="tb">
  <tbody>
    <tr>
      <td height="35" colspan="4" align="center" class="txt" style="border-bottom:1px solid #ddd; color:#d04e00; font-weight:800; font-family: 'Muli', sans-serif;">INVOICE</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tbody>
          <tr>
            <td height="49" valign="bottom" style=" font-size:20px; color:#d04e00; font-weight:800; font-family: 'Muli', sans-serif;">RD INFOTECH  </td>
            </tr>
            
          <tr>
            <td style=" font-size:13px; color:#000; padding:5px; font-family: 'Muli', sans-serif;" >GSTIN : 03EDWPD1691F24D </td>
            </tr>
          <tr>
            <td style=" font-size:13px; color:#000; padding:5px; font-family: 'Muli', sans-serif;">Office : Ludhiana</td>
            </tr>
          <tr>
            <td style=" font-size:13px; color:#000; padding:5px; font-family: 'Muli', sans-serif;">Email : info@rdinfotechs.co.in</td>

            </tr>
            <tr>
            <td style=" font-size:13px; color:#000; padding:5px; font-family: 'Muli', sans-serif;">Website : www.rdinfotechs.co.in</td>
            </tr>
            <tr>
            <td style=" font-size:13px; color:#000; padding:5px; font-family: 'Muli', sans-serif;">Mobile : +91-84271-92544</td>
            </tr>
            
        </tbody>
      </table></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td height="36" colspan="4">&nbsp;</td>
    </tr>
    <tr>
      <td width="3%">&nbsp;</td>
      <td colspan="2"><table width="100%" border="0" cellpadding="0" cellspacing="0" class="tb1">
        <tbody>
          <tr>
            <td><table style="border:1px solid #999999;" width="100%" border="0" cellspacing="0" cellpadding="0">
              <tbody>
                <tr>
                  <td width="16%" height="25"><strong><span style=" font-size:13px; color:#000; padding:5px; font-family: 'Muli', sans-serif;">Client Name </span></strong></td>
                  <td width="49%"><span style=" font-size:13px; color:#000; padding:5px; font-family: 'Muli', sans-serif;"><?php echo $invoiceValues['order_receiver_name'] ?></span></td>
                  <td width="20%"><strong><span style=" font-size:13px; color:#000; padding:5px; font-family: 'Muli', sans-serif;">Invoice Date</span></strong></td>
                  <td width="15%"><span style=" font-size:13px; color:#000; padding:5px; font-family: 'Muli', sans-serif;"><?php echo $invoiceDate ?></span></td>
                </tr>
                <tr>
                  <td height="25"><strong><span style=" font-size:13px; color:#000; padding:5px; font-family: 'Muli', sans-serif;">Address</span></strong></td>
                  <td><span style=" font-size:13px; color:#000; padding:5px; font-family: 'Muli', sans-serif;"><?php echo $invoiceValues['order_receiver_address'] ?> </span></td>
                  <td><strong><span style=" font-size:13px; color:#000; padding:5px; font-family: 'Muli', sans-serif;">Invoice Number</span></strong></td>
                  <td><span style=" font-size:13px; color:#000; padding:5px; font-family: 'Muli', sans-serif;"></span> <?php echo$invoiceItems[0]['order_id'] ?></td>
                </tr>
                <tr>
                  <td height="25"><strong><span style=" font-size:13px; color:#000; padding:5px; font-family: 'Muli', sans-serif;">GSTIN</span></strong></td>
                  <td><span style=" font-size:13px; color:#000; padding:5px; font-family: 'Muli', sans-serif;"><?php echo $invoiceValues['order_reciever_gst'] ?></span></td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
              </tbody>
            </table></td>
          </tr>
          <tr>
            <td height="31" style="border-top:1px solid #999999;">&nbsp;</td>
          </tr>
          <tr>
            <td><table style="border:1px solid #999999;" width="100%" border="1" cellpadding="0" cellspacing="0" class="tb2">
              <tbody>
                <tr style=" font-size:13px; color:#000; padding:5px; font-family: 'Muli', sans-serif;">
                  <td width="7%" height="30" align="center"><strong>S.N</strong></td>
                  <td width="60%" align="center"><strong>Description </strong></td>
                
                  <td width="8%" align="center"><strong>Qty </strong></td>
                  <td width="12%" align="center"><strong>Rate </strong></td>
                  <td width="13%" align="center"><strong>Amount</strong></td>
                </tr>
                <?php
                $count = 0;   
                foreach($invoiceItems as $invoiceItem){
                    $count++;
                    ?>
                    <tr style=" font-size:13px; color:#000; padding:5px; font-family: 'Muli', sans-serif;">

                    <td height="30" align="center"><?php echo $count; ?></td>
                    <td align="center"><?php echo $invoiceItem["item_name"];?></td>
                    <td align="center"><?php echo $invoiceItem["order_item_quantity"] ;?></td>
                    <td align="center"><?php echo $invoiceItem["order_item_price"] ;?></td>
                    <td align="center"><?php echo $invoiceItem["order_item_final_amount"] ;?></td>   
                  </tr>
                  <?php 
                }
                ?>
               
                <tr style=" font-size:13px; color:#000; padding:5px; font-family: 'Muli', sans-serif;">
                  <td height="30" align="center" colspan="3"><strong> <?php echo $get_amount1; ?></strong></td>
                  
                  
                  <td align="center"><strong>TOTAL</strong></td>
                  <td align="center"><?php echo $invoiceValues["order_total_before_tax"] ;?></td>
                </tr>
              </tbody>
            </table></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td><table width="100%" border="1" cellpadding="0" cellspacing="0" class="tb2">
              <tbody>
             

                <tr style=" font-size:13px; color:#000; padding:5px; font-family: 'Muli', sans-serif;">
                    <td width="7%" height="48" align="center" colspan="2" row> </td>
                    <td align="center">GST : </td>
                    <td width="13%" align="center"><?php echo $invoiceValues['order_tax_per']; ?></td>
                </tr>

                <tr style=" font-size:13px; color:#000; padding:5px; font-family: 'Muli', sans-serif;">
                    <td width="7%" height="48" align="center" colspan="2"><?php echo $get_amount2; ?> </td>   
                    <td align="center">Tax Amount:  </td>
                    <td width="13%" align="center"><?php echo $invoiceValues['order_total_tax']; ?></td>
                </tr>

                <!-- <tr style=" font-size:13px; color:#000; padding:5px; font-family: 'Muli', sans-serif;" aria-rowspan="10px"> -->
                    <!-- <td width="7%" height="48" align="center">In words</td>  -->
                    <!-- <td width="60%" align="center" rowspan="1">&nbsp;</td> -->
                    <!-- <td align="center">Total:</td> -->
                    <!-- <td width="13%" align="center"><?php echo $invoiceValues['order_total_after_tax']; ?></td> -->
                <!-- </tr> -->
                <tr style=" font-size:13px; color:#000; padding:5px; font-family: 'Muli', sans-serif;">
                  <td width="75%" height="48" align="center" colspan="2"><?php echo $get_amount3; ?> </td>
                  
                  <td align="center">Total: </td>
                  <td width="13%" align="center"><?php echo $invoiceValues['order_total_after_tax']; ?></td>
                </tr>

                <tr style=" font-size:13px; color:#000; padding:5px; font-family: 'Muli', sans-serif;">
                    <td width="7%" height="48" align="center" colspan="2"><?php echo $get_amount4; ?> </td>
                    <td align="center">Amount Paid:</td>
                    <td align="center"><?php echo $invoiceValues['order_amount_paid']; ?></td>
                </tr>

                <tr style=" font-size:13px; color:#000; padding:5px; font-family: 'Muli', sans-serif;">
                    <td width="7%" height="48" align="center" colspan="2"><strong><?php echo $get_amount5; ?> </strong></td>
                    <td align="center"><strong>Amount Due:</strong></td>
                    <td align="center"><?php echo $invoiceValues['order_total_amount_due']; ?></td>
                </tr>
              </tbody>
            </table></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
        </tbody>
      </table></td>
      <td width="3%">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="4">&nbsp;</td>
    </tr>
    <tr>
      <td height="32">&nbsp;</td>
      <td style=" font-size:13px; color:#000; padding:5px; font-family: 'Muli', sans-serif;" width="47%" height="32"><strong><?php echo $invoiceDate; ?></strong></td>
      <td style=" font-size:13px; color:#000; padding:5px; font-family: 'Muli', sans-serif;" width="47%" align="right"><strong>For : Online Reciept</strong></td>
      <td height="32">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="4">&nbsp;</td>
    </tr>
    <tr>
      <td height="72">&nbsp;</td>
      <td>&nbsp;</td>
      <td style=" font-size:13px; color:#000; padding:5px; font-family: 'Muli', sans-serif;" align="right" valign="bottom"><strong>Authorised Signature</strong></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td colspan="4">&nbsp;</td>
    </tr>
  </tbody>
</table>
</div>
<div onclick="printDiv()" class="print d-flex justify-content-center">Print Invoice</div>
</body>
</html>
  