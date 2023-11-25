<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\Document;
use Authorization\IdentityInterface;

/**
 * Document policy
 */
class DocumentPolicy
{
    /**
     * Check if $user can add Document
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Document $document
     * @return bool
     */
    public function canAdd(IdentityInterface $user, Document $document)
    {
        if ($user->getOriginalData()->is_admin) {
            return true;
        }
        // Users can only add phone numbers to themselves
        return $user->id == $document->user_id;

    }

    /**
     * Check if $user can delete Document
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Document $document
     * @return bool
     */
    public function canDelete(IdentityInterface $user, Document $document)
    {
        if ($user->getOriginalData()->is_admin) {
            return true;
        }
        // Users can only delete phone numbers from themselves
        return $user->id === $document->user_id;
    }
}
