<?php

/**
 * Description of session
 *
 * @package Notification
 * @category Writers
 * @author Guillaume Poirier-Morency <guillaumepoiriermorency@gmail.com>
 */
class Notification_Cache extends Notification_Writer {

    public function read() {
        return array(
            Cache::instance()->get("notifications", array()),
            Cache::instance()->get("errors", array())
        );
    }

    public function write(array $notifications, array $errors) {
        Cache::instance()->set("errors", $errors);
        Cache::instance()->set("notifications", $notifications);
    }

//put your code here
}

?>
