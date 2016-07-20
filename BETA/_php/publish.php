<?php
require_once 'db.php';

$sql = "UPDATE bathrooms
        SET published='1'
        WHERE id='17'";

mysql_select_db('bathrooms');
$retval = mysql_query( $sql, $con );
if(! $retval )
{
  die('Could not update data: ' . mysql_error());
}
echo "Updated data successfully\n";
mysql_close($con);



?>