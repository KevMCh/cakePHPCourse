<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Questions Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Users
 * @property \Cake\ORM\Association\BelongsTo $Elections
 * @property \Cake\ORM\Association\HasMany $Answers
 * @property \Cake\ORM\Association\BelongsToMany $Tags
 *
 * @method \App\Model\Entity\Question get($primaryKey, $options = [])
 * @method \App\Model\Entity\Question newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Question[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Question|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Question patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Question[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Question findOrCreate($search, callable $callback = null)
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class QuestionsTable extends Table
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

        $this->table('questions');
        $this->displayField('title');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Elections', [
            'foreignKey' => 'election_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('Answers', [
            'foreignKey' => 'question_id',
            'dependent' => true
        ]);
        
        $this->hasMany('YesAnswers', [
            'className' => 'Answers',
            'foreignKey' => 'question_id',
            'dependent' => true,
            'conditions' => [
                'YesAnswers.answer' => true
                ]
        ]);
        
        $this->belongsToMany('Tags', [
            'foreignKey' => 'question_id',
            'targetForeignKey' => 'tag_id',
            'joinTable' => 'questions_tags'
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
            ->requirePresence('title', 'create')
            ->notEmpty('title');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['user_id'], 'Users'));
        $rules->add($rules->existsIn(['election_id'], 'Elections'));

        return $rules;
    }
}
