<!DOCTYPE html>
<html>
<head>
	<title>Confirmation Email</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body style="font-family: Arial, sans-serif;">

	<h1>Welcome to our Serenity Salon!</h1>
    <h2>Date: {{$mailData['dates']}}</h2>

	<p>Dear {{$mailData['names']}},</p>

	<p>We hope this email finds you well. We have confirmed your availed services are already finished.</p>
	<br>
	<h2>Payment:</h2>

	<p>The total amount of {{$mailData['totals']}} is already paid and confirmed by the administrator</p>

	<p>Thank you for your continued support!</p>
    <br>
	<p>Best regards,</p>
	<p>The Serenity Team</p>

</body>
</html>
