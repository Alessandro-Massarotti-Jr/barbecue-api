<?php

namespace App\Observers;

use App\Models\User;
use Illuminate\Support\Facades\Storage;

class UserObserver
{

    public function retrieved(User $user): void
    {
        $user->profile_image_url = $user->profile_image_url;
    }

    public function created(User $user): void
    {
        $user->profile_image_url = $user->profile_image_url;
    }

    public function updating(User $user)
    {
        unset($user->profile_image_url);
    }

    public function updated(User $user): void
    {

        $user->profile_image_url = $user->profile_image_url;
    }

    public function deleted(User $user): void
    {
        if ($user->profile_image_path) {
            Storage::delete($user->profile_image_path);
        }

        $user->profile_image_url = null;
    }

    public function restored(User $user): void
    {
        $user->profile_image_url = $user->profile_image_url;
    }

    public function forceDeleted(User $user): void
    {
        $user->profile_image_url = $user->profile_image_url;
    }
}
