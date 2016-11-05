<?php
namespace ContentManager\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use ContentManager\Model\Table\PageContentsTable;

/**
 * ContentManager\Model\Table\PageContentsTable Test Case
 */
class PageContentsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \ContentManager\Model\Table\PageContentsTable
     */
    public $PageContents;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.content_manager.page_contents',
        'plugin.content_manager.pages',
        'plugin.content_manager.page_types',
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
        $config = TableRegistry::exists('PageContents') ? [] : ['className' => 'ContentManager\Model\Table\PageContentsTable'];
        $this->PageContents = TableRegistry::get('PageContents', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->PageContents);

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
