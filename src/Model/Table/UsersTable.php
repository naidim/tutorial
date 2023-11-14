<?php
declare(strict_types = 1);

namespace App\Model\Table;

use Cake\Event\EventInterface;
use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Utility\Text;
use Cake\Validation\Validator;

class UsersTable extends Table
{
  public function initialize(array $config): void
  {
    parent::initialize($config);
    $this->setTable('users'); // Name of the table in the database, if absent convention assumes lowercase version of file prefix
    $this->setDisplayField('full_name'); // field or virtual field used for default display in associated models, if absent 'id' is assumed
    $this->setPrimaryKey('id'); // Primary key field(s) in table, if absent convention assumes 'id' field
    $this->addBehavior('Timestamp'); // Allows your model to automatically timestamp records on creation/modification with the created/modified fields in your table
  }

  public function validationDefault(Validator $validator): Validator
  {
    // usernames are required when creating a user, can’t be empty, must be scalar (not an array or object), and must be unique
    $validator
      ->scalar('username')
      ->maxLength('username', 15)
      ->requirePresence('username', 'create')
      ->notEmptyString('username')
      ->add('username', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);
      
    $validator
      ->scalar('password')
      ->requirePresence('password', 'create')
      ->notEmptyString('password', 'create')
      ->allowEmptyString('password', null, 'update') // Allow updating the user without updating the password
      ->minLength('password', 8, 'Passwords must be at least 8 characters long.')
      ->add('password', 'custom', [
        'rule' => [$this, 'checkCharacters'],
        'message' => 'The password must contain 1 number, 1 uppercase, 1 lowercase, and 1 special character'
      ]);

    $validator
      ->scalar('confirm_password')
      ->requirePresence('confirm_password', 'create')
      ->notEmptyString('confirm_password', 'create')
      ->allowEmptyString('confirm_password', null, 'update')
      // password has to be listed first because that's the field being saved to the database 
      // if password has a value but confirm_password is empty, this check is not run
      ->sameAs('password', 'confirm_password', 'Passwords do not match.');

    $validator
      ->scalar('first_name')
      ->maxLength('first_name', 30)
      ->requirePresence('first_name', 'create')
      ->notEmptyString('first_name');
        
    $validator
      ->scalar('last_name')
      ->maxLength('last_name', 30)
      ->requirePresence('last_name', 'create')
      ->notEmptyString('last_name');
        
    $validator
      ->email('email')
      ->requirePresence('email', 'create')
      ->notEmptyString('email')
      ->add('email', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

    $validator
      ->date('dob')
      ->allowEmptyDate('dob');
    
    return $validator;
  }
  
  public function buildRules(RulesChecker $rules): RulesChecker
  {
    $rules->add($rules->isUnique(['username']));
    $rules->add($rules->isUnique(['email']));
      
    return $rules;
  }     

  public function beforeSave(EventInterface $event, $entity, $options)
  {
    $entity->slug = $this->getSlug($entity->full_name);
  }

  /**
   * Return slugged version of passed in string
   */
  protected function getSlug(string $name): string
  {
    $sluggedTitle = Text::slug($name);
    // lowercase the slug for consistency
    return mb_strtolower($sluggedTitle);
  }

  /**
   * Checks password for a single instance of each:
   * number, uppercase, lowercase, and special character
   *
   * @param string $password
   * @return boolean
   */
  public function checkCharacters(string $password): bool
  {
    // number
    if (!preg_match("#[0-9]#", $password)) {
      return false;
    }
    // Uppercase
    if (!preg_match("#[A-Z]#", $password)) {
      return false;
    }
    // lowercase
    if (!preg_match("#[a-z]#", $password)) {
      return false;
    }
    // special characters
    if (!preg_match("#\W+#", $password)) {
      return false;
    }
    return true;
  }
}