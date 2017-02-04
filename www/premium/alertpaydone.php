<?php

//===============================================================================
// AlertPay Instant Payment Notification (IPN)
//===============================================================================
// THIS CODE AND INFORMATION ARE PROVIDED "AS IS" WITHOUT WARRANTY
// OF ANY KIND, EITHER EXPRESSED OR IMPLIED, INCLUDING BUT NOT
// LIMITED TO THE IMPLIED WARRANTIES OF FITNESS FOR A PARTICULAR PURPOSE.
//===============================================================================

// Script: AlertURL.php
// Platform: PHP

// Purpose:
// --------
// The purpose of this code is to help you to understand how to process the Instant Payment Notification 
// variables for Subscription Button and integrate it in your PHP site.

// How to Use: 
// -----------
// Put this code into the page which you have specified as Alert URL.
// The variables being read from the _POST object in the below code are pre-defined IPN variables and the
// the conditional blocks provide you the logical placeholders to process the IPN variables. It is your responsibility
// to write appropriate code as per your requirements.

// Developer Feedback:
// --------------
// If you have any questions about this script or any suggestions, please email to: devsupport@alertpay.com.

//Code laten genereren    
$code = "";
$codeinput="abcdefghijklmnopqrstuvxyz0123456789";
$aantal=32;
for ($i = 1; $i <= $aantal; $i++) {
$code .= $codeinput[rand(0,strlen($codeinput)-1)];
}

    // Security code variable
    $ap_SecurityCode = $_POST['ap_securitycode'];;

    // Customer info variables
    $ap_CustFirstName;
    $ap_CustLastName;
	$ap_CustAddress;
	$ap_CustCity;
    $ap_CustCountry;
	$ap_CustZip;
	$ap_CustEmailAddress = $_POST['ap_custemailaddress'];;

    // Common transaction variables
    $ap_ReferenceNumber = $_POST['ap_referencenumber'];;
	$ap_Status = $_POST['ap_status'];;
	$ap_PurchaseType;
	$ap_Merchant;
    $ap_ItemName;
	$ap_ItemCode;
	$ap_Description;
	$ap_Quantity;
	$ap_Amount = $_POST['ap_amount'];;
	$ap_AdditionalCharges;
    $ap_ShippingCharges;
	$ap_TaxAmount;
	$ap_DiscountAmount;
	$ap_TotalAmount;
	$ap_Currency = $_POST['ap_currency'];;
    $ap_Test = $_POST['ap_test'];;

    // Custom fields
    $ap_Apc_1;
	$ap_Apc_2;
	$ap_Apc_3;
	$ap_Apc_4;
	$ap_Apc_5;
	$ap_Apc_6;

    // Subscription variables
    $ap_SubscriptionReferenceNumber;
	$ap_TimeUnit;
	$ap_PeriodLength;
	$ap_PeriodCount;
	$ap_NextRunDate;
    $ap_TrialTimeUnit;
	$ap_TrialPeriodLength;
	$ap_TrialAmount;


	// Initialize variable

        if ($ap_SecurityCode != "security code")
        {
            // The Data is NOT sent by AlertPay.
            // Take appropriate action
					/*echo "<script language=\"JavaScript\">
					<!--
			 		window.location=\"http://www.$domain/?page=purchase&error=Securitycode\";//--></script>"; */
			 		echo "Please check your e-mail for the pin code. The email address would be the address used for this transaction.";
        }
        else
        {
            if ($ap_Test == "1")
            {
                // Your site is currently being integrated with AlertPay IPN for TESTING PURPOSES
                // ONLY. Don't store any information in your Production database and don't process
                // this transaction as a real order.
							$sendto=$ap_CustEmailAddress;
									$mail_subject = "PREMIUM PIN $sitename";
									$mail_text = "Thank you for PREMIUM purchase at $sitename.\r\n".
										"Your transaction has been denied - Reason: Testtransaction \r\n".
										"Please contact an admin if this is incorrect \r\n".
										"Please provide your $ap_ReferenceNumber \r\n \r\n".
										"URL: www.$domain \r\n";
										
									$mail_headers = 'From: noreply@'.$domain.''."\r\n".
									'Reply-To: noreply@'.$domain.''."\r\n".
									'Mime-Version: 1.0'."\r\n". 
									'X-Mailer: PHP/'.phpversion();
								mail($sendto, $mail_subject, $mail_text,$mail_headers);
            }
            else
            {
                // Initialize variables
                    if ($ap_Status == "Success" && $ap_Currency == "EUR")
                    {
                        // Transaction is complete. It means that the amount was paid successfully.
                        // Process the order here.
					    $source = mysql_query("SELECT * FROM payment WHERE transaction='$ap_ReferenceNumber' and done = '1'") or die(mysql_error());  
						$num_rows = mysql_num_rows($source);
						if ($num_rows > 0) {
							while($row = mysql_fetch_array( $source )) {
								$pincode = $row['PIN'];
								}
							echo "Sorry, already validated. Your pin code is $pincode";
							}
						else
						{
						mysql_query("INSERT INTO payment (`transaction`, `done`) VALUES ('" . $ap_ReferenceNumber . "','1');") or die(mysql_error()); 
						if($ap_Amount == "1" || $ap_Amount == "1.00")
						{
							//Generate a code & insert into DB
							//echo "Your PIN code is: $code";
							mysql_query("update payment set PIN='$code', Valid='$pack1', email='$ap_CustEmailAddress', type='premium' where transaction='$ap_ReferenceNumber';")
							or die(mysql_error()); 
									if(!empty($refferedby))
									{
									mysql_query("update users set credits=credits+$refamountpack1 where Id='$refferedby'") or die(mysql_error()); 
									mysql_query("insert into refbuy (`IP`, `transaction`, `refid`, `credits`) VALUES ('" . $usrip . "','" . $ap_ReferenceNumber . "','" . $refferedby . "','".$pack1."');") or die(mysql_error()); 
									}
									else
									{}
							$sendto=$ap_CustEmailAddress;
									$mail_subject = "PREMIUM PIN $sitename";
									$mail_text = "Thank you for PREMIUM purchase at $sitename. Reference Number: $ap_ReferenceNumber \r\n".
										"Your PREMIUM pin is: $code \r\n".
										"It contains $pack1 credits! \r\n".
										"In case the pin doesn't work, contact an admin \r\n \r\n".
										"URL: www.$domain \r\n";
										
									$mail_headers = 'From: noreply@'.$domain.''."\r\n".
									'Reply-To: noreply@'.$domain.''."\r\n".
									'Mime-Version: 1.0'."\r\n". 
									'X-Mailer: PHP/'.phpversion();
								mail($sendto, $mail_subject, $mail_text,$mail_headers);
							echo "<script language=\"JavaScript\">
							<!--
					 		window.location=\"http://www.$domain/?page=purchase&pin=$code\";//--></script>";
							//header("location:buy.php?pin=$code");
						}
						if($ap_Amount == "3" || $ap_Amount == "3.00")
						{
							//Generate a code & insert into DB
							//echo "Your PIN code is: $code";
							mysql_query("update payment set PIN='$code', Valid='2000', email='$ap_CustEmailAddress', type='premium' where transaction='$ap_ReferenceNumber';")
							or die(mysql_error()); 
							$sendto=$ap_CustEmailAddress;
									$mail_subject = "PREMIUM PIN $sitename";
									$mail_text = "Thank you for PREMIUM purchase at $sitename. Reference Number: $ap_ReferenceNumber\r\n".
										"Your PREMIUM pin is: $code \r\n".
										"It contains 2000 credits! \r\n".
										"In case the pin doesn't work, contact an admin \r\n \r\n".
										"URL: www.$domain \r\n";
										
									$mail_headers = 'From: noreply@'.$domain.''."\r\n".
									'Reply-To: noreply@'.$domain.''."\r\n".
									'Mime-Version: 1.0'."\r\n". 
									'X-Mailer: PHP/'.phpversion();
								mail($sendto, $mail_subject, $mail_text,$mail_headers);
							echo "<script language=\"JavaScript\">
							<!--
					 		window.location=\"http://www.$domain/?page=purchase&pin=$code\";//--></script>";
							//header("location:buy.php?pin=$code");
						}
						if($ap_Amount == "6" || $ap_Amount == "6.00")
						{
							//Generate a code & insert into DB
							//echo "Your PIN code is: $code";
							mysql_query("update payment set PIN='$code', Valid='5000', email='$ap_CustEmailAddress', type='premium' where transaction='$ap_ReferenceNumber';")
							or die(mysql_error()); 
							$sendto=$ap_CustEmailAddress;
									$mail_subject = "PREMIUM PIN $sitename";
									$mail_text = "Thank you for PREMIUM purchase at $sitename. Reference Number: $ap_ReferenceNumber\r\n".
										"Your PREMIUM pin is: $code \r\n".
										"It contains 5000 credits! \r\n".
										"In case the pin doesn't work, contact an admin \r\n \r\n".
										"URL: www.$domain \r\n";
										
									$mail_headers = 'From: noreply@'.$domain.''."\r\n".
									'Reply-To: noreply@'.$domain.''."\r\n".
									'Mime-Version: 1.0'."\r\n". 
									'X-Mailer: PHP/'.phpversion();
								mail($sendto, $mail_subject, $mail_text,$mail_headers);
							echo "<script language=\"JavaScript\">
							<!--
					 		window.location=\"http://www.$domain/?page=purchase&pin=$code\";//--></script>";
						}
						if($ap_Amount != "1" || $ap_Amount != "3" || $ap_Amount != "6" || $ap_Amount != "20" || $ap_Amount != "1.00" || $ap_Amount != "20.00" || $ap_Amount != "3.00" || $ap_Amount != "6.00")
	{
							$sendto=$ap_CustEmailAddress;
									$mail_subject = "PREMIUM PIN $sitename";
									$mail_text = "Thank you for PREMIUM purchase at $sitename.\r\n".
										"Your transaction has been denied - Reason: Wrong amount payed \r\n".
										"Please contact an admin if this is incorrect \r\n".
										"Please provide your $ap_ReferenceNumber \r\n \r\n".
										"URL: www.$domain \r\n";
										
									$mail_headers = 'From: noreply@'.$domain.''."\r\n".
									'Reply-To: noreply@'.$domain.''."\r\n".
									'Mime-Version: 1.0'."\r\n". 
									'X-Mailer: PHP/'.phpversion();
								mail($sendto, $mail_subject, $mail_text,$mail_headers);
	}
						}
                    }
                    else
                    {
							$sendto=$ap_CustEmailAddress;
									$mail_subject = "PREMIUM PIN $sitename";
									$mail_text = "Thank you for PREMIUM purchase at $sitename.\r\n".
										"Your transaction has been denied - Reason: Payment not completed\r\n".
										"Please contact an admin if this is incorrect \r\n".
										"Please provide your $ap_ReferenceNumber \r\n \r\n".
										"URL: www.$domain \r\n";
										
									$mail_headers = 'From: noreply@'.$domain.''."\r\n".
									'Reply-To: noreply@'.$domain.''."\r\n".
									'Mime-Version: 1.0'."\r\n". 
									'X-Mailer: PHP/'.phpversion();
								mail($sendto, $mail_subject, $mail_text,$mail_headers);
                        // Transaction cancelled means seller explicitely cancelled the subscription or AlertPay 								
						// cancelled or it was cancelled since buyer didnt have enough money after resheduling after two times.
                        // Take Action appropriately
                    }
            }
	}

	// Security code variable

?>