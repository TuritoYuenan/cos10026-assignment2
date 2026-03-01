<!DOCTYPE html>
<html lang='en'>

<head>
	<meta charset='UTF-8'>
	<meta name='viewport' content='width=device-width, initial-scale=1.0'>
	<meta name='description' content='List of jobs/positions offered at AvtoZeichen'>

	<title>Job Descriptions | AvtoZeichen</title>

	<link rel='shortcut icon' href='./images/favicon.svg' type='image/x-icon'>
	<link rel='stylesheet' href='./styles/style.css'>

	<link rel='preconnect' href='https://fonts.googleapis.com'>
	<link rel='preconnect' href='https://fonts.gstatic.com' crossorigin>
	<link href='https://fonts.googleapis.com/css2?family=Lexend:wght@400;700&family=Ubuntu:wght@700&display=swap'
		rel='stylesheet'>
</head>

<?php
	require_once './utils.php';

	/**
	 * Print out a job desciption entry
	 * @param $job An object containing properties of a job
	 */
	function echo_one_job_description($job) {
		echo '<details>';
		echo '<summary><h3>', $job -> ref_number, ' | ', $job -> title, '</h3></summary>';
		echo '<section>';

		echo '<h4>Description</h4><p>', $job -> description, '</p>';
		echo '<h4>Salary range</h4><p>', salary_range($job -> salary_min, $job -> salary_max), '</p>';
		echo '<h4>Report to</h4><p>', $job -> report_to, '</p>';

		echo '<h4>Responsibilities</h4>';
		echo '<ul>', list_items(explode('|', $job -> responsibilities)), '</ul>';
		echo '<h4>Essential requirements</h4>';
		echo '<ul>', list_items(explode('|', $job -> requirements_essentials)), '</ul>';

		if ($job -> requirements_preferable) {
			echo '<h4>Preferable requirements</h4>';
			echo '<ul>', list_items(explode('|', $job -> requirements_preferable)), '</ul>';
		}

		echo '<a href="./apply.php" class="cta">Apply Now</a></section>';
		echo '</details>';
	}

	/**
	 * The webpage's main process
	 * @return bool `true` if succeeded, `false` if some errors are found
	 */
	function main_process() {
		try {
			require_once './settings.php';
			$conn = mysqli_connect(Hostname, Username, Password, Database);
		} catch (Exception $error) {
			$error_msg = $error -> getmessage();
			echo '<h2>Could not load job descriptions</h2><p>', $error_msg, '</p>';
			return false;
		}

		$sql = $conn -> prepare('SELECT * FROM jobs ORDER BY ref_number');
		$sql -> execute(); $result = $sql -> get_result();

		if (!$result) {
			echo '<h2>There are no job descriptions available</h2>';
			return false;
		}

		while ($job = $result -> fetch_object()) echo_one_job_description($job);

		$result -> free_result();
		$sql -> close();
		$conn -> close();
	}
?>

<body>
	<?php require_once './+bmenu.inc'; ?>
	<?php require_once './+header.inc'; ?>

	<header id='top'>
		<h1>Job Descriptions</h1>
	</header>

	<main>
		<aside class='infobox'>
			<h2>General requirements</h2>
			<ol>
				<li>IoT passion and resonance to the company's mission statement.</li>
				<li>Certification: CCNA 1.</li>
				<li>At least IELTS 6.0 or TOEIC 6969 (non-native English speakers).</li>
			</ol>
		</aside>

		<?php main_process(); ?>

		<aside id='go-up'>
			<a href='#top'>
				<strong>Scroll up</strong>
				<svg xmlns='http://www.w3.org/2000/svg' width='32' height='32' fill='currentColor' viewBox='0 0 16 16'>
					<path d='M7.646 2.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 3.707 2.354 9.354a.5.5 0 1 1-.708-.708z'/>
					<path d='M7.646 6.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 7.707l-5.646 5.647a.5.5 0 0 1-.708-.708z'/>
				</svg>
			</a>
		</aside>
	</main>

	<?php require_once './+footer.inc'; ?>
</body>

</html>
