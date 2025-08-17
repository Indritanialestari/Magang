<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

// Import model dan observer di atas
use App\Models\Pegawai;
use App\Observers\PegawaiObserver;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        // ...
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        // DAFTARKAN OBSERVER SECARA EKSPLISIT DI SINI
        Pegawai::observe(PegawaiObserver::class);
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}