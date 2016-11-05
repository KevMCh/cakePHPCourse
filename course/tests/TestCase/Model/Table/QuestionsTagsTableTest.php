<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\QuestionsTagsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\QuestionsTagsTable Test Case
 */
class QuestionsTagsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\QuestionsTagsTable
     */
    public $QuestionsTags;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.questions_tags',
        'app.questions',
        'app.users',
        'app.elections',
        'app.answers',
        'app.tags'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('QuestionsTags') ? [] : ['className' => 'App\Model\Table\QuestionsTagsTable'];
        $this->QuestionsTags = TableRegistry::get('QuestionsTags', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->QuestionsTags);

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
