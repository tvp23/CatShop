<?php
$alert = selectActiveAlert();
if (!empty($alert)) {
?>
    <div class="alert alert-<?php echo $alert['color']; ?>" role="alert">
        <?php echo $alert['message']; ?>
    </div>
<?php } ?>