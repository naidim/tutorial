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
}