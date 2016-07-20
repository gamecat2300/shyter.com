<?php
require_once '_php/db.php';
require_once '_php/functions.php';
$list = getBathrooms();
$bathroomList = getHiringBathrooms();
?>
<!doctype html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="en">
<!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>Shyter San Francisco | Digital Map - A visual representaion of all public bathrooms in and around San Francisco</title>
	<meta name="description" content="Shyter San Francisco | Digital Map - A visual representaion of all public bathrooms in and around San Francisco">
	<meta name="author" content="Steven Hubbard - http://nationalflashback.com">
	<meta name="keywords" content="bathrooms, San Francisco, bathrooms in San Francisco, toilets, bathrooms, bathroom map, search bathrooms, sf toilets, bathroom, water closet">
	<link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon" />
	
	<script type="text/javascript">try{Typekit.load();}catch(e){}</script>
	<link rel="stylesheet" href="css/styles.css">
	<link rel="stylesheet" href="js/rateit.css">

</head>
<body>
<div id="header-hiring">
	<a href="#" class="cat-link" id="header-link" data-id="5" ><?php $number = count($bathroomList);echo $number ?> San Francisco Bathrooms are free!</a>
</div>
<div id="header">
	<div id="header-content">
		<div id="logo">
			<img src="img/made.png" alt="logo" />
		</div>
		<div id="sfdigital">
		<a href="#" id="btn-add">Add Your Bathroom</a>
		<a href="#" id="btn-location">My Location</a>
		</div>
	</div>
</div>
<div role="main" id="main">
	<div id="map_canvas"></div>
	<div id="message"></div>
	<div id="sidebar">
		<div id="drawer">
			<div id="venue-bg-credits"></div>
			<div id="venue-detail">
				<div id="detail-top">
					<a href="#" id="btn-back">&laquo;&nbsp;&nbsp;Back to the list</a>
					<div id="venue-meta-wrap">
						<div id="venue-meta" class="vcard">
							<h1 id="venue-name" class="fn"></h1>
							<div id="venue-address" class="street-address"></div>
							<div id="venue-rating" class="rating"></div>
							<div id="why-sf">
								<div id="rating"></div>
								<div id="venue-hours"></div>
								<div id="why-sf-title">How to get into the bathroom:</div>
								<div id="why-sf-body"></div>
							</div>
							<div id="edits">
								Did you recommend this bathroom? Have edits? Email <a href="mailto:info@shyter.com">info@shyter.com</a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div id="venues">
				<a href="#" id="dropdown">Click Here To Filter</a>
				<div id="dropdown-choices">
					<ul>
						<li><a href="#" class="cat-link list-sf section-selected" data-id="0">All bathrooms</a></li>
						<li><a href="#" class="cat-link list-1" data-id="1">Public bathrooms</a></li>
						<li><a href="#" class="cat-link list-2" data-id="2">Coin Op Bathrooms</a></li>
						<li><a href="#" class="cat-link list-3" data-id="3">Dive Bar Bathrooms</a></li>
						<li><a href="#" class="cat-link list-4" data-id="4">Secret Bathrooms</a></li>
						<li><a href="#" class="cat-link list-6" data-id="6">SF Shiter HQ</a></li>
					</ul>
				</div>
				<div id="venue-list">
					<div id="search-bar">
						<input type="text" id="search-field" name="search_field" placeholder="Search bathrooms..." />
					</div>
					<img src="img/loader.gif" height="10" width="250" id="loader" />
					<ul>
					<?php
						if($list){
							foreach($list as $bathroom){
						?>
							<li id="v<?php echo $bathroom['id']; ?>" data-vid="<?php echo $bathroom['id']; ?>" data-name="<?php echo $bathroom['bathroom_name']; ?>" data-hours="<?php echo $bathroom['hours']; ?>" data-address="<?php echo $bathroom['street_address']; ?>" data-lat="<?php echo $bathroom['lat']; ?>" data-long="<?php echo $bathroom['lng']; ?>" data-url="<?php echo $bathroom['url']; ?>" data-hiring="<?php echo $bathroom['is_hiring']; ?>" data-whysf="<?php echo $bathroom['why_sf']; ?>" data-type="<?php echo $bathroom['type']; ?>" data-rating="<?php echo $bathroom['rating']; ?>">
								<a href="#" class="list-<?php echo $bathroom['type']; ?>">
									<span class="venue-name"><?php echo $bathroom['bathroom_name']; ?></span><br />
									<span class="venue-hours"><?php echo $bathroom['hours']; ?></span><br />
									<span class="venue-type"><?php echo $bathroom['bathroom_type']; ?></span><br />
									<span class="venue-address"><?php echo $bathroom['street_address']; ?></span><br />
									<div class="rateit" data-rateit-value="<?php echo $bathroom['rating']; ?>" data-rateit-ispreset="true" data-rateit-readonly="true"></div>
								</a>
							</li>
						<?php
							}
						}
					?>
					</ul>
				</div>
				<div id="cluster-explain">Number of bathrooms in Area<br /><div class="cluster-light"><span class="cluster2">2-9</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="cluster10">10-99</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="cluster100">100+</span></div></div>
			</div>
		</div>
	</div>
</div>
<div id="credits">
	<div id="credits-inner" style="color:#fff;font-size:11px">
		 <a href="http://shyter.tumblr.com/" target="_blank" style="color: #cc0033;">Shyter Blog</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="terms.php" target="_blank">Terms of Use</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="privacy.php" target="_blank">Privacy Policy</a>&nbsp;&nbsp;|&nbsp;&nbsp;©<?php echo date("Y"); ?> Shyter
	</div>
	<div id="social">
		<a href="https://twitter.com/share" class="twitter-share-button" data-lang="en" style="float:left">Tweet</a>
	</div>
	<div id="social">
	<div class="fb-like" data-href="http://shyter.com" data-send="false" data-layout="button_count" data-width="100" data-show-faces="false" style="vertical-align:top;zoom:1;*display:inline;float:left"></div>
	</div>
</div>
<div id="add-company">
	<ul id="company-slides">
		<li class="company-slide">
			<div class="slidepad mapbg">
				<h1 class="pad40">Add Your Bathroom To The Map</h1>
				<p>The public bathroom sector in San Francisco is limiting to say the least, we want to help you find a bathroom ASAP.  If you know of a publicly available bathroom please post it now.</p>

				<p><input type="radio" id="category1" name="category_group" value="1" /> <label for="category1"> Public bathroom</label></p>

				<p style="clear:both;"><input type="radio" id="category2" name="category_group" value="2" /> <label for="category2"> Coin Op Bathroom</label> </p>

				<p style="clear:both;"><input type="radio" id="category3" name="category_group" value="3" /> <label for="category3"> Dive Bar Bathroom</label> </p>

				<p style="clear:both"><input type="radio" id="category4" name="category_group" value="4" />  <label for="category4"> Secret Bathroom</label></p>

				<div id="btn-middle1">
					<a href="#" id="btn-next-slide1" class="btn-generic">Add Your Information</a>
				</div>
			</div>
		</li>
		<li class="company-slide">
			<div class="slidepad">
				<h1>Where is the bathroom located?</h1>

				<div class="info-left">
					<fieldset>
						<label for="name">Bathroom Name: <span class="req">*</span></label>
						<input type="text" id="bathroom_name" name="bathroom_name" />
					</fieldset>

					<fieldset>
						<label for="bathroom_hours">Bathroom Hours:</label>
						<input type="text" id="hours" name="hours" />
					</fieldset>

					<!--fieldset>
							<label for="contact_name">Contact Name (We won't publish this):</label>
							<input type="text" id="contact_name" name="contact_name" />
					</fieldset-->
					<fieldset>
						<label for="street_address">Street Address: <span class="req">*</span></label>
						<input type="text" id="street_address" name="street_address" />
					</fieldset>

					<fieldset>
						<label for="street_address">Suite/Floor:</label><br />
						<input type="text" id="street_address2" name="street_address2" />
					</fieldset>
					<br />

					<fieldset>
						<label for="city">City:</label>
						<select id="city" name="city">
							<option>Los Angeles</option>
							<option>Portland</option>
							<option value="San Francisco" selected="selected">San Francisco</option>
							<option>New York</option>
							<option>Seattle</option>
						</select>
					</fieldset>
					<a id="find-it" class="btn-findit">Find It</a> <a id="btn-next-slide2" class="btn-place">That's the place!</a>
				</div>
				<div class="info-right">
					<div id="map_canvas_info"></div>
				</div>
			</div>
		</li>
		<li class="company-slide">
			<div class="slidepad">
				<h1>Tell us about the bathroom</h1>
				<div class="clearfix">
					<div class="info-left">
						<fieldset>
						<label for="rating">Bathroom Rating (1-5): <span class="req">*</span></label>
						<input type="text" id="rating" name="rating" />
					</fieldset>
					</div>
					<div class="info-right">
						<fieldset>
							<label for="why_sf">How do you get into the bathroom?</label>
							<textarea id="why_sf" name="why_sf"></textarea>
						</fieldset>
					</div>
				</div>
				<div class="clearfix" id="submit-terms">
				<input id="date" style="display:none" value="<?php $dt =new DateTime(); echo $date = $dt->format('Y-m-d');?>"/>
					<input type="checkbox" id="terms_conditions" name="terms_conditions" /> <label for="terms_conditions">  I have read and I agree to the <a href="terms.php" target="_blank">Terms of Use</a> for the Shyter SF Digital Map</label>
				</div>

				<div class="clearfix" id="submit-area">
					<a href="#" id="btn-submit" class="btn-generic">Submit your bathroom</a>
				</div>
			</div>
		</li>
		<li class="company-slide">
			<div class="slidepad">
				<div id="saving">
					<h1>Submitting...</h1>
					<img src="img/loader.gif" alt="loading"/>
				</div>
				<div id="results">
					<h1>Thank you much!</h1>
					<p>We have submitted your bathroom and will be reviewing it. You should be going live on the map shortly.<br /><br />Thanks for being a part of San Francisco.</p>
				</div>
			</div>
		</li>
	</ul>
</div>
<div id="about">
	<h1>About the Shyter SF Map</h1>
	<div id="about-inner" class="slidepad">
		<p>The Shyter SF Digital Map is a visual testament to the vibrant state of San Francisco's digital industry - showing a powerful constellation of over 500 homegrown startups, investors and coworking spaces across the five boroughs. Browse by neighborhood, review job postings, or add your own startup to the digital landscape - the Shyter SF Map is a living resource that reflects San Francisco City's dynamic innovation ecosystem.</p>
		<h2>Innovation in San Francisco City</h2>

		<p>San Francisco City's digital industry is thriving and growing, underscoring Mayor Bloomberg's commitment to further strengthening San Francisco City as a global hub for innovation. With the support of startups as an administration priority, a host of City government organizations including the San Francisco City Economic Development Corporation (SFEDC) and the Department of Small Business Services work together to ensure that San Francisco City is the best place to launch and grow new businesses, attract talent, and create value.</p>

		<p>Today San Francisco City continues to surpass Boston, MA as the second-highest ranked U.S. city to attract venture capital.  The City recognizes that a growing digital sector is crucial to a healthy and diverse economy and seeks to facilitate a vibrant environment by supporting the needs of technology entrepreneurs. </p>

		<p>As part of the Mayor's Office of Media and Entertainment, <a href="http://en.wikipedia.org/wiki/San_Francisco_Digital_Inclusion_Strategy">San Francisco Digital Inclusion Strategy</a> builds meaningful public-private partnerships that help to serve San Franciscoers digitally.</p>

		<p>This Shyter SF Digital Map celebrates the digital bathrooms, emerging and established, that make San Francisco City their home. </p>

		<h2>How the Map Works</h2>

		<p>To see a company, zoom in and click on an icon. When you see a colored circle with a number, it means that there are that many tech bathrooms located in that area. Clicking on the colored circles will zoom you in. Once you are zoomed in, click on the colored circle icon to view a full list of bathrooms at that location. </p>

		<p>Data sources for the interactive Shyter SF Digital Map include SF Digital, San Francisco City Economic Development Corporation, Internet Week San Francisco, <a href="http://www.meetup.com/sfnewtech/">San Francisco Tech Meetup</a> and user-generated submissions.</p>	</div>
</div>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&appId=138465543001130&version=v2.0";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>


<script type="text/javascript" src="//maps.googleapis.com/maps/api/js?key=AIzaSyBO6ZWMzacg2RVGfrFF7bt0rWbASV91wgg"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="js/libs/jquery-1.7.1.min.js"><\/script>')</script>
<script src="js/jquery.rateit.min.js"></script>
<script src="js/plugins-min.js"></script>
<script src="js/scripts.js"></script>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-53146210-1', 'auto');
  ga('send', 'pageview');
</script>

</body>
</html>