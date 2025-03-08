<?php

function decrypt($hashes) {
  $foundPins = [];

  for ($i = 0; $i < 1000; $i++) {
    $pin = str_pad($i, 3, "0", STR_PAD_LEFT);
    $hashedPin = md5($pin);

    if (in_array($hashedPin, $hashes)) {
      $foundPins[$hashedPin] = $pin;
    }
  }

  return $foundPins;
}

$hashes = ["f4552671f8909587cf485ea990207f3b", "647bba344396e7c8170902bcf2e15551", "2afe4567e1bf64d32a5527244d104cea"];

$decryptedPin = decrypt($hashes);

echo "<h2>Decrypted PINs:</h2>";
echo "<ul>";
foreach ($decryptedPin as $hash => $pin) {
  echo "<li>Hash: <strong>$hash</strong> -> PIN: <strong>$pin</strong></li>";
}
echo "</ul>";

?>
