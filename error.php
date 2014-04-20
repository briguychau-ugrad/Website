<?php
$code = $_GET["code"];
switch ($code) {
	case 400:
		$header = "400 bad request.";
		$message = "The request could not be understood by the server due to malformed syntax.";
		$english = "Just refresh the page.";
		break;
	case 401:
		$header = "401 unauthorized";
		$message = "This server could not verify that you are authorized to access the document requested. Either you supplied the wrong credentials (e.g., bad password), or your browser doesn't understand how to supply the credentials required.";
		$english = "Are you sure the password was entered correctly?";
		break;
	case 403:
		$header = "403 forbidden.";
		$message = "You do not have permission to access this page.";
		$english = "Go somewhere else. You aren't allowed here.";
		break;
	case 404:
		$header = "404 not found.";
		$message = "The page you have requested is not found.";
		$english = "Oops. I can't find the page.";
		break;
	case 500:
		$header = "500 internal server error.";
		$message = "The server encountered an unexpected condition which prevented it from fulfilling the request.";
		$english = "My bad. I'll fix myself up. Just keep refreshing the page in the meantime.";
		break;
	default:
		$header = "Unknown error.";
		$message = "The webpage encountered an unknown error.";
		$english = "There's something wrong and we're not being very specific about it. Sorry.";
}
?>
<!DOCTYPE html>
<html lang="en-ca">
<head>
	<meta charset="utf-8" />
	<meta name="description" content="Brian Chau: Student, Software Developer" />
	<meta name="keywords" content="Brian, Chau, Software, Developer, Engineer, Canada, Vancouver" />
	<meta name="author" content="Brian Chau" />
	<meta name="robots" content="nofollow" />
	<title>Brian Chau: Student, Software Developer</title>
	
	<!-- CSS -->
	<!-- Error -->
	<link href="/css/error.css" rel="stylesheet" />
	
	<!-- Favicons and Apple Touch icons -->
	<link rel="apple-touch-icon-precomposed" sizes="144x144" href="/favicons/apple-touch-icon-144-precomposed.png">
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="/favicons/apple-touch-icon-114-precomposed.png">
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="/favicons/apple-touch-icon-72-precomposed.png">
	<link rel="apple-touch-icon-precomposed" href="/favicons/apple-touch-icon-57-precomposed.png">
	<link rel="shortcut icon" href="/favicons/favicon.png">
	
</head>
<body>

<table id="errortbl">
	<tr>
		<td id="errortd">
			<div id="errordiv">
				<h1><?php echo $header; ?></h1>
				<p><?php echo $message; ?></p>
				<p class="english">(Translation: <?php echo $english; ?>)</p>
				<p>Go to the <a href="/">home page</a>.</p>
			</div>
		</td>
	</tr>
</table>

</body>
</html>

<!-- Suffix Information -->
<!-- Last update timestamp: 2013-07-11T23:50-07 -->
<!-- Version: 7.0.0 -->
<!-- Licence for DejaVu Fonts at http://dejavu-fonts.org/wiki/License -->
