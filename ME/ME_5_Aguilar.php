<?php

function replaceSubstring($text, $word, $replaceWith) {
  $replacements = 0;

  $modifiedText = str_ireplace($word, $replaceWith, $text, $replacements);
  return array($modifiedText, $replacements);
}

$text = "The quick brown fox jumps over a lazy dog. The fox is fast.";
$word = "fox";
$replaceWith = "cat";
list($modifiedText, $replacements) = replaceSubstring($text, $word, $replaceWith);
echo $modifiedText . "<br>";
echo $replacements;
?>
