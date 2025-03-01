<?php

$number = 12.12;

$roundedNumber = round($number);

$result = is_numeric($roundedNumber) ? ($roundedNumber % 2 == 0 ? "The number $roundedNumber is even." : "The number $roundedNumber is odd.") : "The value is not a number.";

echo $result;

?>
