<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Models\UserProfile' => 'App\Policies\UserProfilePolicy',
        'App\Models\Document' => 'App\Policies\DocumentPolicy',
        'App\Models\Encadrant' => 'App\Policies\EncadrantPolicy',
        'App\Models\DemandeStage' => 'App\Policies\DemandeStagePolicy',
        'App\Models\Encadrant' => 'App\Policies\EncadrantPolicy',
        'App\Models\Enseignant' => 'App\Policies\EnseignantPolicy',
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
