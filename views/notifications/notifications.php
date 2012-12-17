<?php foreach (Notifications::instance()->notifications() as $notification): ?>

    <?php echo View::factory("notifications/notification", array("notification" => $notification)) ?>

    <?php $notification->consume() ?>

<?php endforeach; ?>