<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Composer\DependencyResolver\Rule;

/**
 * Users Model
 * @property \Cake\ORM\Association\BelongsTo $Groups
 * @property \Cake\ORM\Association\HasMany $Posts
 *
 * @method \App\Model\Entity\User get($primaryKey, $options = [])
 * @method \App\Model\Entity\User newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\User[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\User|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\User[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\User findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class UsersTable extends Table
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

        $this->setTable('users');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Groups', [
            'foreignKey' => 'role',
            'joinType' => 'INNER'
        ]);

        $this->hasMany('Posts', [
            'foreignKey' => 'user_id'
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
            ->requirePresence('username', 'create')
            ->notEmpty('username', 'A username is required')
            ->add('username', array(
                    'required' => array(
                    'rule' => 'notBlank',
                    'required' => 'create'
                ),
                'size' => array(
                    'rule' => array('lengthBetween', 3, 20),
                    'message' => 'Password should be at least 3 chars long'
                )));
        $validator
            ->email('email')
            ->requirePresence('email', 'create')
            ->notEmpty('email', 'a email is required')
            ->add('email','validFormat',[
                "rule" => ["email", false,'/^[a-zA-Z0-9]{4,10}+@[a-zA-Z]+\.[a-zA-Z]{2,4}$/'],
                "message" => "Email must be valid."]);
        $validator
            ->requirePresence('password', 'create')
            ->notEmpty('password', 'A password is required')
            ->notEmpty('confirm_password','confirm password is required')
            ->add('password', ['length' => ['rule' => ['minLength', 5],'message' => 'Password need to be at least 5 characters long',]])
            ->add('confirm_password',
                'compareWith', [
                'rule' => ['compareWith', 'password'],
                'message' => 'Passwords not equal.'
                ]);
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
        $rules->add($rules->isUnique(['username']));
        $rules->add($rules->isUnique(['email']));

        return $rules;
    }
}
