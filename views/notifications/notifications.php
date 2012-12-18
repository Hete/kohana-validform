<?php defined('SYSPATH') or die('No direct script access.'); ?>
<?php foreach (Notifications::instance()->notifications() as $notification): ?>

    <?php echo View::factory("notifications/message", array("message" => $notification)) ?>

    <?php $notification->consume() ?>

<?php endforeach; ?>