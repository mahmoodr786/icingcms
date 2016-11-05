<?php
namespace IcingManager\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;
use IcingManager\Model\Entity\Setting;

/**
 * Settings Model
 *
 */
class SettingsTable extends Table
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

        $this->table('settings');
        $this->displayField('title');
        $this->primaryKey('id');
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
            ->requirePresence('key', 'create')
            ->notEmpty('key');

        $validator
            ->requirePresence('title', 'create')
            ->notEmpty('title');

        $validator
            ->requirePresence('input_type', 'create')
            ->notEmpty('input_type');

        $validator
            ->integer('order')
            ->requirePresence('order', 'create')
            ->notEmpty('order');

        return $validator;
    }
}
