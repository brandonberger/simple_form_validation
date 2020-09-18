<!DOCTYPE html>
<html>
<head>
	<title>Daily UI #1</title>
	<link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Julius+Sans+One&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="main.css" />
</head>
<body>
	<div class="container">
		<div class="form-section">
			<div class="form-container">
				<div class="title">
					Registration
				</div>
				<div class="subtitle">
					Let’s get you registered to begin helping the lake. <br />
					To begin we just need some basic information.
				</div>
				<form method="POST" action="register.php">
					<div class="half field">
						<label>First Name</label>
						<input placeholder="First Name" type="text" name="first_name">
					</div>
					<div class="half field">
						<label>Last Name</label>
						<input placeholder="Last Name" type="text" name="last_name">
					</div>
					<div class="half field">
						<label>Date of Birth</label>
						<input type="date" name="dob">
					</div>
					<div class="half field">
						<label>ZIP Code</label>
						<input placeholder="Zip" type="text" name="zip">
					</div>
					<div class="field">
						<label>Email Address</label>
						<input placeholder="Email" type="email" name="email">
					</div>
					<div class="field checkbox-field">
						<label>
							<input type="checkbox" value="1" name="agreement">
							<span class="checkmark"></span>
							<span class="agreement">I agree to the <a>Terms and Conditions</a> and <a>Privacy Policy</a></span>
						</label>
						
					</div>
					<div class="field" style="margin-top: 35px;">
						<label></label>
						<input type="submit" name="">
					</div>
				</form>
			</div>
			<div class="contact">
				<p>Have a better idea for this years retreat? <a>Let us know</a></p>
			</div>
		</div>
		<div class="hero-section">
			<div class="hero-container">
				<div class="title">
					2019
				</div>
				<div class="location">South Holston Lake </div>
				<div class="event">Trash Retreat</div>
			</div>
		</div>
	</div>
</body>
</html>