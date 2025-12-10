<?php

require __DIR__ . '/inc/all.inc.php';


$overview = gen_names_overview();


render('index.view', [
    'overview' => $overview
]);