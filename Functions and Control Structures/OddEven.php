<?php

$favColor = "#32A885";

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Odd and Even Numbers</title>
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
      <th>Even Numbers</th>
      <th>Odd Numbers</th>
    </tr>
    <?php
    for ($i=0; $i <= 100; $i+=2) {
      echo "<tr><td>$i</td><td>" . ($i + 1) . "</td></tr>";
    }
    ?>
  </table>
</body>
</html>
