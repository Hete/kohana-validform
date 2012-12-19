<?php defined('SYSPATH') or die('No direct script access.'); ?>
<?php foreach (Notifications::instance()->notifications() as $notification): ?>

    <?php echo View::factory("notifications/message", array("message" => $notification)) ?>

    <?php $notification->consume() ?>

<?php endforeach; ?>

<?php if (Notifications::instance()->has_errors() && Kohana::$environment !== Kohana::PRODUCTION): ?>
    <?php echo View::factory("notifications/message", array("message" => Notifications_Notification::factory(print_r(Notifications::instance()->errors(), TRUE), NULL, "error"))); ?>
<?php endif; ?>

