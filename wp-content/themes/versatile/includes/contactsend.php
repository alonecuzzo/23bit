<?php
require_once( '../../../../wp-load.php' );
// Do not edit this if you are not familiar with php
error_reporting (E_ALL ^ E_NOTICE);
$post = (!empty($_POST)) ? true : false;
if($post) 
{
	function ValidateEmail($email) 	
	{
		$regex = "^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^";
		$eregi = preg_replace($regex,'', trim($email));
		return empty($eregi) ? true : false;
	}
$name = stripslashes($_POST['name']);
$to = trim($_POST['to']);
$email = trim($_POST['email']);
$subject = stripslashes($_POST['subject']);
$message = stripslashes($_POST['message']);
$phone = stripslashes($_POST['phone']);
$answer = trim($_POST['answer']);
$verificationanswer="4"; // Please change the answer for the captcha
$error = '';
$Reply=$to;
$from=$to;
// Name Validation
	if(!$name) 
	{
		$error .= __('Please enter your name.','versatile_front');
		$error .= '<br />';
	}

	// Email Field Validation
	if(!$email) 
	{
		$error .= __('Please enter an e-mail address','versatile_front');
		$error .= '<br />';
	}
	// Email Validation
	if($email && !ValidateEmail($email)) 
	{
		$error .= __('Please enter a valid e-mail address.','versatile_front');
		$error .= '<br />';
	}

	// Phone Validation
	if(is_numeric($phone)) {
		if(!$phone || strlen($phone) < 8) {
		$error .= __('Please enter your Phone Number. It should have 10 digits.','versatile_front');
		$error .= '<br />';
		}
		} else {
		$error .= __('Please enter numeric characters in Phone Number field.','versatile_front');
		$error .= '<br />';
		}

		// Subject Validation
		if(!$subject) {
		$error .= __('Please enter your subject.','versatile_front');
		$error .= '<br />';

		}
		// Captcha Validation
		if( $answer <> $verificationanswer) {
		$error .= __('Please enter the Correct verification number.','versatile_front');
		$error .= '<br />';
		}

		// Message Validation
		if(!$message || strlen($message) < 5) {
		$error .= __('Please enter your message. It should have at least 5 characters.','versatile_front');
		$error .= '<br />';
		}
	
		// Message Output
		if(!$error) 
			{
			$messages="From: $email <br>";
			$messages.="Name: $name <br>";
			$messages.="Email: $email <br>";
			$messages.="Phone: $phone <br>";
			$messages.="Message: $message <br>";
			$emailto=$to;
			$mail = mail($emailto,$subject,$messages,"from: $email <$email>\nReply-To: $email \nContent-type: text/html");	
			if($mail) 
				{
				echo 'OK';
				}
			}else {?>
			<!-- ERROR FUNCTION -->
			<?php echo '<div class="messagebox error"><div class="messagebox_content"><a class="close_note" href="#">close</a>'.$error.'</div></div>'; 
			} 
} 
?>