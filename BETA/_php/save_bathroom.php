<?php
$conn = new mysqli("localhost","root","root","shyter");

$sql = "INSERT INTO bathrooms (name, type, street_address, city, hoursOpen, hoursClosed, contact_email, contact_name, phone, why_sf, is_hiring, lat, lng, date, rating)
VALUES
('$_POST[name]','$_POST[type]','$_POST[street_address]','$_POST[city]','$_POST[hoursOpen]','$_POST[hoursClosed]','$_POST[contact_email]','$_POST[contact_name]','$_POST[phone]','$_POST[why_sf]','$_POST[is_hiring]','$_POST[latitude]','$_POST[longitude]','$_POST[date]','$_POST[rating]')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

mysqli_close($conn);

	if ($_POST['type'] == '1'){
		$type = 'Public Bathroom';
	} elseif ($_POST['type'] == '2'){
		$type = 'Coin Op Bathroom';
	} elseif ($_POST['type'] == '3'){
    $type = 'Dive Bar Bathroom';
  } elseif ($_POST['type'] == '4'){
		$type = 'Secrect Bathroom';
	} else {
		$type = 'Other';
	};

  $from = 'Shyter Updates <contact@shyter.com>'; 
  $name = $_POST['name'];
  $source = $_POST['date'];
	$contact_name = $_POST['contact_name'];
  $street_address = $_POST['street_address'];
	$rating = $_POST['rating'];
	$date = new DateTime($source);
	$fomratDate =  $date->format('M-d-Y'); // 07-17-12

    $message = '<html><body>';
    $message .= '<table rules="all" style="border-color: #666;" cellpadding="10">
    <tr>
      <td style="background: #eee;" colspan="2"><b>'.$contact_name.'</b> Would like to add a bathroom to Shyter.</td>
    </tr>
    <tr>
      <td style="background: #eee;">Bathroom Name:</td><td>'.$name.'</a></td>
    </tr>
    <tr>
      <td style="background: #eee;">Bathroom Type:</td><td>'.$type.'</td>
    </tr>
    <tr>
      <td style="background: #eee;">Bathroom Address:</td><td>'.$street_address.'</td>
    </tr>
    <tr>
      <td style="background: #eee;">Rating:</td><td>'.$rating.'</td>
    </tr>
  	<tr>
      <td style="background: #eee;">Contact Email:</td><td>'.$from.'</td>
    </tr>
    <tr>
      <td style="background: #eee;">Date Added:</td><td>'.$fomratDate.'</td>
    </tr>
    <tr>
      <td colspan="2"><b>Please <a href="http://shyter.com/admin/">Log-in to the admin console</a> To review and/or publish them.</b></td>
    </tr>
  	</table>
	</body>
	</html>
	';

	$message2 = '<html><body>';
    $message2 .= '<table rules="all" style="border-color: #666;" cellpadding="10">
    <tr>
      <td style="background: #eee;" colspan="2">Hello <b>' . $name . '</b>,</td>
    </tr>
    <tr>
      <td style="background: #eee;" colspan="2">Thanks for contacting Mapped SF!<br />We will review your submission shortly and should be adding you to the map soon. Thanks for being a part of San Francisco.</td>
    </tr>
  	<tr>
      <td style="background: #eee;" colspan="2">-Shyter SF</td>
    </tr>
  	</table>
	</body>
	</html>
	';

	$to = "gamecat2300@gmail.com"; // this is your Email address

	$subject = "Request to be added to Mapped SF";
  $subject2 = "Thank you for your submission to Mapped SF";

  $headers .= "From: ".$from." <".$from.">\r\n";  
	$headers .= "Reply-To: ". $from . "\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

  $headers2 = "From: " . $from . "\r\n";
	$headers2 .= "Reply-To: ". $from . "\r\n";
	$headers2 .= "MIME-Version: 1.0\r\n";
	$headers2 .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

    mail($to,$subject,$message,$headers);
    mail($from,$subject2,$message2,$headers2); // sends a copy of the message to the sender
    echo "Mail Sent. Thank you " . $name . ", we will contact you shortly.";
?>