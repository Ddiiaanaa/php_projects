<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./styles/simple.css" />
    <title>Document</title>
</head>
<body>
    <header><h1>Automatic Image List</h1></header>
    <main>
    <?php 
        function e($value) {
            return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
        }
    
        $handle = opendir(__DIR__ . '/images');

        $images = [];
        $allowedExtensions = [
            'jpg',
            'jpeg',
            'png'
        ];
        while (($currentFile = readdir($handle)) !== false) {
            if ($currentFile === '.' || $currentFile === '..') {
                continue;
            }
            $extension = pathinfo($currentFile, PATHINFO_EXTENSION);
            if (!in_array($extension, $allowedExtensions)) {
                continue;
            }

            $title = '';
            $content = [];

            $fileWithoutExt = pathinfo($currentFile, PATHINFO_FILENAME);
            $txtFile = __DIR__ . '/images/' . $fileWithoutExt . '.txt';
            if (file_exists($txtFile)) {
                $txt = file_get_contents($txtFile);
                $info = explode("\n", $txt);

                $title = $info[0];
                unset($info[0]);
                $content = array_values($info);
            }

            $images[] = [
                'image' => $currentFile,
                'title' => $title,
                'content' => $content
            ];
        }
        closedir($handle);
    ?>

    <?php foreach($images AS $image): ?>
        <figure>
            <h1><?php echo e($image['title']); ?></h1>
            <img src="images/<?php echo rawurlencode($image['image']); ?>" alt="" />
            <figcaption>
                <?php foreach($image['content'] AS $contentParagraph): ?>
                    <p><?php echo e($contentParagraph); ?></p>
                <?php endforeach; ?>
            </figcaption>
        </figure>
    <?php endforeach; ?>

    </main>
</body>
</html>