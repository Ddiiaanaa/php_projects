<?php

function e($value) {
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

function render($view, $params) {
    extract($params);

    ob_start();
    require __DIR__ . '/../views/pages/' . $view . '.php';
    $contents = ob_get_clean();
    
    require __DIR__ . '/../views/layouts/main.view.php';
}

function get_flag_for_country(string $iso2): string {
    $iso2 = strtolower($iso2);
    if (strlen($iso2) !== 2) {
        return $iso2;
    }
    return mb_chr(127462 + ord($iso2[0]) - ord('a')) . 
           mb_chr(127462 + ord($iso2[1]) - ord('a'));
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
