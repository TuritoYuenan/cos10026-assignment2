<!DOCTYPE html>
<html lang='en'>

<head>
	<meta charset='UTF-8'>
	<meta name='viewport' content='width=device-width, initial-scale=1.0'>
	<meta name='description' content='Application form for working at AvtoZeichen'>

	<title>Apply to AvtoZeichen | AvtoZeichen</title>

	<link rel='shortcut icon' href='./images/favicon.svg' type='image/x-icon'>
	<link rel='stylesheet' href='./styles/style.css'>

	<link rel='preconnect' href='https://fonts.googleapis.com'>
	<link rel='preconnect' href='https://fonts.gstatic.com' crossorigin>
	<link href='https://fonts.googleapis.com/css2?family=Lexend:wght@400;700&family=Ubuntu:wght@700&display=swap'
		rel='stylesheet'>
</head>

<body>
	<?php require_once './+bmenu.inc'; ?>
	<?php require_once './+header.inc'; ?>

	<header>
		<h1>Apply to work at AvtoZeichen</h1>
	</header>

	<form action='./processEOI.php' method='post' novalidate='novalidate'>
		<datalist id='positions'>
			<option value='DAT01'></option>
			<option value='ENG01'></option>
			<option value='PRG01'></option>
			<option value='ISA01'></option>
			<option value='ENG02'></option>
		</datalist>

		<fieldset>
			<legend>Position</legend>
			<label for='jobref'>Job Reference Number</label><br>
			<input list='positions' type='text' name='jobref' id='jobref' maxlength='5' pattern='[A-Za-z0-9]{5}' required>
		</fieldset>

		<fieldset>
			<legend>Personal info</legend>
			<div class='dual'>
				<p>
					<label for='fname'>First Name</label><br>
					<input type='text' name='fname' id='fname' maxlength='20' pattern='[A-Za-z ]*' required>
				</p>
				<p>
					<label for='lname'>Last Name</label><br>
					<input type='text' name='lname' id='lname' maxlength='20' required>
				</p>
			</div>
			<p>
				<label for='bday'>Date of birth</label><br>
				<input type='text' name='bday' id='bday' pattern='([012]?[0-9]|3[01])/(0?[1-9]|1[012])/([01]?[0-9][0-9][0-9]|200[0-9])' maxlength='10' required>
			</p>
		</fieldset>

		<fieldset>
			<legend>Gender</legend>
			<input type='radio' name='gender' value='male' id='male' required><label for='male'>Male</label>
			<input type='radio' name='gender' value='female' id='female'><label for='female'>Female</label>
			<input type='radio' name='gender' value='jesus' id='jesus'><label for='jesus'>Lord</label>
			<input type='radio' name='gender' value='toyota' id='toyota'><label for='toyota'>Toyota Corolla</label>
			<input type='radio' name='gender' value='copter' id='copter'><label for='copter'>Attack Helicopter</label>
			<input type='radio' name='gender' value='other' id='other'><label for='other'>Other</label>
		</fieldset>

		<fieldset>
			<legend>Address</legend>
			<p>
				<label for='street'>Street address</label><br>
				<input type='text' name='street' id='street' maxlength='40' pattern='[A-Za-z0-9/\-, ]*' required>
			</p>
			<p>
				<label for='town'>Suburb/Town</label><br>
				<input type='text' name='town' id='town' maxlength='40' pattern='[A-Za-z0-9/\-, ]*' required>
			</p>
			<div class='dual'>
				<p>
					<label for='state'>State</label><br>
					<select name='state' id='state' required>
						<option value=''>Choose an Australian state</option>
						<option value='VIC'>VIC</option>
						<option value='NSW'>NSW</option>
						<option value='QLD'>QLD</option>
						<option value='NT'>NT</option>
						<option value='WA'>WA</option>
						<option value='SA'>SA</option>
						<option value='TAS'>TAS</option>
						<option value='ACT'>ACT</option>
					</select>
				</p>
				<p>
					<label for='postcode'>Postcode</label><br>
					<input type='text' name='postcode' id='postcode' maxlength='4' pattern='\d{4}' required>
				</p>
			</div>
		</fieldset>

		<fieldset>
			<legend>Contact Information</legend>
			<p>
				<label for='email'>Email address</label><br>
				<input type='email' name='email' id='email' required>
			</p>
			<p>
				<label for='phone'>Phone number</label><br>
				<input type='tel' name='phone' id='phone' pattern='[0-9 ]{8,12}' required>
			</p>
		</fieldset>

		<fieldset>
			<legend>Skills & Qualifications</legend>
			<div class='dual skill-list'>
				<label for='skill-1'><input type='checkbox' name='skills[]' value='ccna1' id='skill-1' required> CCNA 1</label>
				<label for='skill-2'><input type='checkbox' name='skills[]' value='engcr' id='skill-2' required> IELTS >6.0 or TOEIC >696</label>
				<label for='skill-3'><input type='checkbox' name='skills[]' value='5y-py' id='skill-3'> >5 Years of Python experience</label>
				<label for='skill-4'><input type='checkbox' name='skills[]' value='5y-cp' id='skill-4'> >5 Years of C++ experience</label>
				<label for='skill-o'><input type='checkbox' name='skills[]' value='other' id='skill-o'> Other skills...</label>
			</div>
			<p>
				<label for='skill-a'>Other skills</label><br>
				<textarea name='otherSkills' id='skill-a' cols='30' rows='6'></textarea>
			</p>
		</fieldset>

		<div class='text-right'>
			<input type='reset' value='Clear'>
			<input type='submit' value='Apply'>
		</div>
	</form>

	<?php require_once './+footer.inc'; ?>
</body>

</html>
