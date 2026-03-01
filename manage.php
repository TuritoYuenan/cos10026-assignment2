<!DOCTYPE html>
<html lang='en'>

<head>
	<meta charset='UTF-8'>
	<meta name='viewport' content='width=device-width, initial-scale=1.0'>
	<meta name='description' content=''>

	<title>EOI Manager | AvtoZeichen</title>

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

	// All forms send data back to this page to process
	$formaction = trim(htmlspecialchars($_SERVER['PHP_SELF']));

	// List of tasks available on the page
	$list_of_tasks = array(
		'list_all' => 'List all',
		'list_jobs' => 'List by job',
		'list_name' => 'List by name',
		'delete_jobs' => 'Delete by job',
		'mark_new' => 'Mark New',
		'mark_current' => 'Mark Current',
		'mark_final' => 'Mark Final'
	);

	/**
	 * Display a dropdown for choosing job position
	 * @return string A select tag with the job positions
	 */
	function jobref_dropdown($name) {
		global $ref_numbers;

		$dropdown = "<select name='$name'><option value=''>Pick a job title</option>";
		foreach ($ref_numbers as $jobref => $job) $dropdown .= "<option value='$jobref'>$job</option>";

		$dropdown .= '</select>';
		return $dropdown;
	}

	/**
	 * Display skills for an EOI
	 * @param string $s1 First skill
	 * @param string $s2 Second skill
	 * @param string $s3 Third skill
	 * @param string $s4 Fourth skill
	 * @return string Skills as HTML list items
	 */
	function eoi_skills($s1, $s2, $s3, $s4) {
		$skill_list = array(
			'ccna1' => 'CCNA 1',
			'engcr' => 'IELTS 6.0+ or TOEIC 696+',
			'5y-py' => '5+ Years of Python experience',
			'5y-cp' => '5+ Years of C++ experience'
		);

		$skills = '';

		if (!empty($s2)) $skills .= '<li>' . $skill_list[$s1] . '</li>';
		if (!empty($s2)) $skills .= '<li>' . $skill_list[$s2] . '</li>';
		if (!empty($s3)) $skills .= '<li>' . $skill_list[$s3] . '</li>';
		if (!empty($s4)) $skills .= '<li>' . $skill_list[$s4] . '</li>';

		return $skills;
	}

	/**
	 * Display Mark buttons for an EOI
	 * @param string $eoi_number EOI number to identify the EOI
	 * @param string $status The EOI's current status, used to avoid redundant button
	 * @return string A HTML form consisting of Mark buttons appropriate to the EOI
	 */
	function eoi_mark_buttons($eoi_number, $status) {
		global $formaction;

		$buttons = '<form method="post" action="' . $formaction . '">';
		$buttons .= '<input type="hidden" name="eoi_number" value="' . $eoi_number . '">';

		if ($status != 'New') $buttons .= '<input type="submit" name="task" value="Mark New">';
		if ($status != 'Current') $buttons .= '<input type="submit" name="task" value="Mark Current">';
		if ($status != 'Final') $buttons .= '<input type="submit" name="task" value="Mark Final">';

		$buttons .= '</form>';
		return $buttons;
	}

	/**
	 * Display an EOI
	 * @param object $eoi EOI data object from the a database
	 * @return void Print out an EOI entry on the webpage
	 */
	function display_eoi($eoi) {
		$name = $eoi -> first_name . ' ' . $eoi -> last_name;
		echo '<details><summary><h3>#', $eoi -> eoi_number, ' ', $name, '</h3></summary>';
		echo '<p id="eoi-tags"><span>Status: ', $eoi -> status, '</span><span>Apply to: ', $eoi -> ref_number, '</span>';
		echo '<span>Gender: ', display_gender($eoi -> gender), '</span><span>DoB: ', $eoi -> birth_date, '</span></p><section>';
		echo '<h4>Address</h4><ul><li>', $eoi -> street, '</li><li>', $eoi -> town, ', ', $eoi -> state, ' ', $eoi -> postcode, '</li></ul>';
		echo '<h4>Contact</h4><ul><li>', $eoi -> email, '</li><li>', $eoi -> phone, '</li></ul>';
		echo '<h4>Skills</h4><ul>', eoi_skills($eoi -> skill_1, $eoi -> skill_2, $eoi -> skill_3, $eoi -> skill_4), '</ul>';
		if ($eoi -> skill_others) echo '<h4>Other Skills</h4><ul><li>', $eoi -> skill_others, '</li></ul>';
		echo '</section>', eoi_mark_buttons($eoi -> eoi_number, $eoi -> status), '</details>';
	}

	/**
	 * The webpage's main process
	 * @return bool `true` if succeeded, `false` if some errors are found
	 */
	function main_process() {
		global $list_of_tasks;

		// Exit early if no task is given
		if (!isset($_POST['task'])) return true;

		// Get the task to do
		$task = sanitise_data($_POST['task']);

		// Exit early if given task is not known
		if (!in_array($task, $list_of_tasks)) return true;

		// Connect to database
		try {
			require_once './settings.php';
			$conn = mysqli_connect(Hostname, Username, Password, Database);
		} catch (Exception $error) {
			echo '<aside class="infobox"><h2>Could not connect to database</h2><p>';
			if ($error -> getCode() == 2002) {
				echo 'Please try again with our provided VPN enabled';
			} else {
				echo 'Something wrong happened: ', $error -> getMessage();
			}
			echo '</p></aside>';
			return false;
		}

		switch ($task) {
			case $list_of_tasks['mark_new']:
			case $list_of_tasks['mark_current']:
			case $list_of_tasks['mark_final']:
				// 1. Get necessary data
				$eoi_number = empty($_POST['eoi_number']) ? '' : sanitise_data($_POST['eoi_number']);
				$status = end(explode(' ', $task));

				// 2. Prepare SQL statement, bind parameters
				$sql = $conn -> prepare('UPDATE eoi SET `status` = ? WHERE `eoi_number` = ?');
				$sql -> bind_param('si', $status, $eoi_number);
				break;
			case $list_of_tasks['delete_jobs']:
				// 1. Get necessary data
				$jobref = empty($_POST['d-jobref']) ? '' : sanitise_data($_POST['d-jobref']);

				// 2. Prepare SQL statement, bind parameters
				$sql = $conn -> prepare('DELETE FROM eoi WHERE ref_number = ?');
				$sql -> bind_param('s', $jobref);
				break;
			case $list_of_tasks['list_all']:
				// 2. Prepare SQL statement
				$sql = $conn -> prepare('SELECT * FROM eoi LEFT JOIN eoi_skills
					ON eoi.eoi_number = eoi_skills.eoi_number LIMIT 100');
				break;
			case $list_of_tasks['list_jobs']:
				// 1. Get necessary data
				$jobref = empty($_POST['l-jobref']) ? '' : sanitise_data($_POST['l-jobref']);

				// 2. Prepare SQL statement, bind parameters
				$sql = $conn -> prepare('SELECT * FROM eoi LEFT JOIN eoi_skills
					ON eoi.eoi_number = eoi_skills.eoi_number WHERE ref_number = ? LIMIT 100');
				$sql -> bind_param('s', $jobref);
				break;
			case $list_of_tasks['list_name']:
				// 1. Get necessary data
				$fname = empty($_POST['fname']) ? '' : sanitise_data($_POST['fname'] . '%');
				$lname = empty($_POST['lname']) ? '' : sanitise_data($_POST['lname'] . '%');

				// 2. Prepare SQL statement, bind parameters
				$sql = $conn -> prepare('SELECT * FROM eoi LEFT JOIN eoi_skills
					ON eoi.eoi_number = eoi_skills.eoi_number
					WHERE first_name LIKE ? OR last_name LIKE ? LIMIT 100');
				$sql -> bind_param('ss', $fname, $lname);
				break;
		}

		switch ($task) {
			case $list_of_tasks['mark_new']:
			case $list_of_tasks['mark_current']:
			case $list_of_tasks['mark_final']:
				// Execute Mark task and announce result
				$sql -> execute();
				echo '<aside class="infobox"><h2>Updated EOI #', $eoi_number, ' to ', $status, '</h2></aside>';
				break;
			case $list_of_tasks['delete_jobs']:
				// Execute Delete task and announce result
				$sql -> execute();
				echo '<aside class="infobox"><h2>Deleted ', $sql -> affected_rows, ' entries</h2></aside>';
				break;
			case $list_of_tasks['list_all']:
			case $list_of_tasks['list_name']:
			case $list_of_tasks['list_jobs']:
				// Execute List task and get result
				$sql -> execute(); $result = $sql -> get_result();

				// Announce number of entries and list them out
				echo '<aside class="infobox"><h2>Listed ', $result -> num_rows, ' entries</h2></aside>';
				while ($entry = $result -> fetch_object()) display_eoi($entry);
				break;
		}

		// Close prepared statements and database connections
		$sql -> close();
		$conn -> close();

		// Having reached this point, the process is considered successful
		return true;
	}
?>

<body>
	<?php require_once './+bmenu.inc'; ?>
	<?php require_once './+header.inc'; ?>

	<header>
		<h1>EOI Manager</h1>
	</header>

	<form action='<?php echo $formaction; ?>' novalidate='novalidate' id='manage-toolbars' method='post'>
		<fieldset class='grid double'>
			<legend>Delete EOIs</legend>
			<?php echo jobref_dropdown('d-jobref'); ?>
			<input type='submit' name='task' value='Delete by job'>
		</fieldset>

		<fieldset class='grid'>
			<legend>List EOIs</legend>
			<div class='grid double'>
				<div class='hidden'></div>
				<input type='submit' name='task' value='List all'>
			</div>
			<div class='grid triple'>
				<input type='text' name='fname' id='fname' maxlength='20' pattern='[A-Za-z ]*' placeholder='First name' required>
				<input type='text' name='lname' id='lname' maxlength='20' pattern='[A-Za-z ]*' placeholder='Last name' required>
				<input type='submit' name='task' value='List by name'>
			</div>
			<div class='grid double'>
				<?php echo jobref_dropdown('l-jobref'); ?>
				<input type='submit' name='task' value='List by job'>
			</div>
		</fieldset>
	</form>

	<main>
		<section id='eoi-list'><?php main_process(); ?></section>
	</main>

	<?php require_once './+footer.inc'; ?>
</body>

</html>
