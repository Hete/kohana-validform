<?php

/**
 * Description of session
 *
 * @package Notification
 * @category Writers
 * @author Guillaume Poirier-Morency <guillaumepoiriermorency@gmail.com>
 */
class Notification_Cookie extends Notification_Writer {

    public function read() {
        return array(
            unserialize(Cookie::get("notifications", serialize(array()))),
            unserialize(Cookie::get("errors", serialize(array())))
        );
    }

    public function write(array $notifications, array $errors) {
        Cookie::set("errors", serialize($errors));
        Cookie::set("notifications", serialize($notifications));
    }

//put your code here
}

?>
