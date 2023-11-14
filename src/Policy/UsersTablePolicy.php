<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\UsersTable;
use Authorization\IdentityInterface;

/**
 * UsersTable policy
 */
class UsersTablePolicy
{
    public function scopeIndex(IdentityInterface $user, $query) {
        if ($user->getOriginalData()->is_admin) {
            return;
        }
        return $query->where(['Users.id' => $user->getOriginalData()->id]);
    }   
}
