<?php

namespace App\Listeners;

use App\Events\RolePermissionUpdated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\SystemNotification;
use Illuminate\Support\Facades\DB;

class SendRolePermissionNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(RolePermissionUpdated $event): void
    {
        //

    // ****************************SAVE NOTI IN DB************************************

    SystemNotification::create([
    'message' => $event->message,
    'type' => 'role_updated',
    'user_id' => $event->updatedBy,
]);

 
    }
}
