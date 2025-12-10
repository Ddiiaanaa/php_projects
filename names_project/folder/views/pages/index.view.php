<h1>Most common names:</h1>
<ol>
    <?php foreach($overview AS $row): ?>
        <li>
            <a href="name.php?<?php echo http_build_query(['name' => $row['name']]); ?>">
                <?php echo e($row['name']); ?>
            </a>
        </li>
    <?php endforeach; ?>
</ol>