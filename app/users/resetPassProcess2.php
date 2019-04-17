<?php
session_start();

$connection=mysqli_connect("db.soic.indiana.edu", "i494f18_team38", "my+sql=i494f18_team38", "i494f18_team38");

if (!$connection) {
	die("Failed to connect to MySQL: " . mysqli_connect_error() );
}

$pin = mysqli_real_escape_string($connection, $_POST['pin']);

$email = mysqli_real_escape_string($connection, $_POST['email']);


$passQuery = mysqli_query($connection, "select reset_pin from users where
	user_email = '$email'");

if (mysqli_num_rows($passQuery) > 0) {
	while ($row = mysqli_fetch_assoc($passQuery)) {
		$userPin = $row["reset_pin"];}}

if ($pin == $userPin) {
	header('Location: resetPassProcess3.php?email=' . $email);
}

?>
