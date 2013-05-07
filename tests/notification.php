<?php

defined('SYSPATH') or die('No direct script access.');

/**
 * Tests for Notifications module.
 * 
 * @package Notifications
 * @category Tests
 * @author Guillaume Poirier-Morency <john.doe@example.com>
 * @copyright (c) 2012, Hète.ca Inc.
 */
class Notification_Test extends Unittest_TestCase {

    public function setUp() {
        parent::setUp();
        Notification::instance()->notifications();
    }

    /**
     * Test for adding notification
     */
    public function test_add_notification() {

        $this->assertCount(0, Notification::instance()->notifications());

        Notification::instance()->add("crap :toto", array(":toto" => "crap"), "alert");

        // There should be only one element
        $this->assertCount(1, Notification::instance()->notifications());
    }

    public function test_remove_notification() {

        Notification::instance()->add("crap :toto", array(":toto" => "crap"), "alert");
    }

    /**
     * Test for adding errors
     */
    public function test_add_error() {

        $this->assertCount(0, Notification::instance()->errors());

        $validation = Validation::factory(array("foo" => "bar", "bar" => "foo"))
                ->rule("foo", "equals", array(":value", "bar"))
                ->rule("bar", "not_empty");

        $validation->check();

        Notification::instance()->errors($validation);

        Notification::instance()->errors("field", "crap :toto", array(":toto" => "crap"), "alert");

        // There should be only one element
        $this->assertCount(1, Notification::instance()->errors());

        // Element should have been wiped from being read
        $this->assertCount(0, Notification::instance()->errors());
    }

    public function test_notifications_view() {
        View::factory("notifications")->render();
    }

    public function test_errors_view() {
        View::factory("errors")->render();
    }

}

?>
