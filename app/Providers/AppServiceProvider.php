<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

use App\Models\Animal;
use App\Models\Adoption;
use App\Models\Report;
use App\Models\EducationalContent;
use App\Models\Organization;
use App\Models\Feedback;

use App\Policies\AnimalPolicy;
use App\Policies\AdoptionPolicy;
use App\Policies\ReportPolicy;
use App\Policies\EducationalContentPolicy;
use App\Policies\OrganizationPolicy;
use App\Policies\FeedbackPolicy;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Animal::class => AnimalPolicy::class,
        Adoption::class => AdoptionPolicy::class,
        Report::class => ReportPolicy::class,
        EducationalContent::class => EducationalContentPolicy::class,
        Organization::class => OrganizationPolicy::class,
        Feedback::class => FeedbackPolicy::class,
    ];
    
    public function boot(): void
    {
        $this->registerPolicies();
    }
}
