<?php
namespace App\Model\Table;

use App\Model\Entity\Message;
use ArrayObject;
use Cake\Event\Event;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Messages Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Voices
 *
 * @method \App\Model\Entity\Message get($primaryKey, $options = [])
 * @method \App\Model\Entity\Message newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Message[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Message|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Message patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Message[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Message findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class MessagesTable extends Table
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

        $this->setTable('messages');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Voices', [
            'foreignKey' => 'voice_id'
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
            ->allowEmpty('name');

        $validator
            ->allowEmpty('path');

        $validator
            ->date('start_date')
            ->allowEmpty('start_date');

        $validator
            ->date('end_date')
            ->allowEmpty('end_date');

        $validator
            ->boolean('monday')
            ->requirePresence('monday', 'create')
            ->notEmpty('monday');

        $validator
            ->boolean('tuesday')
            ->requirePresence('tuesday', 'create')
            ->notEmpty('tuesday');

        $validator
            ->boolean('wednesday')
            ->requirePresence('wednesday', 'create')
            ->notEmpty('wednesday');

        $validator
            ->boolean('thursday')
            ->requirePresence('thursday', 'create')
            ->notEmpty('thursday');

        $validator
            ->boolean('friday')
            ->requirePresence('friday', 'create')
            ->notEmpty('friday');

        $validator
            ->boolean('saturday')
            ->requirePresence('saturday', 'create')
            ->notEmpty('saturday');

        $validator
            ->boolean('sunday')
            ->requirePresence('sunday', 'create')
            ->notEmpty('sunday');

        $validator
            ->date('ends')
            ->allowEmpty('ends');

        $validator
            ->boolean('active')
            ->requirePresence('active', 'create')
            ->notEmpty('active');

        $validator
            ->integer('times_planned')
            ->allowEmpty('times_planned');

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
        $rules->add($rules->existsIn(['voice_id'], 'Voices'));

        return $rules;
    }

    public function afterDelete(Event $event, Message $entity, ArrayObject $options)
    {
        if (file_exists($entity->path)) {
            unlink($entity->path);
        }
    }
}
