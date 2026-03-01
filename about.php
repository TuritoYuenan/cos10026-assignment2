<!DOCTYPE html>
<html lang='en'>

<head>
	<meta charset='UTF-8'>
	<meta name='viewport' content='width=device-width, initial-scale=1.0'>
	<meta name='description' content='Introduction of the design team behind AvtoZeichen's website'>

	<title>Meet the design team | AvtoZeichen</title>

	<link rel='shortcut icon' href='./images/favicon.svg' type='image/x-icon'>
	<link rel='stylesheet' href='./styles/style.css'>

	<link rel='preconnect' href='https://fonts.googleapis.com'>
	<link rel='preconnect' href='https://fonts.gstatic.com' crossorigin>
	<link href='https://fonts.googleapis.com/css2?family=Lexend:wght@400;700&family=Ubuntu:wght@700&display=swap'
		rel='stylesheet'>
</head>

<body>
	<?php require_once './+header.inc'; ?>
	<?php require_once './+bmenu.inc'; ?>

	<header>
		<h1>Meet the design team</h1>
	</header>

	<main id='aboutpage'>
		<figure>
			<img src='./images/team.webp' alt='Image of two team members T-posing over another member' class='responsive-image' id='team-image'>
			<figcaption>Triet & Bao T-posing in the school garden</figcaption>
		</figure>

		<dl class='dual'>
			<dt>Name</dt>
			<dd>The Internerdt</dd>
			<dt>Team ID</dt>
			<dd>COS10026.2.G1</dd>
			<dt>Teacher</dt>
			<dd>Dr. Eric Le</dd>
			<dt>Unit</dt>
			<dd>Computing Technology Inquiry Project</dd>
		</dl>

		<h2>Our Timetable</h2>

		<div id='timetable'>
			<table>
				<tr class='long-format'>
					<th>Monday</th>
					<th>Tuesday</th>
					<th>Wednesday</th>
					<th>Thursday</th>
					<th>Friday</th>
					<th>Saturday</th>
					<th>Sunday</th>
				</tr>
				<tr class='short-format'>
					<th>Mon</th>
					<th>Tue</th>
					<th>Wed</th>
					<th>Thu</th>
					<th>Fri</th>
					<th>Sat</th>
					<th>Sun</th>
				</tr>
				<tr>
					<td>Dividing work to members</td>
					<td>None</td>
					<td>None</td>
					<td>Team discussions</td>
					<td>Attending lecture and further team discussions</td>
					<td>None</td>
					<td>None</td>
				</tr>
			</table>
		</div>

		<h2>Members</h2>

		<div id='team-members'>
			<article id='top'>
				<hgroup>
					<h3>Nguyen Ta Minh Triet</h3>
					<p>K5 - SWS00667</p>
					<p>Coder & Designer | Leader</p>
				</hgroup>
				<img src='./images/mtriet.webp' alt='Minh Triet's portrait' width='144' height='144'>
			</article>

			<article id='mid' class='text-right'>
				<img src='./images/qtuan.webp' alt='Quoc Tuan's portrait' width='144' height='144'>
				<hgroup>
					<h3>Nguyen Quoc Tuan</h3>
					<p>K5 - SWS00760</p>
					<p>Tester & Designer</p>
				</hgroup>
			</article>

			<article id='btm'>
				<hgroup>
					<h3>Nguyen Quoc Bao</h3>
					<p>K5 - SWS01075</p>
					<p>Reporter & Designer</p>
				</hgroup>
				<img src='./images/qbao.webp' alt='Quoc Bao's portrait' width='144' height='144'>
			</article>
		</div>

		<h2>Contact us</h2>

		<div class='dual'>
			<p>Email address (Leader's)</p>
			<p class='text-right'><a href='mailto:104993913@student.swin.edu.au'>104993913@<wbr>student<wbr>.swin.edu.au</a></p>
			<p>Location</p>
			<p class='text-right'>Swinburne University @ Ho Chi Minh city, Vietnam</p>
		</div>
	</main>

	<?php require_once './+footer.inc'; ?>
</body>

</html>
