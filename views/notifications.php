<?php defined('SYSPATH') or die('No direct script access.'); ?>

<?php foreach (Notification::instance()->notifications() as $notification): ?>

    <div <?php echo HTML::attributes(array('class' => "alert alert-{$notification["level"]}")) ?>>
        <?php echo __($notification["message"], $notification["values"]) ?>
        <?php echo Form::button('', '×', array('class' => 'close', 'data-dismiss' => 'alert')) ?>
    </div>

<?php endforeach; ?>




