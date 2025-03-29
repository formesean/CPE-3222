<?php

function isValidWholeNumber($input) {
  return ctype_digit($input) && $input > 0;
}

$n = "";
$error = "";
$table = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $n = $_POST["number"] ?? "";

  if (isValidWholeNumber($n)) {
    $n = (int) $n;
    $table .= "<h3>Multiplication Table for $n</h3>";
    $table .= "<table border='1' cellpadding='5' cellspacing='0'>";

    for ($i = 1; $i <= $n; $i++) {
      $table .= "<tr>";

      for ($j = 1; $j <= $n ; $j++) {
        $table .= "<td>" . ($i * $j) . "</td>";
      }

      $table .= "</tr>";
    }

    $table .= "</table>";
  } else {
    $error = "Please enter a valid whole number greater than 0.";
  }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Multiplication Table</title>
</head>
<body>
  <h2>Multiplication Table Generator</h2>

  <form method="POST">
    <label for="number">Enter a number: </label>
    <input type="text" name="number" require>
    <button type="submit">Submit</button>
  </form>

  <?php
    if (!empty($error)): ?>
      <p style="color: red;"><?php echo $error; ?></p>
  <?php endif; ?>

  <?php echo $table; ?>
</body>
</html>
