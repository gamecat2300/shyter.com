<?php

function sanitize_output($buffer) {

    $search = array(
        '/\>[^\S ]+/s',  // strip whitespaces after tags, except space
        '/[^\S ]+\</s',  // strip whitespaces before tags, except space
        '/(\s)+/s'       // shorten multiple whitespace sequences
    );

    $replace = array(
        '>',
        '<',
        '\\1'
    );

    $buffer = preg_replace($search, $replace, $buffer);

    return $buffer;
}

ob_start("sanitize_output");

?>
<?php
require_once '_php/db.php';
require_once '_php/functions.php';
$list = getBathrooms();
$hiringList = getHiringBathrooms();
?>
<!doctype html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>Shyter San Francisco Bathroom Map</title>
	<meta name="description" content="The Mapped in SF Map is a visual testament to the vibrant state of San Francisco's digital industry. Find jobs in San Francisco.">
	<meta name="author" content="Steven Hubbard - http://nationalflashback.com">
	<meta name="keywords" content="startups, San Francisco, jobs in San Francisco, tech jobs, technology jobs, startup map, search jobs, sf tech, digital">
	<link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon" />
	<meta property="og:title" content="Mapped in San Francisco Digital Map" />
	<meta property="og:url" content="http://www.mappedinsf.com/" />
	<meta property="og:image" content="http://www.mappedinsf.com/img/fb.png" />
	<meta property="og:site_name" content="Mapped in San Francisco Digital Map" />
	<meta property="og:description" content="The Mapped in SF Map is a visual testament to the vibrant state of San Francisco's digital industry. Find jobs in San Francisco." />
	<meta property="og:type" content="website" />
	<script type="text/javascript" src="//use.typekit.net/skb3otn.js"></script>
<script type="text/javascript">try{Typekit.load();}catch(e){}</script>
	<link rel="stylesheet" href="css/styles-min.css">
</head>
<body>
<div id="header-hiring">
	<?php $number = count($bathroomList);echo $number ?> SF Bathrooms are free
</div>
<div id="header">
	<div id="header-content">
		<div id="logo">
			<img src="img/made.png" alt="logo" /><!--h1>Mapped in SF <span class="other">Digital Map</span></h1 -->
		</div>
	</div>
</div>
<div id="terms-privacy">
<h1>Mapped in SF Privacy Policy</h1>
<p>IWNY and the City are committed to protecting the privacy of Users and the data they share via the Site. This privacy policy explains what we do with the information that is entered by Users on the Site.</p>
<p><strong>Use of your personal data</strong><br />
IWNY and the City may save data that Users post to the Site. This includes User- generated content including data.</p>
<p>IWNY and the City seek to provide protection for your information. We may disclose personally identifiable information about you to third parties in limited circumstances, including: (1) with your explicit consent; or (2) when we have a good-faith belief the law requires it.</p>
<p>Apart from the circumstances described above, we will not sell your data to third parties (this includes for all commercial purposes).</p>
<p><strong>Removing your information</strong><br />
If you would like us to delete your data entirely, please send an e-mail to <a href="mailto:contact@shyter.com">contact@shyter.com</a></p>
</div>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="js/libs/jquery-1.7.1.min.js"><\/script>')</script>

<script src="js/plugins-min.js"></script>
<script src="js/scripts-min.js"></script>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-68090436-1', 'auto');
  ga('send', 'pageview');

</script>


</body>
</html>
