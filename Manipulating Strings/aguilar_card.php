<?php

function isValidCreditCard($number) {
  $cleanNumber = preg_replace('/\D/',  '', $number);

  return strlen($cleanNumber) === 16 && ctype_digit($cleanNumber);
}


$creditCardNumber = "1234  5678  9101  1213";

if (isValidCreditCard($creditCardNumber)) {
  echo "TRANSACTION SUCCESSFUL";
} else {
  echo "TRANSACTION FAILED";
}

?>
