<?php

// This API can be found here:
// => https://downloads.codingcoursestv.eu/056%20-%20php/weather/weather.php

$types = [
    'sunny',
    'cloudy',
    'snowy',
    'stormy'
];

$type = $types[rand(0, 3)];
$min = null;
$max = null;

// Sunny
if ($type === 'sunny') {
    $min = 293;
    $max = 308;
}
else if ($type === 'cloudy') {
    $min = 283;
    $max = 293;
}
else if ($type === 'stormy') {
    $min = 288;
    $max = 298;
}
else if ($type === 'snowy') {
    $min = 263;
    $max = 273;
}

$result = rand($min, $max);

echo json_encode([
    'weather' => $type,
    'temperature' => $result,
    'city' => @(string) ($_GET['city'] ?? 'New York City')
]);