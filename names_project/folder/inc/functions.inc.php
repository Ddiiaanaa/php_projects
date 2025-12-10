<?php

function e($value) {
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

function render($view, $params) {
    extract($params);

    ob_start();
    require __DIR__ . '/../views/pages/' . $view . '.php';
    $contents = ob_get_clean();

    $alphabet = gen_alphabet();
    require __DIR__ . '/../views/layouts/main.view.php';
}

/**
 * This function will generate all the letters of the alphabet as 
 * an array: 
 * ['A', 'B', 'C', ... , 'X', 'Y', 'Z']
 */
function gen_alphabet() {
    $A = ord('A');
    $Z = ord('Z');

    $letters = [];
    for($x = $A; $x <= $Z; $x++) {
        $letters[] = chr($x);
    }
    return $letters;
}
