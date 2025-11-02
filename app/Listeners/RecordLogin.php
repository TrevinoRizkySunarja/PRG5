<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class RecordLogin
{
    /**
     * Handle the event.
     */
    public function handle(Login $event): void
    {
        // Vermijd crash als de migratie nog niet is gedraaid
        if (! Schema::hasTable('logins')) {
            return;
        }

        DB::table('logins')->updateOrInsert(
            [
                'user_id'      => $event->user->id,
                'logged_in_at' => now()->toDateString(),
            ],
            [
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
    }
}
