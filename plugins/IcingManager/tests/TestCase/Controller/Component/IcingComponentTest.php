<?php
namespace IcingManager\Test\TestCase\Controller\Component;

use Cake\Controller\ComponentRegistry;
use Cake\TestSuite\TestCase;
use IcingManager\Controller\Component\IcingComponent;

/**
 * IcingManager\Controller\Component\IcingComponent Test Case
 */
class IcingComponentTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \IcingManager\Controller\Component\IcingComponent
     */
    public $Icing;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $registry = new ComponentRegistry();
        $this->Icing = new IcingComponent($registry);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Icing);

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
