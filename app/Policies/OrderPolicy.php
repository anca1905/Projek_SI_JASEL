<?php

namespace App\Policies;

use App\Models\Orders;
use Illuminate\Auth\Access\Response;

class OrderPolicy
{
    /**
     * Determine whether the user can view any models.
     */

    public function viewAny(Orders $order)
    {
        //
    }

    /**
     * Determine whether the Orders can view the model.
     */
    public function view(Orders $Orders, Orders $model)
    {
        //
    }

    /**
     * Determine whether the Orders can create models.
     */
    public function create(Orders $Orders)
    {
        //
    }

    /**
     * Determine whether the Orders can update the model.
     */
    public function update(Orders $Orders, Orders $orders)
    {
        //
    }

    /**
     * Determine whether the Orders can delete the model.
     */
    public function delete(Orders $Orders, Orders $orders)
    {
        //
    }

    /**
     * Determine whether the Orders can restore the model.
     */
    public function restore(Orders $Orders, Orders $orders)
    {
        //
    }

    /**
     * Determine whether the Orders can permanently delete the model.
     */
    public function forceDelete(Orders $Orders, Orders $orders)
    {
        //
    }
}
