<?php defined('SYSPATH') or die('No direct script access.'); ?>
<?php foreach (Notifications::instance()->notifications() as $notification): ?>

    <?php echo View::factory("notifications/message", array("message" => $notification)) ?>

    <?php $notification->consume() ?>

<?php endforeach; ?>

<?php foreach (Notifications::instance()->errors() as $error): ?>
    <?php echo View::factory("notifications/message", array("message" => $error)) ?>
<?php endforeach; ?>



