<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Datasource\EntityInterface;
use Cake\Event\Event;
use Cake\Core\Configure;

/**
 * Elections Model
 *
 * @property \Cake\ORM\Association\HasMany $Questions
 *
 * @method \App\Model\Entity\Election get($primaryKey, $options = [])
 * @method \App\Model\Entity\Election newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Election[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Election|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Election patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Election[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Election findOrCreate($search, callable $callback = null)
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ElectionsTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('elections');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Questions', [
            'foreignKey' => 'election_id'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        $validator
            ->integer('year')
            ->requirePresence('year', 'create')
            ->notEmpty('year');

        return $validator;
    }

    public function afterSave(Event $event, EntityInterface $election, \ArrayObject $options)
    {
        if (!$election->isNew()) {
            return true;
        }
        //recuperar las preguntas de config
        $questions = Configure::read('Elections.defaultQuestions');
        $questionEntities = [];
        foreach ($questions as $question) {
            $question['election_id'] = $election->id;
            $question['user_id'] = 2;
            $questionEntity = $this->Questions->newEntity($question);
            $questionEntities[] = $questionEntity;
        }
        //salvarlas todas vinculadas a este election
        return $this->Questions->saveMany($questionEntities);
    }
}
