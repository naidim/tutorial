<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\PhoneNumber;
use Authorization\IdentityInterface;
use Authorization\Policy\ResultInterface;
use Authorization\Policy\BeforePolicyInterface;

/**
 * PhoneNumber policy
 */
class PhoneNumberPolicy implements BeforePolicyInterface
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
     * Check if $user can add PhoneNumber
     */
    public function canAdd(IdentityInterface $user, PhoneNumber $phoneNumber)
    {
        // Users can only add phone numbers to themselves
        return $user->id == $phoneNumber->user_id;
    }

    /**
     * Check if $user can edit PhoneNumber
     */
    public function canEdit(IdentityInterface $user, PhoneNumber $phoneNumber)
    {
        // Users can only edit phone numbers themselves
        return $user->id === $phoneNumber->user_id;
    }

    /**
     * Check if $user can delete PhoneNumber
     */
    public function canDelete(IdentityInterface $user, PhoneNumber $phoneNumber)
    {
        // Users can only delete phone numbers from themselves
        return $user->id === $phoneNumber->user_id;
    }
}
