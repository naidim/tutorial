<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\PhoneNumber;
use Authorization\IdentityInterface;

/**
 * PhoneNumber policy
 */
class PhoneNumberPolicy
{
    /**
     * Check if $user can add PhoneNumber
     */
    public function canAdd(IdentityInterface $user, PhoneNumber $phoneNumber)
    {
        if ($user->getOriginalData()->is_admin) {
            return true;
        }
        // Users can only add phone numbers to themselves
        return $user->id == $phoneNumber->user_id;
    }

    /**
     * Check if $user can edit PhoneNumber
     */
    public function canEdit(IdentityInterface $user, PhoneNumber $phoneNumber)
    {
        if ($user->getOriginalData()->is_admin) {
            return true;
        }
        // Users can only edit phone numbers themselves
        return $user->id === $phoneNumber->user_id;
    }

    /**
     * Check if $user can delete PhoneNumber
     */
    public function canDelete(IdentityInterface $user, PhoneNumber $phoneNumber)
    {
        if ($user->getOriginalData()->is_admin) {
            return true;
        }
        // Users can only delete phone numbers from themselves
        return $user->id === $phoneNumber->user_id;
    }
}
