// this function is supposed to make navbar scrolling smooth
$('#topnav ul li a').bind('click', function(e) {
	e.preventDefault();
	$('html, body').animate({ scrollTop: $(this.hash).offset().top }, 600);
});//end click bind
