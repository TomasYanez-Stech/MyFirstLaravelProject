<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Project;
use App\Policies\ProjectPolicy;
use Barryvdh\Debugbar\Facades\Debugbar;
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
        // Project::class => ProjectPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Gate::define('view-deleted-projects', function($user) {
            return $user->role_id === 1 || $user->role_id === 2;
        });

        // Gate::define('write-project', function($user) {
        //     return $user->role_id == 1;
        // });
            
        // Gate::define('create-project', [ProjectPolicy::class, "create"]);
        // Gate::define('delete-project', [ProjectPolicy::class, "delete"]);
        // Gate::define('update-project', [ProjectPolicy::class, "update"]);

    }
}
