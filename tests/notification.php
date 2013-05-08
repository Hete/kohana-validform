<?php

defined('SYSPATH') or die('No direct script access.');

/**
 * Tests for Notification module.
 * 
 * @package Notification
 * @category Tests
 * @author Guillaume Poirier-Morency <john.doe@example.com>
 * @copyright (c) 2012, Hète.ca Inc.
 */
class Notification_Test extends Unittest_TestCase {

    public function setUp() {
        parent::setUp();
        Notification::$default_writer = "Cache";
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

    /**
     * Test for adding errors
     */
    public function test_add_error() {

        $this->assertCount(0, Notification::instance()->errors());

        $validation = Validation::factory(array("foo" => "sdsd@foo.com"))
                ->rule("foo", "not_empty")
                ->rule("foo", "email")
                ->rule("foo", "equals", array(":value", "sds"));

        $validation->check();

        Notification::instance()->errors($validation);

        $this->assertArrayHasKey("foo", Notification::instance()->errors());

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
