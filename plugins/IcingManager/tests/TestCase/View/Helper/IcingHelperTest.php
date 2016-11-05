<?php
namespace IcingManager\Test\TestCase\View\Helper;

use Cake\TestSuite\TestCase;
use Cake\View\View;
use IcingManager\View\Helper\IcingHelper;

/**
 * IcingManager\View\Helper\IcingHelper Test Case
 */
class IcingHelperTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \IcingManager\View\Helper\IcingHelper
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
        $view = new View();
        $this->Icing = new IcingHelper($view);
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
