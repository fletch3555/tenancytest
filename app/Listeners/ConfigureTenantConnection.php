<?php

namespace App\Listeners;

use Tenancy\Affects\Connections\Events\Drivers\Configuring;

class ConfigureTenantConnection
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
     * @param  Configuring  $event
     * @return void
     */
    public function handle(Configuring $event)
    {
        dump((new \Exception())->getTraceAsString());
        $event->useConnection('system', $event->configuration);
    }
}
