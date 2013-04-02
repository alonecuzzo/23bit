<?php 
$your_email=$_POST['contact_widgetemail'];
if(isset($_POST['contact_name'])) {

		if(trim($_POST['contact_name']) === '') {
			$hasError = true;
		} else {
			$name = trim($_POST['contact_name']);
		}
		
		if(trim($_POST['contact_email']) === '')  {
			$hasError = true;
		} else if (!preg_match("/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i", trim($_POST['contact_email']))) {
			$hasError = true;
			$errorMessage =  'Please enter a valid email address!';
		} else {
			$email = trim($_POST['contact_email']);
		}

		

			
		if(trim($_POST['contactcomment']) === '') {
			$hasError = true;
		} else {
			if(function_exists('stripslashes')) {
				$comments = stripslashes(trim($_POST['contactcomment']));
			} else {
				$comments = trim($_POST['contactcomment']);
			}
		}

// send email
		if(!isset($hasError)) {

			$emailTo = $your_email;
			$subject = 'Contact Form Submission from '.$name;
			
			// message bid====
			$body  ="Name: $name \n\n";
			$body .="Email: $email \n\n";
	         $body .="Message: $comments";


			$headers = 'From: '.$name.' <'.$email.'>' . "\r\n" . 'Reply-To: ' . $email;
			
			mail($emailTo, $subject, $body, $headers);

			$emailSent = true;
	}
} 
?>
<?php if(isset($emailSent) == true) { ?>
<div class="messagebox success">
<div class="messagebox_content">Thank you!, <strong><?php echo $name;?></strong>.<br> Your message was successfully sent</div>
</div>
<?php } ?>
<?php if(isset($hasError) ) { ?>
<div class="messagebox error">
<div class="messagebox_content">
<?php echo $errorMessage;?>
</div>
</div>
<?php } ?>