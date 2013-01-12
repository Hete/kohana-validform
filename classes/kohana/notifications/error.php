<?php

defined('SYSPATH') or die('No direct script access.');

/**
 * 
 * @package Notifications
 * @author Guillaume Poirier-Morency <guillaumepoiriermorency@gmail.com>
 */
class Kohana_Notifications_Error extends Notifications_Message {

    public $field;

    public static function factory($field, $message, array $variables = NULL, $type = "error") {
        return new Notifications_Error($field, $message, $variables, $type);
    }

    /**
     * 
     * @param string $field
     * @param string $message
     * @param array $variables
     * @param string $type
     */
    public function __construct($field, $message, array $variables = NULL, $type = "error", $persistent = TRUE) {
        parent::__construct($message, $variables, $type, $persistent);
        $this->field = $field;
    }

}

?>
