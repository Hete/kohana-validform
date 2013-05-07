<?php defined('SYSPATH') or die('No direct script access.'); ?>

<?php foreach (Notification::instance()->notifications() as $notification): ?>

    <div class="alert alert-<?php echo $notification["level"] ?>">
        <?php echo __($notification["message"], $notification["values"]) ?>
        <button type="button" class="close" data-dismiss="alert">×</button>
    </div>

<?php endforeach; ?>




