<?php

$number = 1;

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bigger Numbers</title>
</head>
<body>
  <?php
  do {
    echo "<p style='font-size: {$number}px;'>$number</p>";
    $number++;
  } while ($number <= 30);
  ?>
</body>
</html>
