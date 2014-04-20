<?php 
error_reporting(E_ALL ^ E_NOTICE); // hide all basic notices from PHP

$hasError = false;
$captchaErrorBool = false;

//If the form is submitted
if(isset($_POST['submitted'])) {
	
	// require a name from user
	if(trim($_POST['form-name']) === '') {
		$nameError =  'This is a required field.'; 
		$hasError = true;
	} else {
		$name = trim($_POST['form-name']);
	}
	
	// need valid email
	if(trim($_POST['form-email']) === '')  {
		$emailError = 'This is a required field.';
		$hasError = true;
	} else if (!preg_match("/^[[:alnum:]][a-z0-9_.-]*@[a-z0-9.-]+\.[a-z]{2,4}$/i", trim($_POST['form-email']))) {
		$emailError = 'The email address is invalid.';
		$hasError = true;
	} else {
		$email = trim($_POST['form-email']);
	}
	
	// we need at least some content
	if(trim($_POST['form-message']) === '') {
		$commentError = 'This is a required field.';
		$hasError = true;
	} else {
		if(function_exists('stripslashes')) {
			$comments = stripslashes(trim($_POST['form-message']));
		} else {
			$comments = trim($_POST['form-message']);
		}
	}
	
	// check recaptcha
	/*require_once('recaptchalib.php');
	$privatekey = "6LfNgeISAAAAAJA7uGiFxLGnJLXHGfKcbLViyln_";
	$resp = recaptcha_check_answer ($privatekey,
					$_SERVER["REMOTE_ADDR"],
					$_POST["recaptcha_challenge_field"],
					$_POST["recaptcha_response_field"]);
	if (!$resp->is_valid) {
		$captchaError = "The reCAPTCHA wasn't entered correctly. Please try it again.";
		$captchaErrorBool = true;
		$hasError = true;
	}*/
	
	// upon no failure errors let's email now!
	if(!$hasError) {
		$emailTo = 'me@brianchau.ca';
		$subject = 'Submitted message from '.$name;
		$sendCopy = trim($_POST['sendCopy']);
		$body = "{$comments}" . "\r\n \r\n" . "IP Address = {$_SERVER['REMOTE_ADDR']}; From: {$name}, {$email}";
		$headers = "From: Contact Form <no-reply@brianchau.ca>" . "\r\n" . "Reply-To: {$name} <{$email}>";
		
		mail($emailTo, $subject, $body, $headers);
		
		// set our boolean completion value to TRUE
		$emailSent = true;
	}
}
?>
<!DOCTYPE html>
<html lang="en-ca">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<meta name="description" content="Brian Chau: Student, Software Developer" />
	<meta name="keywords" content="Brian, Chau, Software, Developer, Engineer, Canada, Vancouver" />
	<meta name="author" content="Brian Chau" />
	<meta name="robots" content="nofollow" />
	<title>Brian Chau: Student, Software Developer</title>
	
	<!-- CSS -->
	<!-- Bootstrap -->
	<link href="./css/bootstrap.css" rel="stylesheet" />
	<link href="./css/bootstrap-theme.css" rel="stylesheet" />
	<!-- Custom -->
	<link href="./css/custom.css" rel="stylesheet" />
	
	<!-- Favicons and Apple Touch icons -->
	<link rel="apple-touch-icon-precomposed" sizes="144x144" href="./favicons/apple-touch-icon-144-precomposed.png">
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="./favicons/apple-touch-icon-114-precomposed.png">
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="./favicons/apple-touch-icon-72-precomposed.png">
	<link rel="apple-touch-icon-precomposed" href="./favicons/apple-touch-icon-57-precomposed.png">
	<link rel="shortcut icon" href="./favicons/favicon.png">
	
</head>
<body>
<div class="navbar navbar-inverse navbar-fixed-top">
	<div class="navbar-inner">
			<div class="nav-collapse collapse" id="topnav">
				<ul class="nav code">
					<li><a href="#top">Top</a></li>
					<li><a href="#technical">Technical</a></li>
					<li><a href="#projects">Projects</a></li>
					<li><a href="#education">Education</a></li>
					<li><a href="#profile">Profile</a></li>
				</ul>
			</div><!-- /.nav-collapse .collapse -->
	</div><!-- /.navbar-inner -->
</div><!-- /.navbar. navbar-inverse .navbar-fixed-top -->

<div class="content-main" id="top" style="width: 100%;">
	<div class="jumbotron">
		<h1>Brian Chau</h1>
		<p class="lead code"><?php
			$phrase = "Student, Software Developer";
			$val = mt_rand(1, 8);
			switch ($val) {
				case 1: // C++
					echo "std::cout &lt;&lt; \"" , $phrase , "\" &lt;&lt; std::endl;";
					break;
				case 2: // C
					echo "printf(\"" , $phrase , "\\n\");";
					break;
				case 3: // Java
					echo "System.out.println(\"" , $phrase , "\");";
					break;
				case 4: // Python (older)
					echo "print \"" , $phrase , "\"";
					break;
				case 5: // Python (newer)
					echo "print(\"" , $phrase , "\")";
					break;
				case 6: // Haskell
					echo "putStrLn \"" , $phrase , "\"";
					break;
				case 7: // Prolog
					echo "write_ln('" , $phrase , "').";
					break;
				case 8: // PHP
				default:
					echo "echo \"" , $phrase , "\";";
					break;
			}
		?></p>
	</div><!-- /.jumbotron -->
	<div class="section-separator"></div>
	<div class="section-dark" id="technical">
		<div class="container">
			<h1>Technical</h1>
			<div class="row">
				<div class="col-md-6">
					<h2>Experience</h2>
					<div class="row">
						<div class="col-md-3">
							<img src="./img/ubc-white-small.png" alt="UBC">
						</div>
						<div class="col-md-8" style="text-align: left;">
							<h4>UBC Computer Science Department</h4>
							<h5>Undergraduate Teaching Assistant</h5>
							<h6>January 2013 to December 2013</h6>
							<ul>
								<li>CPSC 210 (Gail Murphy, Ivan Beschastnikh), Sep-Dec 2013</li>
								<li>CPSC 210 (Kurt Eiselt), Jul-Aug 2013</li>
								<li>CPSC 101 (Holger Hoos), Jan-Apr 2013</li>
							</ul>
						</div>
					</div>
					<h2>Future Internships</h2>
					<div class="row">
						<div class="col-md-3">
							<img src="./img/ata-white-small.png" alt="A Thinking Ape">
						</div>
						<div class="col-md-8" style="text-align: left;">
							<h4>A Thinking Ape</h4>
							<h5>Software Development Engineer Co-op</h5>
							<h6>January 2014 to April 2014</h6>
							<ul>
								<li>In 2014 I will be starting a co-op term with A Thinking Ape, a Vancouver-based mobile games company.</li>
							</ul>
						</div>
					</div>
					<br /><br /><!-- NOTE NEED THIS DOUBLE BR TAG BETWEEN ELEMENTS -->
					<div class="row">
						<div class="col-md-3">
							<img src="./img/microsoft-white-small.png" alt="Microsoft">
						</div>
						<div class="col-md-8" style="text-align: left;">
							<h4>Microsoft Corporation</h4>
							<h5>Software Development Engineer Intern</h5>
							<h6>May 2014 to August 2014</h6>
							<ul>
								<li>I will be doing a summer internship at Microsoft in 2014, on the Operating Systems Core team.</li>
							</ul>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<h2>Languages</h2>
					<div class="code" style="font-size: 14pt;">
						<div class="row">
							<div class="col-xs-4">C++</div>
							<div class="col-xs-8"><div class="progress"><div class="progress-bar" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%;"></div></div></div>
						</div>
						<div class="row">
							<div class="col-xs-4">Java</div>
							<div class="col-xs-8"><div class="progress"><div class="progress-bar" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%;"></div></div></div>
						</div>
						<div class="row">
							<div class="col-xs-4">C</div>
							<div class="col-xs-8"><div class="progress"><div class="progress-bar" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%;"></div></div></div>
						</div>
						<div class="row">
							<div class="col-xs-4">Python</div>
							<div class="col-xs-8"><div class="progress"><div class="progress-bar" role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100" style="width: 10%;"></div></div></div>
						</div>
						<div class="row">
							<div class="col-xs-4">Haskell</div>
							<div class="col-xs-8"><div class="progress"><div class="progress-bar" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%;"></div></div></div>
						</div>
						<div class="row">
							<div class="col-xs-4">Prolog</div>
							<div class="col-xs-8"><div class="progress"><div class="progress-bar" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%;"></div></div></div>
						</div>
						<div class="row">
							<div class="col-xs-4">HTML</div>
							<div class="col-xs-8"><div class="progress"><div class="progress-bar" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 50%;"></div></div></div>
						</div>
						<div class="row">
							<div class="col-xs-4">JavaScript</div>
							<div class="col-xs-8"><div class="progress"><div class="progress-bar" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%;"></div></div></div>
						</div>
						<div class="row">
							<div class="col-xs-4">PHP</div>
							<div class="col-xs-8"><div class="progress"><div class="progress-bar" role="progressbar" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100" style="width: 30%;"></div></div></div>
						</div>
						<div class="row">
							<div class="col-xs-4">SQL</div>
							<div class="col-xs-8"><div class="progress"><div class="progress-bar" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%;"></div></div></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="section-separator"></div>
	<div class="section-light" id="projects">
		<div class="container">
			<h1>Projects</h1>
			<div class="row">
				<div class="col-md-6">
					<h2>Personal</h2>
					<h4>S3/DXT Texture Converter</h4>
					<p>Language: <em>C++</em></p>
					<p>Converts bitmap files to/from the S3/DXT3 texture format for use with Microsoft Flight Simulator, employing self-written algorithms, file I/O, and OpenMP multithreading.</p>
					<p><a href="https://github.com/briguychau/FSbmp32" target="_blank">GitHub</a></p>
					<h4>Assembly Language Simulator </h4>
					<p>Language: <em>C++</em></p>
					<p>A parser and a simulator for the “Y86” Assembly language described in “Computer Systems: A Programmer’s Perspective” by Bryant and O’Hallaron.</p>
					<p><a href="./projects/y86sim.zip" target="_blank">Source (zip): Version 1.0.0001</a></p>
				</div>
				<div class="col-md-6">
					<h2>Academic</h2>
					<h4>Clue Assistant (CPSC 312)</h4>
					<p>Languages: <em>Prolog</em></p>
					<p>This program serves as an assistant to a Clue (or Cluedo) player. It is able to remember moves, keep track of what your opponents have, and advise you of what suggestions and accusations to make.</p>
					<p><a href="https://github.com/briguychau/CPSC-312-Project-2" target="_blank">GitHub</a></p>
					<h4>FoodHero (CPSC 310)</h4>
					<p>Languages: <em>HTML, PHP, JavaScript, CSS, SQL</em></p>
					<p>FoodHero is a restaurant-based social media website. Users are allowed to “fave” and review restaurants, upload photos of food, follow other users and see their reviews, and search for restaurants within Vancouver and UBC. Restaurant data from FourSquare, photo uploading provided by Flickr, mapping provided by Google Maps.</p>
					<p><a href="http://foodhero.brianchau.ca" target="_blank">Live site</a></p>
					<h4>UBC Sustainability App (CPSC 210)</h4>
					<p>Language: <em>Java</em></p>
					<p>Extended a partially completed Android application to support route searching, XML parsing, and GPS mapping. Used JUnit testing to verify code.</p>
				</div>
			</div>
		</div>
	</div>
	<div class="section-separator"></div>
	<div class="section-dark" id="education">
		<div class="container">
			<h1>Education</h1>
			<h2>Undergraduate</h2>
			<div class="row">
				<div class="col-md-4 col-md-offset-1" style="padding-top: 100px;">
					<img src="./img/ubc-white.png" alt="UBC">
				</div>
				<div class="col-md-6" style="text-align: left;">
					<h3>University of British Columbia</h3>
					<h4>Faculty of Science</h4>
					Honours Computer Science and Software Engineering<br />
					Computer Science Co-op Program<br />
					September 2011 to May 2016 <em>(expected)</em><br /><br />
					Select completed coursework:
					<ul>
						<li>CPSC 310: Introduction to Software Engineering</li>
						<li>CPSC 311: Definition of Programming Languages</li>
						<li>CPSC 312: Functional and Logic Programming</li>
						<li>CPSC 313: Computer Hardware and Operating Systems</li>
						<li>CPSC 320: Intermediate Algorithm Design and Analysis</li>
						<li>CPSC 421: Introduction to Theory of Computing</li>
						<li>MATH 223: Honours Linear Algebra</li>
						<li>STAT 302: Introduction to Probability</li>
					</ul>
				</div>
			</div>
			<br /><br />
			<h2>High School</h2>
			<div class="row">
				<div class="col-md-4 col-md-offset-1" style="padding-top: 20px;">
					<img src="./img/pw-white.png" alt="PW">
				</div>
				<div class="col-md-6" style="text-align: left;">
					<h3>Prince of Wales Mini School</h3>
					Vancouver, British Columbia, Canada<br /><br />
					September 2006 to June 2011<br /><br />
					Graduated with Honours
				</div>
			</div>
		</div>
	</div>
	<div class="section-separator"></div>
	<div class="section-light" id="profile">
		<div class="container">
			<h1>Profile</h1>
			<div class="row">
				<div class="col-md-5">
					<h2>About Me</h2>
					<div style="text-align: left;">
						<!-- Image of me here -->
						<p>I'm Brian, and I'm a twenty-one-year-old student and software developer in Vancouver, BC, Canada. I'm currently studying computer science at the University of British Columbia, where I'm in my third year in a five year program. Within computer science, my focus is mainly on software engineering, but I'm also interested in systems and programming languages.</p>
						<p>Here are some other facts about me:</p>
						<ul>
							<li>Here are the past programming competitions I have participated in:
								<ul>
									<li>Google Code Jam 2013: Online Round 2, 1617th (id: briguychau)</li>
									<li>ACM Pacific Northwest Region Programming Contest: 19th (Team: UBC Compile Error)</li>
								</ul>
							</li>
							<li>I can speak English, Chinese (Cantonese and Mandarin), some French, and a little bit of German (in addition to C++, Java, etc.).</li>
							<li>I use Windows 7, Linux Mint 15, and Android 4.4.</li>
							<li>I am part of the online "Microsoft Flight Simulator" community. I make repaints for freeware aircraft, which can be found by searching for my name on <a href="http://www.avsim.com/">AVSIM</a> or <a href="http://www.flightsim.com/">FlightSim</a>. Alternatively, <a href="http://fs.brianchau.ca/">here is a link</a> to my Flight Simulator downloads page.</li>
						</ul>
					</div>
				</div>
				<div class="col-md-6 col-md-offset-1">
					<h2>Directory</h2>
					<div class="row">
						<div class="col-md-9 col-md-offset-3" style="text-align: left;">
							<div class="row contact-info-row">
								<div class="col-md-3 contact-info-icon"><img src="./glyphicons/glyphicons_010_envelope_edit.png" alt="Email" /></div>
								<div class="col-md-9 contact-info-text"><img src="./img/email.png" alt="me AT brianchau DOT ca" /></div>
							</div>
							<div class="row contact-info-row">
								<div class="col-md-3 contact-info-icon"><img src="./glyphicons/glyphicons_169_phone_edit.png" alt="Phone" /></div>
								<div class="col-md-9 contact-info-text"><img src="./img/phone_can.png" alt="canadian phone number" /><br />(Canada)</div>
							</div>
							<div class="row contact-info-row">
								<div class="col-md-3 contact-info-icon"><img src="./glyphicons/glyphicons_169_phone_edit.png" alt="Phone" /></div>
								<div class="col-md-9 contact-info-text"><img src="./img/phone_usa.png" alt="american phone number" /><br />(USA)</div>
							</div>
							<div class="row contact-info-row">
								<div class="col-md-3 contact-info-icon"><img src="./glyphicons/glyphicons_social_21_github.png" alt="GitHub" /></div>
								<div class="col-md-9 contact-info-text"><a href="https://github.com/briguychau" target="_blank">GitHub</a></div>
							</div>
							<div class="row contact-info-row">
								<div class="col-md-3 contact-info-icon"><img src="./glyphicons/glyphicons_social_17_linked_in.png" alt="LinkedIn" /></div>
								<div class="col-md-9 contact-info-text"><a href="http://ca.linkedin.com/pub/brian-chau/65/438/2b2/" target="_blank">LinkedIn</a></div>
							</div>
							<div class="row contact-info-row">
								<div class="col-md-3 contact-info-icon"><img src="./glyphicons/glyphicons_social_30_facebook.png" alt="Facebook" /></div>
								<div class="col-md-9 contact-info-text"><a href="http://www.facebook.com/briguychau" target="_blank">Facebook</a></div>
							</div>
							<div class="row contact-info-row">
								<div class="col-md-3 contact-info-icon"><img src="./glyphicons/glyphicons_036_file.png" alt="R&#233;sum&#233;" /></div>
								<div class="col-md-9 contact-info-text"><a href="./resume_brian_chau.pdf" target="_blank">R&#233;sum&#233; (October 2013)</a></div>
							</div>
						</div>
					</div>
					<br /><br />
					<h2>Contact</h2>
					<form method="POST" action="index.php" class="form-horizontal" id="form-contact">
						<div id="contact-wrapper" style="text-align: left;">
				<?php if($hasError) { ?>
							<div class="control-group">
								<div class="controls contact-form-box">
									<p class="alert">There was an error processing your form.</p>
								</div>
							</div>
				<?php } ?>
							<div class="control-group">
								<label class="control-label contact-form-label" for="form-name">Name</label>
								<div class="controls contact-form-box">
									<input type="text" name="form-name" class="requiredField" id="form-name" value="<?php if(isset($_POST['form-name'])) echo $_POST['form-name'];?>" placeholder="Your name" /><br />
									<?php if($nameError != '') { ?>
										<span class="error"><?php echo $nameError;?></span> 
									<?php } ?>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label contact-form-label" for="form-email">Email Address</label>
								<div class="controls contact-form-box">
									<input type="text" name="form-email" class="requiredField email" id="form-email" value="<?php if(isset($_POST['form-email'])) echo $_POST['form-email'];?>" placeholder="Your email address" /><br />
									<?php if($emailError != '') { ?>
										<span class="error"><?php echo $emailError;?></span> 
									<?php } ?>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label contact-form-label" for="form-message">Message</label>
								<div class="controls contact-form-box">
									<textarea name="form-message" class="requiredField" id="form-message" rows="8" style="width:95%;" placeholder="Your message"><?php if(isset($_POST['form-message'])) echo $_POST['form-message'];?></textarea><br />
									<?php if($commentError != '') { ?>
										<span class="error"><?php echo $commentError;?></span> 
									<?php } ?>
								</div>
							</div>
							<div class="control-group">
								<div class="controls contact-form-box">
									<input type="hidden" name="submitted" id="submitted" value="true" />
									<button type="submit" name="submit" id="submit" class="btn btn-inverse">Send</button>
								</div>
							</div>
						</div> <!-- /#contact-wrapper -->
					</form>
				</div>
			</div>
		</div>
	</div>
</div><!-- /.content-main -->
<div style="height: 1px; background-color: #dddddd;"></div>
<div id="footer">
	<div class="container" style="text-align: center; width: 100%;">
		<span class="footer-section">Copyright &copy; 2013 Brian Chau</span>
		<span class="footer-section"><a href="http://validator.w3.org/check?uri=referer&amp;No200=1" target="_blank">Valid</a> HTML<img src="./img/html5-black.png" alt="HTML5" /></span>
		<span class="footer-section">
			<a href="http://www.glyphicons.com/" target="_blank">GLYPHICONS</a> are used under the <a href="http://creativecommons.org/licenses/by/3.0/deed.en" target="_blank">Creative Commons Attribution 3.0 Unported</a> license
		</span>
	</div>
</div><!-- /#footer -->

<!-- JavaScript -->
<!-- JQuery -->
<script type="text/javascript" src="./js/jquery.js"></script>
<!-- Scrolling -->
<script type="text/javascript" src="./js/scrolling.js"></script>
<!-- Bootstrap -->
<script type="text/javascript" src="./js/bootstrap.js"></script>
<!-- Email form -->
<script type="text/javascript">
	<!--//--><![CDATA[//><!--
	$(document).ready(function() {
		$('form#form-contact').submit(function() {
			$('form#form-contact .error').remove();
			var hasError = false;
			$('.requiredField').each(function() {
				if($.trim($(this).val()) == '') {
					var labelText = $(this).prev('label').text();
					$(this).parent().append('<span class="error">This is a required field.</span>');
					$(this).addClass('inputError');
					hasError = true;
				} else if($(this).hasClass('email')) {
					var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
					if(!emailReg.test($.trim($(this).val()))) {
						$(this).parent().append('<span class="error">The email address is invalid.</span>');
						$(this).addClass('inputError');
						hasError = true;
					}
				}
			});
			if(!hasError) {
				var formInput = $(this).serialize();
				$.post($(this).attr('action'),formInput, function(data){
					$('form#form-contact').slideUp("fast", function() {
						$(this).before('Your email has been delivered.');
					});
				});
			}
			return false;	
		});
	});
	//-->!]]>
</script>
</body>
</html>

<!-- Suffix Information -->
<!-- Last update timestamp: 2014-04-19T18:37-07 -->
<!-- Version: 7.1.0 -->
<!-- Licence for DejaVu Fonts at http://dejavu-fonts.org/wiki/License -->
