<?php

defined('SYSPATH') or die('No direct script access.');

interface Kohana_Notifications_Consumeable {

    /**
     * Mark the object as consumed
     */
    public function consume();

    public function consumed();
}

?>
