<?php
declare(strict_types=1);

namespace App\Model\Behavior;

use Cake\ORM\Behavior;
use Cake\Utility\Text;

class SluggableBehavior extends Behavior
{
  /**
   * Return a unique slug for passed in value
   */
  public function getSlug($entity, $field = 'name'): string
  {
    // set slug
    $baseSlug = mb_strtolower(Text::slug($entity->{$field}));
    // Check if existing slug matches $field
    if ($entity->slug && substr($entity->slug, 0, strlen($baseSlug)) == $baseSlug) {
        return $entity->slug;
    }
    $slugCount = 0;
    $slugNotUnique = true;
    do {
      // reset slug
      $slug = $baseSlug;
      // if slug count > 0 append slug count
      if ($slugCount) {
        $slug .= '-' . $slugCount;
      }
      // Check for existing slug with different email
      if ($this->recordExists($slug, $entity->id)) {
        $slugCount++;
      } else {
        $slugNotUnique = false;
      }
    } while ($slugNotUnique);
    return $slug;
  }

  /**
   * Check if user other than current user exists with same slug
   */
  protected function recordExists(string $slug, int|null $id): bool
  {
    // New record
    if ($id === null) {
      $query = $this->_table->find()
        ->where(['slug' => $slug]);
    } else {
      $query = $this->_table->find()
        ->where(['slug' => $slug])
        ->where(['id !=' => $id]);
     }
    return ($query->first() !== null);
  }
}