<?php

defined('SYSPATH') or die('No direct script access.');

/**
 * Session writer for notifications and errors.
 *
 * @package Notification
 * @category Writers
 * @author Guillaume Poirier-Morency <guillaumepoiriermorency@gmail.com>
 */
class Notification_Session extends Notification_Writer {

    public function read() {
        return array(
            Session::instance()->get("notifications", array()),
            Session::instance()->get("errors", array())
        );
    }

    public function write(array $notifications, array $errors) {
        Session::instance()->set("errors", $errors);
        Session::instance()->set("notifications", $notifications);
    }

}

?>
