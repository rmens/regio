<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\VoicesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\VoicesTable Test Case
 */
class VoicesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\VoicesTable
     */
    public $Voices;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.voices',
        'app.messages'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Voices') ? [] : ['className' => 'App\Model\Table\VoicesTable'];
        $this->Voices = TableRegistry::get('Voices', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Voices);

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
