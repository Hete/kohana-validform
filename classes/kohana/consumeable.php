<?php

interface Kohana_Consumeable {

    /**
     * Mark the object as consumed
     */
    public function consume();

    public function consumed();
}

?>
