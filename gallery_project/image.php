<?php
include './inc/functions.inc.php';
include './inc/images.inc.php';


?>
<?php include './views/header.php'; ?>

<?php if (!empty($_GET['image']) && !empty($imageTitles[$_GET['image']])): ?>
    <?php $image = $_GET['image']; ?>
    <h2><?php echo e($imageTitles[$image]); ?></h2>
    <img src="./images/<?php echo rawurlencode($image); ?>" />
    <p><?php echo str_replace("\n", "<br />", e($imageDescriptions[$image])); ?></p>
<?php else: ?>
    <div class="notice">
        This image could not be found.
    </div>
<?php endif; ?>

<a href="gallery.php">Back to gallery</a>
<br /><br /><br /><br /><br />


<?php include './views/footer.php'; ?>
