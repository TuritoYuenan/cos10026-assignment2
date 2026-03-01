<!DOCTYPE html>
<html lang='en'>

<head>
	<meta charset='UTF-8'>
	<meta name='viewport' content='width=device-width, initial-scale=1.0'>
	<meta name='description' content=''>

	<title>Notes on PHP Enhancements | AvtoZeichen</title>

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
		<h1>Notes on PHP Enhancements</h1>
		<p class='text-center'><a class='goto text-green' href='./enhancements.php'>View Assignment 1 Enhancements</a></p>
	</header>

	<article>
		<h2>1. Dynamic Job Descriptions page</h2>
		<p>A table named <code>jobs</code> is created on the database that stores information of job descriptions.</p>
		<p>This makes it easy for the company to update recruiting positions without editing the website's source code.</p>
		<p><a href='./jobs.php' class='goto text-yellow'>View the Job descriptions page</a></p>

		<h2>2. Database Integrity</h2>
		<p>Practices have been made on the database side to ensure the best data validity, integrity, and consistency</p>
		<ul>
			<li>One-to-many relationship between the <code>jobs</code> and <code>eoi</code> table. This prevents EOIs with invalid job reference numbers from being created.</li>
			<li>Enumerable data type for the <code>status</code>, <code>gender</code>, and <code>state</code> fields. This nullifies inserted invalid values in these fields.</li>
			<li>Two tables are used for storage: <code>eoi</code> consists of applicant's info and applying position, and <code>eoi_skills</code> stores their skills</li>
		</ul>
		<figure>
			<img
				width='1600'
				height='660'
				class='responsive-image'
				src='./images/database_arch.webp'
				alt='Database architecture, consisting of three tables: eoi, eoi_skills, and jobs'
			>
			<figcaption>The website's database architecture, consisting of three tables</figcaption>
		</figure>

		<h2>Minor enhancements</h2>
		<p>These are smaller server-side enhancements that I implemented throughout the website architecture.</p>

		<h3>Organise PHP codes in functions</h3>
		<p>
			Aside from global variables and quick redirects, all processes in a PHP page
			are stored in functions, with the main prodedure in the <code>main_process()</code> function.
		</p>
		<p>This makes it easier to organise, maintain and debug the PHP codes.</p>

		<h3>Modular, more enhanced validation error messages in EOI processing</h3>
		<p>
			Instead of logging a simple message that "this field is wrong, please try again",
			the process page responds with detailed, helpful comments to fix the application form.
		</p>
		<p>
			For example, two separate errors will outputs if the name fields are longer than 20 characters
			and contains non-alpha characters.
		</p>
		<p>This makes it less frustrating for the user writing the form.</p>

		<h3>Use WebP image format for optimised image loading</h3>
		<p>
			All bitmap images (except hero image) are stored in WebP format, which according to Google,
			are more optimised for the web and will load faster.
		</p>
		<p>This is more of an Assignment 1 enhancement, which is why it's marked as a minor enhancement.</p>
	</article>

	<?php require_once './+footer.inc'; ?>
</body>

</html>
