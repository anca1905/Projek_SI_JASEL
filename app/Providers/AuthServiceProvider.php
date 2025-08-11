<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\techniciansApplications;
use App\Models\User;
use App\Observers\UserObserver;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        // \App\Models\User::class => \App\Policies\ApplyIsTechnicianPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        User::observe(UserObserver::class);

        Gate::define('costumer', function ($user) {
            return $user->role === 'pelanggan';
        });

        Gate::define('apply', function ($user) {
            $application = techniciansApplications::where('user_id', $user->id)->first();

            // Kalau belum ada pengajuan atau status NULL, izinkan
            return !$application || $application->status === null || $application->status === 'ditolak';
        });
    }
}
