<?php

namespace App\Listeners;

use Tenancy\Affects\Connections\Contracts\ProvidesConfiguration;
use Tenancy\Affects\Connections\Events\Drivers\Configuring;
use Tenancy\Affects\Connections\Events\Resolving;
use Tenancy\Identification\Contracts\Tenant;

class ResolveConnections implements ProvidesConfiguration
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
     * @param  Resolving  $event
     * @return void
     */
    public function handle(Resolving $event)
    {
        $config = [];
        //if ($event->tenant) {
            event(new Configuring($event->tenant, $config, $this));
        //}
    }

    /**
     * @inheritDoc
     */
    public function configure(Tenant $tenant): array
    {
    }
}
