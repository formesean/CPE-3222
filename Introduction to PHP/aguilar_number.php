<?php

$number = 1234.5678;

$formattedNumber = number_format($number, 3);
$formatedWthSeparator = number_format($number, 2, '.', ',');

echo "Original number: $number <br>";
echo "Formatted number: $formattedNumber <br>";
echo "Formatted number: $formatedWthSeparator <br>";

?>
