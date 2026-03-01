<?php
	// List of Job Reference Numbers
	// this is bad practice btw, as the list is hardcoded.
	// a better practice is to load from database, but that would be slow.
	$ref_numbers = array(
		'DAT01' => 'Data Scientist',
		'ENG01' => 'Engineer',
		'ENG02' => 'Quality Assurance Engineer',
		'ISA01' => 'Information Security Analyst',
		'PRG01' => 'Automation Programmer'
	);

	// List of Genders
	$genders = array(
		'male' => 'Male', 'female' => 'Female',
		'jesus' => 'Lord', 'toyota' => 'Toyota Corolla',
		'copter' => 'Attack Helicopter', 'other' => 'Other'
	);

	// List of Australian states
	// Postcode validation: https://wikipedia.org/wiki/Postcodes_in_Australia#Allocation
	$states = array(
		'VIC' => function ($code) { return in_range($code, 3000, 3999) or in_range($code, 8000, 8999); },
		'NSW' => function ($code) { return in_range($code, 1000, 2999); },
		'QLD' => function ($code) { return in_range($code, 4000, 4999) or in_range($code, 9000, 9999); },
		'NT' => function ($code) { return in_range($code, 800, 999); },
		'WA' => function ($code) { return in_range($code, 6000, 6999); },
		'SA' => function ($code) { return in_range($code, 5000, 5999); },
		'TAS' => function ($code) { return in_range($code, 7000, 7999); },
		'ACT' => function ($code) {
			return in_range($code, 200, 299) or in_range($code, 2600, 2618) or in_range($code, 2900, 2920);
		}
	);

	/**
	 * Sanitise data - first step in cybersecurity
	 * @param string $input Unprocessed data, straight out of the received form
	 * @return string Sanitised data string with most injections sterilised
	 */
	function sanitise_data($input) {
		$data = trim($input);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}

	/**
	 * Sanitise an array of data
	 * @param array $input Array of unprocessed data
	 * @return array Array of sanitised data strings with most injections sterilised
	 */
	function sanitise_array($input) {
		for ($i = 0; $i < count($input); $i++) $input[$i] = sanitise_data($input[$i]);
		return $input;
	}

	/**
	 * Validate if a number is within a number range
	 * @param int $number Number to check
	 * @param int $min Minimum value
	 * @param int $max Maximum value
	 * @return bool `true` if number is in the range, `false` otherwise
	 */
	function in_range($number, $min, $max) {
		return ($number >= $min) and ($number <= $max);
	}

	/**
	 * Format the salary range for a job
	 * @param int $min Minimum salary in dollar
	 * @param int $max Maximum salary in dollar
	 * @return string Salary in the `$min - $max` format
	 */
	function salary_range($min, $max) {
		return '$' . $min . ' - ' . '$' . $max;
	}

	/**
	 * Convert the technical code for a gender to a display name
	 * @param string $gender_code
	 */
	function display_gender($gender_code) {
		global $genders;
		$gender_list = array_keys($genders);

		if (!in_array($gender_code, $gender_list)) return $gender_code;
		return $genders[$gender_code];
	}

	/**
	 * Format an array into an unordered list
	 * @param array $list An array of data
	 * @return string A HTML unordered list
	 */
	function list_items(array $list) {
		$ulist = '';
		foreach ($list as $item) $ulist .= "<li>$item</li>";
		return $ulist;
	}
?>
