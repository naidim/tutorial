<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * PhoneNumbers Model
 *
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\PhoneNumber newEmptyEntity()
 * @method \App\Model\Entity\PhoneNumber newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\PhoneNumber> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\PhoneNumber get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\PhoneNumber findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\PhoneNumber patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\PhoneNumber> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\PhoneNumber|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\PhoneNumber saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\PhoneNumber>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\PhoneNumber>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\PhoneNumber>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\PhoneNumber> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\PhoneNumber>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\PhoneNumber>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\PhoneNumber>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\PhoneNumber> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class PhoneNumbersTable extends Table
{
    /**
     * Initialize method
     *
     * @param array<string, mixed> $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('phone_numbers');
        $this->setDisplayField('phone_number');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('user_id')
            ->notEmptyString('user_id');

        $validator
            ->scalar('phone_number')
            ->maxLength('phone_number', 15)
            ->requirePresence('phone_number', 'create')
            ->notEmptyString('phone_number');

        $validator
            ->scalar('type')
            ->maxLength('type', 1)
            ->requirePresence('type', 'create')
            ->notEmptyString('type');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn('user_id', 'Users'), ['errorField' => 'user_id']);

        return $rules;
    }
}
