<!DOCTYPE html>
<html lang='en'>

<head>
	<meta charset='UTF-8'>
	<meta name='viewport' content='width=device-width, initial-scale=1.0'>
	<meta name='description' content=''>

	<title>Notes on Enhancements | AvtoZeichen</title>

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
		<h1>Note on Website Enhancements</h1>
	</header>

	<article>
		<h2>1. Switch between Light and Dark mode based on browser settings.</h2>
		<p>Subtlely, the website will detect your browser's theme setting, thanks to the <code>prefers-color-scheme</code> media query</p>
		<div id='mode-demonstration'>
			<p>The website is currently using <strong class='theme-light'>Light</strong><strong class='theme-dark'>Dark</strong> mode.</p>
			<div id='opposite-mode'>
				<img src='./images/icon-solar.svg' alt='Sun icon' class='theme-light'>
				<img src='./images/icon-lunar.svg' alt='Moon icon' class='theme-dark'>
				<p>How the website will look like in <strong class='theme-dark'>Light</strong><strong class='theme-light'>Dark</strong> mode.</p>
			</div>
		</div>

		<h2>2. Contain job descriptions in collapsibles using the &lt;details&gt; element</h2>
		<a href='./jobs.html' class='goto text-yellow'>See how they function in the Job descriptions page</a>
		<p>The &lt;details&gt; element is traditionally used to hide extensive contents behind a simple sentence, a.k.a. a summary</p>
		<p>
			In this website, we decided to style and use this element as collapsibles for displaying the job descriptions in a neat and tidy way.
			This way, potential applicants will only need to view the descriptions they are interested in, so they can press on one and expands it out
		</p>
		<details>
			<summary>A sample &lt;details&gt; element</summary>
			<section>
				<h3>Lorem Ipsum</h3>
				<p>
					Dolor sit amet consectetur adipisicing elit. Pariatur vel quod fugit repellat quos tempora deleniti eaque quae,
					praesentium id delectus sint adipisci, eum nemo officia accusamus. Perferendis, architecto reprehenderit.
				</p>
			</section>
		</details>
	</article>

	<?php require_once './+footer.inc'; ?>
</body>

</html>
