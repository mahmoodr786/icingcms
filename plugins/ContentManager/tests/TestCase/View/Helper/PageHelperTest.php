<?php
namespace ContentManager\Test\TestCase\View\Helper;

use Cake\TestSuite\TestCase;
use Cake\View\View;
use ContentManager\View\Helper\PageHelper;

/**
 * ContentManager\View\Helper\PageHelper Test Case
 */
class PageHelperTest extends TestCase
{

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $view = new View();
        $this->Page = new PageHelper($view);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Page);

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
