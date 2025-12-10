<?php


require __DIR__ . '/inc/all.inc.php';

$worldCityRepository = new WorldCityRepository($pdo);

$page = (int) ($_GET['page'] ?? 1);
$page = max(1, $page);

$perPage = 15;

$count = $worldCityRepository->count();
$entries = $worldCityRepository->paginate($page, $perPage);

render('index.view', [
    'entries' => $entries,
    'pagination' => [
        'count' => $count,
        'perPage' => $perPage,
        'page' => $page
    ]
]);