<?php

function isValidCreditCard($number) {
  $cleanNumber = preg_replace('/\D/',  '', $number);

  return strlen($cleanNumber) === 16 && ctype_digit($cleanNumber);
}

$result = "";
$creditCardNumber = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $creditCardNumber = $_POST["creditCardNumber"] ?? "";
}

if (isValidCreditCard($creditCardNumber)) {
  $result = "TRANSACTION SUCCESSFUL";
} else {
  $result = "TRANSACTION FAILED";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>What' my Card Number Again?</title>
</head>
<body>
  <form method="POST">
    <label for="credit_card">Enter Credit Card Number</label>
    <input type="text" id="credit_card" name="creditCardNumber" required>
    <button type="submit">Submit</button>
  </form>

  <?php if (!empty($result)): ?>
    <p><?php echo $result; ?></p>
  <?php endif; ?>
</body>
</html>
