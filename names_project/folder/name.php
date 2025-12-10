<?php

require __DIR__ . '/inc/all.inc.php';

$name = (string) ($_GET['name'] ?? '');
if (empty($name)) {
    header("Location: index.php");
    die();
}

$entries = fetch_name_entries($name);

render('name.view', [
    'name' => $name,
    'char' => $name[0],
    'entries' => $entries
]);