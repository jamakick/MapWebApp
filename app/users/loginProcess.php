<?php
session_start();

$connection=mysqli_connect("db.soic.indiana.edu", "i494f18_team38", "my+sql=i494f18_team38", "i494f18_team38");

if (!$connection) {
	die("Failed to connect to MySQL: " . mysqli_connect_error() );
}

$username = mysqli_real_escape_string($connection, $_POST['username']);

$password = mysqli_real_escape_string($connection, $_POST['password']);

$passQuery = mysqli_query($connection, "Select password, user_first from users where username = '$username'");


if (mysqli_num_rows($passQuery) > 0) {
	while ($row = mysqli_fetch_assoc($passQuery)) {
		$correct = password_verify($password, $row["password"]);
		$name = $row["user_first"];}}

if ($correct) {
	$_SESSION['username'] = $username;
	$_SESSION['timestamp'] = time();
	$_SESSION['name'] = $name;

	mysqli_free_result($passQuery);
	mysqli_close($connection);

	header('Location: ../index.php');
}

else {
	mysqli_free_result($passQuery);
	mysqli_close($connection);
	header('Location: login.php?login=fail');
}



?>
