<?php

$host = 'localhost';
$username = 'root';
$password = '';
$dbase = 'unit_10';

// Create connection
$connect = mysqli_connect($host, $username, $password, $dbase);

// Check Connection
if (!connect) {
  die("Connection failed: " . mysqli_connect_error());
}

echo "<h3>$dbase Connected Successfully.</h3>";
echo "<strong>Client Information: </strong>" . mysqli_get_client_info($connect) . "<br>";
echo "<strong>Client Version: </strong>" . mysqli_get_client_version($connect) . "<br>";
echo "<strong>Host Information: </strong>" . mysqli_get_host_info($connect) . "<br>";
mysqli_close($connect);

?>
