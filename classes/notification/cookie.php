<?php

defined('SYSPATH') or die('No direct script access.');

/**
 * Cookie writer for notifications and errors.
 *
 * @package Notification
 * @category Writers
 * @author Guillaume Poirier-Morency <guillaumepoiriermorency@gmail.com>
 */
class Notification_Cookie extends Notification_Writer {

    public function read() {
        return array(
            (array) unserialize(Cookie::get("notifications", serialize(array()))),
            (array) unserialize(Cookie::get("errors", serialize(array())))
        );
    }

    public function write(array $notifications, array $errors) {
        Cookie::set("errors", serialize($errors));
        Cookie::set("notifications", serialize($notifications));
    }

//put your code here
}

?>
