<?php
require_once 'db.php';

function getbathrooms($type = -1, $is_hiring = -1, $search = ""){
	$sqlStr = "SELECT * FROM bathrooms WHERE 1 and published = '1'";
	if($type > 0){
		$sqlStr .= " AND type = {$type}";
	}
	if($is_hiring >= 0){
		$sqlStr .= " AND is_hiring = '{$is_hiring}'";
	}
	if($search != ""){
		$sqlStr .= " AND ( ";
		$sqlStr .= " name like '%$search%' OR ";
		$sqlStr .= " contact_email like '%$search%' OR ";
		$sqlStr .= " city like '%$search%' OR ";
		$sqlStr .= " street_address like '%$search%' ";
		$sqlStr .= ")";
	}
	/*if($is_hiring >= 0){
		$sqlStr .= " WHERE is_hiring = '{$is_hiring}'";
	}*/
	global $con;
	$result = mysqli_query($con, $sqlStr) or die(mysqli_error($con));
	if($result){
		$bathroomlist = array();
		while($rows = mysqli_fetch_array($result)){
			$temp = array();
			$temp['id'] = $rows['id'];
			$temp['name'] = $rows['name'];
			$temp['type'] = $rows['type'];
			$temp['street_address'] = $rows['street_address'];
			$temp['street_address2'] = $rows['street_address2'];
			$temp['city'] = $rows['city'];
			$temp['hoursOpen'] = $rows['hoursOpen'];
			$temp['hoursClosed'] = $rows['hoursClosed'];
			$temp['contact_email'] = $rows['contact_email'];
			$temp['why_sf'] = $rows['why_sf'];
			$temp['bathrooms_url'] = $rows['bathrooms_url'];
			$temp['is_hiring'] = $rows['is_hiring'];
			$temp['lat'] = $rows['lat'];
			$temp['lng'] = $rows['lng'];
			$temp['date'] = $rows['date'];
			$temp['published'] = $rows['published'];
			$temp['rating'] = $rows['rating'];
		
			array_push($bathroomlist, $temp);
		}
		return $bathroomlist;
	}
	return false;
}


function getAllbathrooms($type = -1, $is_hiring = -1, $search = ""){
	$sqlStr = "SELECT * FROM bathrooms WHERE 1";
	if($type > 0){
		$sqlStr .= " AND type = {$type}";
	}
	
	if($search != ""){
		$sqlStr .= " AND ( ";
		$sqlStr .= " name like '%$search%' OR ";
		$sqlStr .= " contact_email like '%$search%' OR ";
		$sqlStr .= " city like '%$search%' OR ";
		$sqlStr .= " street_address like '%$search%' ";
		$sqlStr .= ")";
	}
	/*if($is_hiring >= 0){
		$sqlStr .= " WHERE is_hiring = '{$is_hiring}'";
	}*/
	global $con;
	$result = mysqli_query($con, $sqlStr) or die(mysqli_error($con));
	if($result){
		$bathroomlist = array();
		while($rows = mysqli_fetch_array($result)){
			$temp = array();
			$temp['id'] = $rows['id'];
			$temp['name'] = $rows['name'];
			$temp['type'] = $rows['type'];
			$temp['street_address'] = $rows['street_address'];
			$temp['street_address2'] = $rows['street_address2'];
			$temp['city'] = $rows['city'];
			$temp['hoursOpen'] = $rows['hoursOpen'];
			$temp['hoursClosed'] = $rows['hoursClosed'];
			$temp['contact_email'] = $rows['contact_email'];
			$temp['contact_name'] = $rows['contact_name'];
			$temp['phone'] = $rows['phone'];
			$temp['why_sf'] = $rows['why_sf'];
			$temp['bathrooms_url'] = $rows['bathrooms_url'];
			$temp['is_hiring'] = $rows['is_hiring'];
			$temp['lat'] = $rows['lat'];
			$temp['lng'] = $rows['lng'];
			$temp['date'] = $rows['date'];
			$temp['published'] = $rows['published'];
			$temp['rating'] = $rows['rating'];
			array_push($bathroomlist, $temp);
		}
		return $bathroomlist;
	}
	return false;
}



function getHiringbathrooms($published = 1){
	$sqlStr = "SELECT * FROM bathrooms WHERE published = '1'";

	global $con;
	$result = mysqli_query($con, $sqlStr) or die(mysqli_error($con));
	if($result){
		$bathroomlist = array();
		while($rows = mysqli_fetch_array($result)){
			$temp = array();
			$temp['published'] = $rows['published'];
			array_push($bathroomlist, $temp);
		}
		return $bathroomlist;
	}
	return false;

}


?>