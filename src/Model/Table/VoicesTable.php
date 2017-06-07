<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Voices Model
 *
 * @property \Cake\ORM\Association\HasMany $Messages
 *
 * @method \App\Model\Entity\Voice get($primaryKey, $options = [])
 * @method \App\Model\Entity\Voice newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Voice[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Voice|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Voice patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Voice[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Voice findOrCreate($search, callable $callback = null, $options = [])
 */
class VoicesTable extends Table
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

        $this->setTable('voices');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->hasMany('Messages', [
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
            ->allowEmpty('namejingle');

        $validator
            ->numeric('namejinglemixpoint')
            ->allowEmpty('namejinglemixpoint');

        return $validator;
    }
}
