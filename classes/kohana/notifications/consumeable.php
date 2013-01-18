<?php

defined('SYSPATH') or die('No direct script access.');

/**
 * Interface for consumeable items.
 */
interface Kohana_Notifications_Consumeable {

    /**
     * Mark the object as consumed
     */
    public function consume();

    /**
     * Tells if the message is consumed.
     */
    public function consumed();
}

?>
