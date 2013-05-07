<?php

/**
 * Description of session
 *
 * @package Notification
 * @category Writers
 * @author Guillaume Poirier-Morency <guillaumepoiriermorency@gmail.com>
 */
abstract class Notification_Writer {

    public abstract function read();

    public abstract function write(array $notifications, array $errors);
}

?>
