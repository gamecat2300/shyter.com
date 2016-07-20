<?php
require_once '../_php/db.php';

$company = $_GET['id'];

mysqli_query($con, "DELETE FROM companies
        WHERE id='$company'");
mysql_close($con);

if(mysql_errno()){
    echo "MySQL error ".mysql_errno().": "
         .mysql_error()."\n<br>When executing <br>\n$query\n<br>";
} else {
	echo 'sucess';
	echo $_GET['id'];
}

?>