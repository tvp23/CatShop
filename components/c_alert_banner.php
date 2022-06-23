<?php
$alert = selectActiveAlert();
if (!empty($alert)) {
?>
    <div class="alert alert-<?php echo htmlentities($alert['color']); ?>" role="alert">
        <?php echo htmlentities($alert['message']); ?>
    </div>
<?php } ?>