<?php

namespace App\Observers;

use App\Models\Orders;
use Illuminate\Support\Facades\Log;

class OrderObserver
{
    /**
     * Handle the Orders "created" event.
     */
    public function created(Orders $orders): void
    {
        //
    }

    /**
     * Handle the Orders "updated" event.
     */
    public function updated(Orders $orders): void
    {
        if ($orders->status === 'selesai') {
            Log::info("message: Order with ID {$orders->id} has been completed.");
        }
        if ($orders->status === 'dibatalkan') {
            Log::info("message: Order with ID {$orders->id} has been canceled.");
        }
        if ($orders->status === 'diproses') {
            Log::info("message: Order with ID {$orders->id} is in progress.");
        }
    }

    /**
     * Handle the Orders "deleted" event.
     */
    public function deleted(Orders $orders): void
    {
        //
    }

    /**
     * Handle the Orders "restored" event.
     */
    public function restored(Orders $orders): void
    {
        //
    }

    /**
     * Handle the Orders "force deleted" event.
     */
    public function forceDeleted(Orders $orders): void
    {
        //
    }
}
