<?php

namespace App\Providers;

use App\Listeners\ConfigureTenantConnection;
use App\Listeners\ConfigureTenantDatabase;
use App\Listeners\RegisterMigrations;
use App\Listeners\ResolveConnections;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use Tenancy\Hooks\Database\Events as DatabaseEvents;
use Tenancy\Affects\Connections\Events as ConnectionsEvents;
use Tenancy\Hooks\Migration\Events as MigrationEvents;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        DatabaseEvents\Drivers\Configuring::class => [
            ConfigureTenantDatabase::class,
        ],
        ConnectionsEvents\Drivers\Configuring::class => [
            ConfigureTenantConnection::class,
        ],
        ConnectionsEvents\Resolving::class => [
            ResolveConnections::class,
        ],
        MigrationEvents\ConfigureMigrations::class => [
            RegisterMigrations::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
