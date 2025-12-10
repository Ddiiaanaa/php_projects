<h1>Statistics for the name: <?php echo e($name); ?></h1>

<?php if (empty($entries)): ?>
    <p>We could not find any entries in our system :/ </p>
<?php else: ?>
    <table>
        <thead>
            <tr>
                <th>Year</th>
                <th>Number of Babies born</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($entries AS $entry): ?>
                <tr>
                    <td><?php echo e($entry['year']); ?></td>
                    <td><?php echo e($entry['count']); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>