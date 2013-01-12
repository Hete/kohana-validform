<?php

defined('SYSPATH') or die('No direct script access.');

/**
 * Base class for notifications and errors.
 * 
 * @package Notifications
 * @author Guillaume Poirier-Morency <guillaumepoiriermorency@gmail.com>
 * @copyright (c) 2012, John Doe
 */
abstract class Kohana_Notifications_Message implements Notifications_Consumeable {
    // Constants for $type

    const ALERT = "alert",
            WARNING = "warning";

    public $message, $variables, $type, $persistent;

    /**
     * Boolean determining wether the message is consumed or not.
     * It is never consumed by default.
     * @var boolean 
     */
    private $_consumed = FALSE;

    /**
     * 
     * @param string $message message
     * @param array $variables substitution variable for message
     * @param string $type type of notification
     * @param boolean $persistent if true, the notification will persist after
     * this request.
     */
    public function __construct($message, array $variables = NULL, $type = NULL, $persistent = TRUE) {
        $this->message = $message;
        $this->variables = $variables;
        $this->type = $type;
        $this->persistent = $persistent;
    }

    /**
     * Consume the message. Regex is optional.
     * @param type $regex consume if it matches the regex.
     * @return \Kohana_Notifications_Message for builder syntax.
     */
    public function consume($regex = NULL) {
        $this->_consumed = $regex === NULL ? TRUE : preg_match($regex, $this);
        return $this;
    }

    /**
     * Tells if the message is consumed.
     * @return boolean true if it is, false otherwise.
     */
    public function consumed() {
        return (bool) $this->_consumed;
    }

    /**
     * String representation of this message.
     * @return string
     */
    public function __toString() {
        return __($this->message, $this->variables);
    }

}

?>
