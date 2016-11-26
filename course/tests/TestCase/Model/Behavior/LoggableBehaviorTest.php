<?php
namespace App\Test\TestCase\Model\Behavior;

use App\Model\Behavior\LoggableBehavior;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Behavior\LoggableBehavior Test Case
 */
class LoggableBehaviorTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Behavior\LoggableBehavior
     */
    public $Loggable;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $this->Loggable = new LoggableBehavior();
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Loggable);

        parent::tearDown();
    }

    /**
     * Test initial setup
     *
     * @return void
     */
    public function testInitialization()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
