<?php

require __DIR__ . '/inc/all.inc.php';

$char = (string) ($_GET['char'] ?? '');
if (strlen($char) > 1) {
    $char = $char[0];
}
$char = strtoupper($char);

$alphabet = gen_alphabet();
if (strlen($char) === 0 OR 
    !in_array($char, $alphabet)) {
    header("Location: index.php");
    die();
}


$page = (int) ($_GET['page'] ?? 1);

$perPage = 15;

$names = fetch_names_by_initial($char, $page, $perPage);
$count = count_names_by_initial($char);

render('char.view', [
    'names' => $names,
    'char' => $char,
    'pagination' => [
        'page' => $page,
        'count' => $count,
        'perPage' => $perPage
    ]
]);