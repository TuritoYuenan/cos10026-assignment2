<!DOCTYPE html>
<html lang='en'>

<head>
	<meta charset='UTF-8'>
	<meta name='viewport' content='width=device-width, initial-scale=1.0'>
	<meta name='description' content=''>

	<title>EOI Submission Result | AvtoZeichen</title>

	<link rel='shortcut icon' href='./images/favicon.svg' type='image/x-icon'>
	<link rel='stylesheet' href='./styles/style.css'>

	<link rel='preconnect' href='https://fonts.googleapis.com'>
	<link rel='preconnect' href='https://fonts.gstatic.com' crossorigin>
	<link href='https://fonts.googleapis.com/css2?family=Lexend:wght@400;700&family=Ubuntu:wght@700&display=swap'
		rel='stylesheet'>
</head>

<?php
	// Import utility functions
	require_once './utils.php';

	// Set CSP
	header('Content-Security-Policy: script-src \'self\'');

	// Redirect back to application form page if users manually entered this page from browser
	if ($_SERVER['REQUEST_METHOD'] != 'POST') header('location: apply.php');

	// List of reported errors
	$errors = array();

	/**
	 * Get data from the received form and assign to a variable
	 * @param string $field Name of a field in the form
	 * @return string Data retrived from that field, empty if field is not set
	 */
	function assign_data($field) {
		$data = isset($_POST[$field]) ? $_POST[$field] : '';
		return $data;
	}

	/**
	 * Print list items from an array
	 * @param array $list an array of stuffs
	 */
	function print_list_items($list) {
		foreach ($list as $value) echo '<li>', $value, '</li>';
	}

	/**
	 * Validate data against many requirements.
	 * Will add error messages to `$errors` for every failed check
	 * @param string $field Name of the data's field for data-specific checking
	 */
	function validate_data($field, $value) {
		global $errors, $states, $ref_numbers;

		// Validate data
		switch ($field) {
			case 'jobref':
				if (!preg_match('/^[A-Za-z0-9]{5}$/', $value)) $errors[] = 'Job reference number must consists of 5 letters or numbers';
				if (!in_array($value, array_keys($ref_numbers))) $errors[] = 'Job reference number must be one of the currently recruiting';
				break;
			case 'fname':
				if (!preg_match('/^[A-Za-z ]*$/', $value)) $errors[] = 'First name must contain only letters';
				if (strlen($value) > 20) $errors[] = 'First name must be within 20 characters long';
				break;
			case 'lname':
				if (!preg_match('/^[A-Za-z ]*$/', $value)) $errors[] = 'Last name must contain only letters';
				if (strlen($value) > 20) $errors[] = 'Last name must be within 20 characters long';
				break;
			case 'bday':
				if (!preg_match('/^([012]?[0-9]|3[01])\/(0?[1-9]|1[012])\/([01]?[0-9][0-9][0-9]|200[0-9])$/', $value)) $errors[] = 'Birthday must be in the dd/mm/yyyy format';
				break;
			case 'postcode':
				if (!preg_match('/^\d{4}$/', $value)) $errors[] = 'Postcode must be a four-digit number';
				break;
			case 'email':
				if (!preg_match('/^[\w\-\.]+@([\w-]+\.)+[\w-]{2,}$/', $value)) $errors[] = 'Email address must follow standard format';
				break;
			case 'phone':
				if (!preg_match('/^[0-9 ]*$/', $value)) $errors[] = 'Phone number must contain 8 - 12 digits or spaces';
				break;
			case 'street':
				if (strlen($value) > 40) $errors[] = 'Street address must be within 40 characters long';
				break;
			case 'town':
				if (strlen($value) > 40) $errors[] = 'Suburb/Town must be within 40 characters long';
				break;
			case 'state':
				if (!in_array($value, array_keys($states))) $errors[] = 'State must be a valid state code in Australia';
				break;
		}
	}

	/**
	 * Validate that postcode must match state
	 * @param string $state Received state of an EOI
	 * @param string $postcode Received postcode of an EOI
	 * @return void Log an error if validation failed
	 */
	function validate_state_postcode($state, $postcode) {
		global $errors, $states;

		if (!$states[$state]((int) $postcode)) {
			$errors[] = 'Your postcode (' . $postcode . ') and state (' . $state . ') does not match';
		}
	}

	/**
	 * The webpage's main process
	 * @return bool `true` if succeeded, `false` if an error is found
	 */
	function main_process() {
		global $errors, $eoi_number;

		// Connect to database
		try {
			require_once './settings.php';
			$conn = mysqli_connect(Hostname, Username, Password, Database);
		} catch (Exception $error) {
			$errors[] = "Failed to connect to the database";
			return false;
		}

		// Get data from the received EOI
		$formdata = array(
			'jobref' => assign_data('jobref'),
			'fname' => assign_data('fname'),
			'lname' => assign_data('lname'),
			'bday' => assign_data('bday'),
			'gender' => assign_data('gender'),
			'street' => assign_data('street'),
			'town' => assign_data('town'),
			'state' => assign_data('state'),
			'postcode' => assign_data('postcode'),
			'email' => assign_data('email'),
			'phone' => assign_data('phone'),
			'skills' => (array) (isset($_POST['skills']) ? $_POST['skills'] : []),
			'otherSkills' => assign_data('otherSkills'),
		);

		// Sanitise and validate each field of data
		foreach ($formdata as $field => $value) {
			// Sanitise data
			if ($field == 'skills') {
				$formdata[$field] = sanitise_array($formdata[$field]);
			} else {
				$formdata[$field] = sanitise_data($formdata[$field]);
			}

			// Validate 1: Other skills checking
			if ($field == 'otherSkills') {
				if (empty($value) and in_array('other', $formdata['skills'])) {
					$errors[] = 'Please specify your other skills if you have';
				}
				if (!empty($value) and !in_array('other', $formdata['skills'])) {
					$errors[] = 'Please go back and tick on "Other skills" to confirm';
				}
				continue;
			}

			// Validate 1: Required data checking
			if (empty($value)) {
				$errors[] = $field . ' is required!';
				continue;
			}

			// Validate 2: Data-specific checking
			validate_data($field, $value);
		}

		// Validate 3: State-Postcode checking
		if ($formdata['state'] and $formdata['postcode']) validate_state_postcode($formdata['state'], $formdata['postcode']);

		// Other skills checkbox is no longer needed after validation
		$formdata['skills'] = array_diff($formdata['skills'], ['other']);

		// Perform no database task if errors are found
		if (count($errors) > 0) return false;

		// Create new tables for storing data if not predefined
		$conn -> prepare("CREATE TABLE IF NOT EXISTS `eoi` (
			`eoi_number` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
			`ref_number` char(5) NOT NULL,
			`status` enum('New','Current','Final') NOT NULL DEFAULT 'New',
			`first_name` varchar(20) NOT NULL,
			`last_name` varchar(20) NOT NULL,
			`birth_date` char(10) NOT NULL,
			`gender` enum('male','female','jesus','toyota','copter','other') NOT NULL,
			`street` varchar(40) NOT NULL,
			`town` varchar(40) NOT NULL,
			`state` enum('VIC','NSW','QLD','NT','WA','SA','TAS','ACT') NOT NULL,
			`postcode` smallint(4) unsigned zerofill NOT NULL,
			`email` varchar(40) NOT NULL,
			`phone` varchar(16) NOT NULL,
			PRIMARY KEY (`eoi_number`),
			CONSTRAINT `APPLY_POSITION` FOREIGN KEY (`ref_number`) REFERENCES `jobs` (`ref_number`)
		) COMMENT='EOI for COS10026 Assignment 2'") -> execute();

		$conn -> prepare("CREATE TABLE IF NOT EXISTS `eoi_skills` (
			`eoi_number` mediumint(8) unsigned NOT NULL,
			`skill_1` varchar(512),
			`skill_2` varchar(512),
			`skill_3` varchar(512),
			`skill_4` varchar(512),
			`skill_others` text NOT NULL,
			PRIMARY KEY (`eoi_number`),
			CONSTRAINT `EOI_LINK` FOREIGN KEY (`eoi_number`) REFERENCES `eoi` (`eoi_number`)
		) COMMENT='EOI Skills for COS10026 Assignment 2'") -> execute();

		// Prepare SQL statements
		$insert = $conn -> prepare('INSERT INTO eoi
			(ref_number, first_name, last_name, birth_date, gender, street, town, state, postcode, email, phone)
			VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');

		$insert_skills = $conn -> prepare('INSERT INTO eoi_skills
			(eoi_number, skill_others, skill_1, skill_2, skill_3, skill_4)
			VALUES (LAST_INSERT_ID(), ?, ?, ?, ?, ?)');

		// Load form data into SQL queries
		$insert -> bind_param('ssssssssiss',
			$formdata['jobref'], $formdata['fname'],
			$formdata['lname'], $formdata['bday'],
			$formdata['gender'], $formdata['street'],
			$formdata['town'], $formdata['state'],
			$formdata['postcode'],
			$formdata['email'], $formdata['phone']
		);

		$insert_skills -> bind_param('sssss',
			$formdata['otherSkills'],
			$formdata['skills'][0], $formdata['skills'][1],
			$formdata['skills'][2], $formdata['skills'][3]
		);

		// Execute queries
		$insert -> execute();
		$insert_skills -> execute();

		// Get ID number for the submitted EOI
		$eoi_number = $insert -> insert_id;

		// Close prepared statements and database connections
		$insert -> close();
		$insert_skills -> close();
		$conn -> close();

		// Having reached this point, the process is considered successful
		return true;
	}
?>

<body id='process-page'>
	<?php require_once './+bmenu.inc'; ?>
	<?php require_once './+header.inc'; ?>

	<header id='process-message'><div>
		<?php if (main_process()): ?>

		<h1 class='text-green'>Your EOI has been sent!</h1>
		<p class='text-center'>Thank you for your effort! Your EOI number is <?php echo $eoi_number; ?>.</p>
		<p class='text-center'>You can now go back to <a href='/' class='text-yellow'>the homepage</a>.</p>

		<?php else: ?>

		<h1 class='text-red'>Your EOI has not been sent! Sorry!</h1>
		<p class='text-center'>Please check the following errors (contact us if you need support):</p>
		<ul class='grid'><?php echo list_items($errors); ?></ul>

		<?php endif ?>
	</div></header>

	<?php require_once './+footer.inc'; ?>
</body>

</html>
