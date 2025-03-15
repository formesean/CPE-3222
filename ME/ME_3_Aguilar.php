<?php

function getClothingRecommendation(float $temperature){
    switch ($temperature) {
      case $temperature > 30:
        return "Wear light clothing. Season: Summer";
        break;
      case $temperature >= 20.1 && $temperature <= 30:
        return "Wear a jacket. Season: Spring";
        break;
      case $temperature >= 10 && $temperature <= 20:
        return "Wear a coat. Season: Fall";
        break;
      case $temperature < 10:
        return "Wear a heavy coat and gloves. Season: Winter";
        break;
    }
}

$temperature = 18;
echo getClothingRecommendation($temperature);
?>
