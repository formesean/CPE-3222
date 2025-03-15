<?php

function calculateTotalPrice(int $originalPrice, int $discount, int $tax)
{
  if (($discount < 0 || $discount > 100) || ($tax < 0 || $tax > 100)) {
    return "Invalid discount or tax percentage";
  }

  $discountedPrice = $originalPrice - ($originalPrice * ($discount / 100));
  $totalPrice = $discountedPrice + ($discountedPrice * ($tax / 100));
  return $totalPrice;
}

$originalPrice = 200;
$discount = 15;
$tax = 10;

echo calculateTotalPrice($originalPrice, $discount, $tax);

?>
