<?php

namespace App\Observers;

use App\Models\Barbecue;

class BarbecueObserver
{


    public function retrieved(Barbecue $Barbecue): void
    {
        $Barbecue->total_value = $Barbecue->total_value;
        $Barbecue->total_paid_value = $Barbecue->total_paid_value;
    }

    /**
     * Handle the Barbecue "created" event.
     */
    public function created(Barbecue $Barbecue): void
    {
        $Barbecue->total_value = $Barbecue->total_value;
        $Barbecue->total_paid_value = $Barbecue->total_paid_value;
    }

    public function updating(Barbecue $Barbecue)
    {
        unset($Barbecue->total_value);
        unset($Barbecue->total_paid_value);
    }

    /**
     * Handle the Barbecue "updated" event.
     */
    public function updated(Barbecue $Barbecue): void
    {
        $Barbecue->total_value = $Barbecue->total_value;
        $Barbecue->total_paid_value = $Barbecue->total_paid_value;
    }

    /**
     * Handle the Barbecue "deleted" event.
     */
    public function deleted(Barbecue $Barbecue): void
    {
        $Barbecue->total_value = $Barbecue->total_value;
        $Barbecue->total_paid_value = $Barbecue->total_paid_value;
    }

    /**
     * Handle the Barbecue "restored" event.
     */
    public function restored(Barbecue $Barbecue): void
    {
        $Barbecue->total_value = $Barbecue->total_value;
        $Barbecue->total_paid_value = $Barbecue->total_paid_value;
    }

    /**
     * Handle the Barbecue "force deleted" event.
     */
    public function forceDeleted(Barbecue $Barbecue): void
    {
        $Barbecue->total_value = $Barbecue->total_value;
        $Barbecue->total_paid_value = $Barbecue->total_paid_value;
    }
}
