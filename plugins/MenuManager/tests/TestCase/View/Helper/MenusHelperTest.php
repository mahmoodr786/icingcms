<?php
namespace MenuManager\Test\TestCase\View\Helper;

use Cake\TestSuite\TestCase;
use Cake\View\View;
use MenuManager\View\Helper\MenusHelper;

/**
 * MenuManager\View\Helper\MenusHelper Test Case
 */
class MenusHelperTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \MenuManager\View\Helper\MenusHelper
     */
    public $Menus;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $view = new View();
        $this->Menus = new MenusHelper($view);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Menus);

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
