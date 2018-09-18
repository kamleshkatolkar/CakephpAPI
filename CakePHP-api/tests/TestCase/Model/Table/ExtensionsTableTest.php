<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ExtensionsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ExtensionsTable Test Case
 */
class ExtensionsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ExtensionsTable
     */
    public $Extensions;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.extensions'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Extensions') ? [] : ['className' => ExtensionsTable::class];
        $this->Extensions = TableRegistry::getTableLocator()->get('Extensions', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Extensions);

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
