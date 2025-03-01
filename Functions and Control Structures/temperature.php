<?php

$favColor = "#32A885";

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Temperature Conversion</title>
  <style>
    table {
      width: 50%;
      border-collapse: collapse;
      margin: 20px auto;
    }

    th, td {
      border: 1px solid black;
      padding: 10px;
      text-align: center;
    }

    th {
      background-color: <?php echo $favColor; ?>;
      color: white;
    }

    td {
      background-color: white;
    }
  </style>
</head>
<body>
  <table>
    <tr>
      <th>Celcius (°C)</th>
      <th>Fahrenheit (°F)</th>
    </tr>
    <?php
    for ($celsius=0; $celsius <= 100 ; $celsius++) {
      $fahrenheit = ($celsius * 9/5) + 32;
      echo "<tr><td>$celsius</td><td>$fahrenheit</td></tr>";
    }
    ?>
  </table>
</body>
</html>
