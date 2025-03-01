<?php

$qpass_num = 12345;
$last_digit = $qpass_num % 10;

$today = date("l");

if (in_array($last_digit, [1, 3, 5, 7, 9]) && in_array($today, ["Monday", "Wednesday", "Friday"])) {
  $message = "You are allowed to go outside today.";
} elseif (in_array($last_digit, [0, 2, 4, 6, 8]) && in_array($today, ["Tuesday", "Thursday", "Saturday"])) {
  $message = "You are allow to go outside today.";
} elseif ($today === "Sunday") {
  $message = "No one is allowed to go outside today.";
} else {
  $message = "You are not allowed to go outside today.";
}

echo "<p>Your Quarantine Pass Control Number: $qpass_num</p>";
echo "<p>Today is: $today</p>";
echo "<p><strong>$message</strong></p>";

?>
