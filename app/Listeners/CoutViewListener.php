<?php

namespace App\Listeners;

use App\Events\CoutView;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CoutViewListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  CoutView  $event
     * @return void
     */
    public function handle(CoutView $event)
    {
        dd('11');
    }
}
