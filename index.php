<!DOCTYPE html>
<html lang='en'>

<head>
	<meta charset='UTF-8'>
	<meta name='viewport' content='width=device-width, initial-scale=1.0'>
	<meta name='description' content='A company that creates IoT products to improve transportation and traffic experience'>

	<title>Homepage | AvtoZeichen</title>

	<link rel='shortcut icon' href='./images/favicon.svg' type='image/x-icon'>
	<link rel='stylesheet' href='./styles/style.css'>

	<link rel='preconnect' href='https://fonts.googleapis.com'>
	<link rel='preconnect' href='https://fonts.gstatic.com' crossorigin>
	<link href='https://fonts.googleapis.com/css2?family=Lexend:wght@400;700&family=Ubuntu:wght@700&display=swap'
		rel='stylesheet'>
	<link rel='preload' as='image' href='https://upload.wikimedia.org/wikipedia/commons/7/73/Nov%C3%A1_Povltavsk%C3%A1%2C_Ho%C5%99%C3%AD_v_tunelu_%2801%29.jpg'>
</head>

<body>
	<?php require_once './+bmenu.inc'; ?>
	<?php require_once './+header.inc'; ?>

	<header id='hero'>
		<h1>For an easier, safer and more convenient road&nbsp;experience</h1>
		<a href='./apply.php' class='cta'>Join our team</a>
	</header>

	<main id='homepage'>
		<hgroup>
			<h2 class='text-red'>About us</h2>
			<p>AvtoZeichen is a tech company looking to revolutionise transportation using IoT solutions.</p>
			<p>We offer state-of-the-art implementations in every aspects of the street, from smart and robust traffic
				signs to useful devices in your very own vehicle!</p>
			<p><a href='./about.html' class='text-red goto'>Learn more about us</a></p>
		</hgroup>

		<div id='graphic'>
			<img src='./images/line-art.svg' alt='Line art graphic' class='responsive-image' width='380' height='200'>
		</div>

		<section>
			<h2 class='text-yellow'>What people said about us</h2>
			<blockquote>
				<p>
					AvtoZeichen and their projects have contributed significantly to
					my homeland's infrastructure, helping us ensure that All roads lead to Rome
				</p>
				<p class='text-right'>Emperor Macronus<br>New Roman Empire</p>
			</blockquote>
			<blockquote>
				<p>Their products help us blind folks drive safer</p>
				<p class='text-right'>Some blind dude</p>
			</blockquote>
			<p>
				<a href='https://youtu.be/p8jdS0bURvs' target='_blank' rel='noreferrer noopener'
				class='text-yellow goto'>Watch our behind-the-scene video</a>
			</p>
		</section>

		<hgroup>
			<h2 class='text-green'>We are recuiting!</h2>
			<p>Our products and solutions are powered by the need for convenience from the people, including you!</p>
			<p>As such, we welcome the ones with a passion in IoT and hope for a better road experience, to join our round table.</p>
			<p><a href='./jobs.html' class='text-green goto'>Explore job offers</a></p>
		</hgroup>
	</main>

	<?php require_once './+footer.inc'; ?>
</body>

</html>
