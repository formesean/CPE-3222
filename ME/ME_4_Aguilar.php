<?php

function sanitizeString($text) {
  // TO REMOVE:
  // a to z, A to Z, 0 to 9, space, special characters
  return preg_replace("/[^a-zA-Z0-9 ]/", "", $text);
}

$text = "Hello @world! How are you?";
echo sanitizeString($text);

?>
