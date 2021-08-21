<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Swash Wash - Resend OTP Request</title>
		<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
		<style type="text/css">
			*{font-family: 'Roboto', sans-serif;margin:0px;padding: 0px;}
			h4{color: #000; font-size: 34px;font-weight: 400;margin-bottom: 10px;}
			strong{color: #000; font-size: 18px;font-weight: 300;margin-bottom: 15px;}
			p{color: #555555;font-size: 15px;font-weight: 300;margin-bottom: 15px;line-height: 25px;}
		</style>
	</head>

	<body>
		<?php $emailAddress = base64_encode($details['email']);
		$userid = base64_encode($details['id']);?>
		<div style="max-width: 600px; margin:0 auto;">
			<div style ="display:block; position:relative; padding:25px; background-color: #eef0f3">
                <div style="display: block;text-align: center;">
                    <img src="https://swash.i4dev.in/public/images/logo.png" />
                </div>
				<div style="display: block; position: relative;padding: 32px;background-color: #fff;border-radius: 10px;box-shadow: 0px 0px 10px #e2e2e2;">
				    <h4>Dear User</h4>
					<p>We have received Resend OTP request for your Account</p>
					<p>Please verify yourself and confirm your email by entering the below One Time Password in your web browser</p>
                    <p style="text-align: center; margin:20px 0px"><span style="background-color: green;color: white; padding: 10px 20px; font-size:22px; display: inline-block; border-radius:10px;">OTP:- {{$details['otp']}}</span></p>
					<p>If you did not request a Resend OTP request, please ignore this email. This password reset is only valid for the next 1 hour.</p>
					<p style="padding-top: 20px;">Kind Regards,</p>
					<p><b>Swash Team</b></p>
				</div>
			</div>
		</div>
	</body>
</html>
