<?php
require_once '../_php/db.php';

$bathroom = $_GET['id'];

mysqli_query($con, "DELETE FROM bathrooms
        WHERE id='$bathroom'");
mysql_close($con);

if(mysql_errno()){
    echo "MySQL error ".mysql_errno().": "
         .mysql_error()."\n<br>When executing <br>\n$query\n<br>";
} else {
	echo 'sucess';
	echo $_GET['id'];
}

?>