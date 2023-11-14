<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\User;
use Authorization\IdentityInterface;
use Authorization\Policy\BeforePolicyInterface;
use Authorization\Policy\ResultInterface;

/**
 * User policy
 */
class UserPolicy implements BeforePolicyInterface
{
    public function before(?IdentityInterface $user, mixed $resource, string $action): ResultInterface|bool|null
    {
        if ($user->getOriginalData()->is_admin) {
            // Admin role gets access to everything
            return true;
        } elseif ($user->getOriginalData()->is_disabled) {
            // Disabled users get access to nothing except unauthenticated and skipped actions
            return false;
        }
        // returning null indicates the before hook didn't make a decision so the
        // authorization methods below will be invoked
        return null;
    }

    /**
     * Check if $user can edit User
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\User $resource
     * @return bool
     */
    public function canEdit(IdentityInterface $user, User $resource)
    {
        // Users can only edit themselves
        return $user->id === $resource->id;
    }
}
