<?php
namespace MenuManager\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use MenuManager\Model\Entity\Menu;

/**
 * Menus Model
 *
 * @property \Cake\ORM\Association\HasMany $Links
 */
class MenusTable extends Table
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

        $this->table('menus');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Links', [
            'foreignKey' => 'menu_id',
            'className' => 'MenuManager.Links'
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
            ->requirePresence('key', 'create')
            ->notEmpty('key');

        $validator
            ->requirePresence('tag', 'create')
            ->notEmpty('tag');

        $validator
            ->allowEmpty('tag_attributes');

        $validator
            ->requirePresence('list_tag', 'create')
            ->notEmpty('list_tag');

        $validator
            ->allowEmpty('list_tag_attributes');

        $validator
            ->requirePresence('dropdown_tag', 'create')
            ->notEmpty('dropdown_tag');

        $validator
            ->allowEmpty('dropdown_tag_attributes');

        $validator
            ->requirePresence('dropdown_list_tag', 'create')
            ->notEmpty('dropdown_list_tag');

        $validator
            ->allowEmpty('dropdown_list_tag_attributes');

        $validator
            ->requirePresence('active_class', 'create')
            ->notEmpty('active_class');

        $validator
            ->boolean('status')
            ->requirePresence('status', 'create')
            ->notEmpty('status');

        return $validator;
    }
}
