<?php

defined('SYSPATH') or die('No direct script access.');

/**
 * Writer for notifications and errors.
 *
 * @package Notification
 * @category Writers
 * @author Guillaume Poirier-Morency <guillaumepoiriermorency@gmail.com>
 */
abstract class Notification_Writer {

    /**
     * Read notifications and errors from persistent data.
     * 
     * @return array an array like array($notifications, $errors)
     */
    public abstract function read();

    /**
     * Write notifications and errors.
     * 
     * @param array $notifications
     * @param array $errors
     */
    public abstract function write(array $notifications, array $errors);
}

?>
