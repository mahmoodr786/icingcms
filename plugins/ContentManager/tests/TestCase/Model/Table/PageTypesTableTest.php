<?php
namespace ContentManager\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use ContentManager\Model\Table\PageTypesTable;

/**
 * ContentManager\Model\Table\PageTypesTable Test Case
 */
class PageTypesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \ContentManager\Model\Table\PageTypesTable
     */
    public $PageTypes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.content_manager.page_types',
        'plugin.content_manager.pages',
        'plugin.content_manager.roles'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('PageTypes') ? [] : ['className' => 'ContentManager\Model\Table\PageTypesTable'];
        $this->PageTypes = TableRegistry::get('PageTypes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->PageTypes);

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
}
