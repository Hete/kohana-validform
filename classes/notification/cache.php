<?php

defined('SYSPATH') or die('No direct script access.');

/**
 * Cache writer for notifications and errors.
 *
 * @package Notification
 * @category Writers
 * @author Guillaume Poirier-Morency <guillaumepoiriermorency@gmail.com>
 * @copyright 2013, Hète.ca Inc.
 */
class Notification_Cache extends Notification_Writer {

    public function read() {

        $notifications = Kohana::cache("notifications");
        $errors = Kohana::cache("errors");

        return array(
            $notifications ? $notifications : array(),
            $errors ? $errors : array(),
        );
    }

    public function write(array $notifications, array $errors) {
        Kohana::cache("errors", $errors);
        Kohana::cache("notifications", $notifications);
    }

//put your code here
}

?>
