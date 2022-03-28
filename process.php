<?php
if(isset($_POST['process-start']) && $_POST['process-start'] == 'Pay'){
	$clientFullName = $_POST['customParam_UserFullName'];
	$invoiceNumber  = $_POST['invoicenumber'];
	$invoiceAmount  = $_POST['chargetotal'];
	$clientEmail    = $_POST['email'];
	$clientReferenceNumber = (isset($_POST['clientReferenceNumber']) && !empty($_POST['clientReferenceNumber'])?$_POST['clientReferenceNumber']:false);
}

 date_default_timezone_set('Europe/Berlin');
 $dateTime = date("Y:m:d-H:i:s");
function getDateTime() {
    global $dateTime;
    return $dateTime;
}
function createHash($chargetotal, $currency)
{
	$storeId = "1110454739";
	$sharedSecret = "td-8F-M8ZW";
	$stringToHash = $storeId . getDateTime() . $chargetotal . $currency . $sharedSecret;
	$ascii = bin2hex($stringToHash);
	return hash("sha256", $ascii);
}?>
<html>
<head>
	<title>Processing...</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
	<section>
		<form method="post" action="https://www.ipg-online.com/connect/gateway/processing" id="completeProcess">
			<input type="text"   name="customParam_UserFullName" class="form_control" placeholder="Client Name*" value="<?php echo $clientFullName; ?>" required/>
			<input type="number" name="invoicenumber" class="form_control" placeholder="Enter Your Invoice Number*" value="<?php echo $invoiceNumber; ?>" required/>
			<input type="email" name="email" class="form_control" placeholder="Enter Your Email*" value="<?php echo $clientEmail; ?>" required/>
			<?php 
			if ($clientReferenceNumber!=false) {
				echo '<input type="text" name="customerid" class="form_control" placeholder="Client Reference Number (if known)" value="'.$clientReferenceNumber.'" required/>';
			}
			?>
			<input type="number"   name="chargetotal" class="form_control" placeholder="Enter Amount (GBP)*" value="<?php echo $invoiceAmount; ?>" required/>	
			<input type="hidden" name="txntype" value="sale"/>
			<input type="hidden" name="timezone" value="Europe/Berlin"/>
			<input type="hidden" name="txndatetime" value="<?php echo getDateTime() ?>"/>
			<input type="hidden" name="hash_algorithm" value="SHA256"/>
			<input type="hidden" name="hash" value="<?php echo createHash( $invoiceAmount , "826" ) ?>"/>
			<input type="hidden" name="storename" value="1110454739"/>
			<input type="hidden" name="mode" value="payonly"/>
			<input type="hidden" name="currency" value="826"/>						
			<input type="hidden" name="transactionNotificationURL" value="#">
			<input type="hidden" name="redirectURL" value="#">						
			<input type="hidden" name="responseSuccessURL" value="#">
			<input type="hidden" name="responseFailURL" value="#">
			<input type="submit" value="Pay" class="btn-pay">
		</form>
	</section>
	<div class="body-after"></div>
	<style>
		.body-after {
		    content: "";
		    position: fixed;
		    background: #fff;
		    z-index: 99;
		    width: 100%;
		    height: 100%;
		    top: 0;
		    left: 0;
		    display: block;
		}
		.body-after:before {
		    font-family: 'FontAwesome';
		    content: "\f110";
		    position: absolute;
		    top: 0;
		    left: 0;
		    width: 100%;
		    display: flex;
		    flex-direction: row;
		    align-items: center;
		    justify-content: center;
		    color: #000000;
		    font-size: 48px;
		    padding: 15px;
		    animation-name: spin;
		    animation-duration: 1000ms;
		    animation-iteration-count: infinite;
		    animation-timing-function: linear;
		    height: 100%;
		}
		@keyframes spin {
		    from {
		        transform:rotate(0deg);
		    }
		    to {
		        transform:rotate(360deg);
		    }
		}
	</style>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
	<script>
		$(document).ready(function(){
		   $("#completeProcess").submit();
		});
	</script>
</body>
</html>