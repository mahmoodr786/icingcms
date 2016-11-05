<?php
namespace MenuManager\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use MenuManager\Model\Table\LinksTable;

/**
 * MenuManager\Model\Table\LinksTable Test Case
 */
class LinksTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \MenuManager\Model\Table\LinksTable
     */
    public $Links;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.menu_manager.links',
        'plugin.menu_manager.menus'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Links') ? [] : ['className' => 'MenuManager\Model\Table\LinksTable'];
        $this->Links = TableRegistry::get('Links', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Links);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
