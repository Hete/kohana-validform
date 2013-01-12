<?php

defined('SYSPATH') or die('No direct script access.');

/**
 * Notification.
 * 
 * @package Notifications
 * @author Guillaume Poirier-Morency <guillaumepoiriermorency@gmail.com>
 * @copyright (c) 2012, Hète.ca Inc.
 */
class Kohana_Notifications_Notification extends Notifications_Message {

    public static function factory($message, array $variables = NULL, $type = NULL) {
        return new Notifications_Notification($message, $variables, $type);
    }

}

?>
