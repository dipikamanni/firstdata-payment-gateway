<?php
if(isset($_POST['status']) && $_POST['status'] == 'APPROVED'){
	echo '<p style="background: #0f0251;text-align: center;padding: 10px; color: #fff;font-family: "Raleway", sans-serif;">Thank You For Your Payment<p>';
}
if(isset($_POST['status']) && $_POST['status'] != 'APPROVED'){
	echo '<p style="background: #0f0251;text-align: center;padding: 10px; color: #fff;font-family: "Raleway", sans-serif;">Your payment failed! Please Try Again<p>';
}
?>
<html>
<head>
	<title>Warr & Co</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	 <link rel="stylesheet" href="war_template.css?time=<?php echo time(); ?>"> 
	 <link href="https://fonts.googleapis.com/css?family=Playfair+Display|Raleway&display=swap" rel="stylesheet">
</head>
<body>
	<header>
		<div class="war_container">
			<div class="war_logo">
				<a href="#><img src="WARR_CO_-01.svg" width="300px"></a>
			</div>
		</div>
	</header>
	<section>
		<div class="war_section">
			<div class="war_section_container">
				<div class="war_section_title">
					<h1>Make A Secure Payment</h1>
				</div>
				<div class="war_section_description">
					<p>You can now pay your invoice securely online at your convenience. Please complete all the fields below and click 'Pay', your payment will be processed by our online banking partner FirstData.</p>
				</div>
				<div class="form-container">
					<form method="post" action="/process.php">
						<input type="text"   name="customParam_UserFullName" class="form_control" placeholder="Client Name*" required/>
						<input type="email" name="email"  class="form_control" placeholder="Enter Your Email*" required/>
						<input type="number" name="invoicenumber" class="form_control" placeholder="Enter Your Invoice Number*" required>
						<input type="text" name="clientReferenceNumber" class="form_control" placeholder="Client Reference Number (if known)">
						<input type="number" step="0.01" min="0"  name="chargetotal" class="form_control" placeholder="Enter Amount (GBP)* (Note, enter figure only, do not use '&pound;' symbol)" required/>			
						<input type="checkbox" name="checkfirst" id="checkfirst" required/><label for="checkfirst" id="checkfirstlabel">I have read and accepted the website <a href="#" target="_blank">Terms & Conditions</a></label>
						<div class="secondCheckbox">
							<input type="checkbox" name="checksecond" id="checksecond" required/><label for="checksecond" id="checksecondlabel">I have read and accepted the Privacy Policy and agree for my personal data provided to be used in accordance with the <a href="#" target="_blank">Privacy Policy</a></label>
						</div>
						<input type="submit" value="Pay" name="process-start" class="btn-pay">
					</form>
				</div>
			</div>

		</div>
	</section>
</body>
</html>