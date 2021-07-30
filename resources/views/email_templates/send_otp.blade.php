<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Welcome to Swash - Send Otp!</title>
		<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
		<style type="text/css">
			*{font-family: 'Roboto', sans-serif;margin:0px;padding: 0px;}
			h2{color: #000; font-size: 34px;font-weight: 400;margin-bottom: 10px;}
			strong{color: #000; font-size: 18px;font-weight: 300;margin-bottom: 15px;}
			p{color: #555555;font-size: 15px;font-weight: 300;margin-bottom: 20px;line-height: 25px;}
		</style>
	</head>

	<body>
		<?php $emailAddress = base64_encode($details['email']);
		$userid = base64_encode($details['user_id']);?>
		<div style="max-width: 600px; margin:0 auto;">
			<div style ="display:block; position:relative; padding:25px; background-color: #eef0f3">
				<div style="display: block; position: relative;padding: 32px;background-color: #fff;border-radius: 10px;box-shadow: 0px 0px 10px #e2e2e2;">
					<p><strong>Dear <?php if(empty($details['name'])){ 'Admin';} else{ ?> {{$details['name']}} <?php } ?></strong></p>
					<p>You are receiving this mail because we got OTP request on "Swash" platform.</p>
					<p style="text-align: center;">Use below given OTP to reset your password </p>
					<p style="text-align: center;">OTP:- {{$details['otp']}}</p>
					<p>If it wasn't you who submitted your email address in the first place, we apologies for the error.</p>
					<p>Please ignore this email. You will not receive any further email from us.</p>
					<p style="padding-top: 20px;">Kind Regards,</p>
					<p><b>Swash Team</b></p>
				</div>
			</div>
		</div>
	</body>
</html>