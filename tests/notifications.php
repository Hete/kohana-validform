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
class Notifications_Tests extends Unittest_TestCase {

    public function setUp() {
        parent::setUp();
        // Empty the Notifications singleton
        Notifications::instance()->errors()->consume_all();
        Notifications::instance()->notifications()->consume_all();
    }

    /**
     * Test for adding notification
     */
    public function test_add_notification() {

        $this->assertCount(0, Notifications::instance()->notifications());

        Notifications::instance()->notifications("crap :toto", array(":toto" => "crap"), "alert");

        // There should be only one element
        $this->assertCount(1, Notifications::instance()->notifications());

        // The only element should be the current element
        $this->assertEquals("crap crap", Notifications::instance()->notifications()->current());
    }

    public function test_remove_notification() {

        Notifications::instance()->notifications("crap :toto", array(":toto" => "crap"), "alert");

        $this->assertTrue(Notifications::instance()->has_notifications());

        Notifications::instance()->notifications()->current()->consume();

        $this->assertFalse(Notifications::instance()->has_notifications());
    }

    public function test_remove_error() {

        Notifications::instance()->errors("field", "crap :toto", array(":toto" => "crap"), "alert");

        $this->assertTrue(Notifications::instance()->has_errors());

        Notifications::instance()->errors()->current()->consume();

        $this->assertFalse(Notifications::instance()->has_errors());
    }

    /**
     * Test for adding errors
     */
    public function test_add_error() {

        $this->assertCount(0, Notifications::instance()->errors());

        Notifications::instance()->errors("field", "crap :toto", array(":toto" => "crap"), "alert");

        // There should be only one element
        $this->assertCount(1, Notifications::instance()->errors());
    }

}

?>
