<?php

defined('SYSPATH') or die('No direct script access.');

/**
 * 
 */
class Kohana_Notifications_Message_Iterator extends ArrayIterator {

    /**
     * Consume all messages in the iterator
     * @param $regex consume messages matching the regex
     * @return \Kohana_Notifications_Message_Iterator for builder syntax
     */
    public function consume_all($regex = NULL) {
        foreach ($this as $message) {
            $message->consume($regex);
        }
        // Update consumed items in the Singleton
        Notifications::instance()->update_data();
        return $this;
    }

}

?>
