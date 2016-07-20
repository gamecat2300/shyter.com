<?php
	require_once 'functions.php';
	
	if(isset($_POST['id'])){
		$id = intval($_POST['id']);

		$search = "";
		if(isset($_POST['s'])){
			$search = $_POST['s'];
		}
		$type = $id;

		if($id == 0){
			$type = -1;
		}else if($id == 5){
			$type = -1;
		}
		$list = getbathrooms($type,$search);

		$result = "";
		foreach($list as $bathroom){
			$result .= "<li id='v".$bathroom['id']."'";
			$result .= " data-name='".$bathroom['bathroom_name']."' ";
			$result .= " data-type='".$bathroom['type']."' ";
			$result .= " data-address='".$bathroom['street_address']."' ";
			$result .= " data-lat='".$bathroom['lat']."' ";
			$result .= " data-long='".$bathroom['lng']."' ";
			$result .= " data-hours='".$bathroom['hours']."' ";
			$result .= " data-hiring='".$bathroom['is_hiring']."' ";
			$result .= " data-hiringurl='".$bathroom['bathrooms_url']."' ";
			$result .= " data-whysf='".$bathroom['why_sf']."' ";
			$result .= " data-category='".$bathroom['type']."' >";
			$result .= " data-rating='".$bathroom['rating']."' >";
			$result .= "</a></li>";
		}
		print_r($result);
	}
	exit;
?>