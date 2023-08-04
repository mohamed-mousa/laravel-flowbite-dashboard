<?php

namespace App\Policies;

use App\Models\SiteSetting;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class SiteSettingPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function admin(User $user): bool
    {
        if ($user->type == 1) {
            return true;
        } else {
            return false;
        }
    }
}
