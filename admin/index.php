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
require_once '../_php/db.php';
require_once '../_php/functions.php';
$list = getAllbathrooms();
$hiringList = getHiringbathrooms();
?>
<!doctype html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>Made In San Francisco Digital Map Admin Console</title>
	<meta name="description" content="The Made In SF Map is a visual testament to the vibrant state of San Francisco's digital industry. Find jobs in San Francisco.">
	<meta name="author" content="Steven Hubbard - http://nationalflashback.com">
	<meta name="keywords" content="startups, San Francisco, jobs in San Francisco, tech jobs, technology jobs, startup map, search jobs, sf tech, digital">
	<link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon" />
	<meta property="og:title" content="Made In San Francisco Digital Map" />
	<meta property="og:url" content="http://www.mappedinsf.com/" />
	<meta property="og:image" content="http://www.mappedinsf.com/img/fb.png" />
	<meta property="og:site_name" content="Made In San Francisco Digital Map" />
	<meta property="og:description" content="The Made In SF Map is a visual testament to the vibrant state of San Francisco's digital industry. Find jobs in San Francisco." />
	<meta property="og:type" content="website" />
	<script type="text/javascript" src="//use.typekit.net/skb3otn.js"></script>
	<script type="text/javascript">try{Typekit.load();}catch(e){}</script>
	<link rel="stylesheet" type="text/css" href="css/jquery.dataTables.min.css">
	<link rel="stylesheet" href="css/styles.css">
</head>
<body>
<div id="header-hiring">
	<b>Administrator Console</b>
</div>
<div id="header" class="headerAdmin">
	<div id="header-content">
		<div id="logo">
			<img src="../img/made.png" width="216" height="60" />

		</div>
	</div>
</div>
<div role="main" id="main" style="margin:0 5px">
				<table id="table_id" class="display">
					<thead>
					<tr>
						<th>
						bathroom name
						</th>
						<th>
						bathroom Address
						</th>
						<th>
						Web Site
						</th>
						<th>
						Email
						</th>
						<th>
						Contact Name
						</th>
						<th>
						Phone
						</th>
						<th>
						Hiring
						</th>
						<th>
						Published
						</th>
						<th>
						Date Added
						</th>
						<th>
						Delete
						</th>
					</tr>
					</thead>
					<?php
						if($list){
							foreach($list as $bathroom){
					?>
					<tr id="bathroom<?php echo $bathroom['id'];?>">
						<td>
							<?php echo $bathroom['name']; ?>
						</td>
						<td>
							<a href=" http://maps.google.com/maps?daddr={<?php echo $bathroom['street_address']; ?>, san francisco, ca} " target="_blank"><?php echo $bathroom['street_address']; ?></a>
						</td>
						<td>
							<a href="<?php echo $bathroom['url']; ?>" target="_blank"><?php echo $bathroom['url']; ?></a>
						</td>
						<td>
							<a href="mailto:<?php echo $bathroom['contact_email']; ?>"><?php echo $bathroom['contact_email']; ?></a>
						</td>
						<td>
							<?php echo $bathroom['contact_name']; ?>
						</td>
						<td>
							<?php echo $bathroom['phone']; ?>
						</td>
						<td>
							<?php if ($bathroom['is_hiring'] == '1'){
								echo 'Yes';
								} else {
								echo 'No';
								}
							?>
						</td>
						<td>
							<?php if ($bathroom['published'] == '1') { ?>
								<input type="checkbox" class="unpublish" name="bathroom" value="<?php echo $bathroom['id']; ?>" style="width:20px" checked> <span class="publishThis<?php echo $bathroom['id']; ?>">Unpublish</span>
							<?php } else { ?>
								<input type="checkbox" class="publish" name="bathroom" value="<?php echo $bathroom['id']; ?>" style="width:20px"> <span class="publishThis<?php echo $bathroom['id']; ?>" >Publish</span>
								<?php } ?>
						</td>
						<td>
							<?php
								$source = $bathroom['date'];
								$date = new DateTime($source);
								echo $date->format('M-d-y'); // 07-17-12
							?>
						</td>
						<td>
							<button class="delete" value="<?php echo $bathroom['id']; ?>">Delete</button>
						</td>
				</tr>
				<?php
					}
				}
				?>
			</table>
	</div>
</div>
<script type="text/javascript" charset="utf8" src="//code.jquery.com/jquery-1.10.2.min.js"></script>
<script type="text/javascript" charset="utf8" src="js/jquery.dataTables.min.js"></script>
<script src="js/adminscripts.js"></script>
<script>
	$(document).ready( function () {
	    $('#table_id').DataTable();
	} );

  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
  ga('create', 'UA-53146210-1', 'auto');
  ga('send', 'pageview');
</script>
</body>
</html>