<?php
declare(strict_types = 1);

namespace App\Model\Entity;

use Cake\ORM\Entity;
use Authentication\PasswordHasher\DefaultPasswordHasher;

class User extends Entity
{
  // Fields that can be mass assigned using newEntity() or patchEntity();
  // If you change your table, remember to update your entity class otherwise
  // you won't be able to store data in the new field
  protected array $_accessible = [
    'username' => true,
    'password' => true,
    'email' => true,
    'first_name' => true,
    'last_name' => true,
    'slug' => true,
    'role' => true,
    'modified' => true,
    'created' => true,
  ];
  
  // Fields excluded from JSON versions of the entity
  protected array $_hidden = [
    'passkey',
    'timeout',
    'password',
  ];
  
  // Mutator to hash the user's password before saving and before validation
  protected function _setPassword(string $password): ?string
  {
    if (strlen($password) > 0) {
      $hasher = new DefaultPasswordHasher();
      return $hasher->hash($password);
    }
  }
  
  // Accessor for virtual field full_name
  protected function _getFullName()
  {
    return $this->first_name . ' ' . $this->last_name;
  }
  
  // Accessor for quick admin role check
  protected function _getIsAdmin()
  {
    return $this->role === 'Admin';
  }
  
  // Access for quick disabled account check
  protected function _getIsDisabled()
  {
    return $this->role === 'Disabled';
  }
}