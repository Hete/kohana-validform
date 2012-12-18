<?php defined('SYSPATH') or die('No direct script access.'); ?>
<div class="alert alert-<?php echo $message->type ?>">
    <?php echo $message ?>
    <button type="button" class="close" data-dismiss="alert">×</button>
</div>