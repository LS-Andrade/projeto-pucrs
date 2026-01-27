<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

use App\Models\Animal;
use App\Models\AnimalPhoto;
use App\Models\Adoption;
use App\Models\Report;
use App\Models\EducationalContent;
use App\Models\Organization;
use App\Models\Feedback;

use App\Policies\AnimalPhotoPolicy; 
use App\Policies\AnimalPolicy;
use App\Policies\AdoptionPolicy;
use App\Policies\ReportPolicy;
use App\Policies\EducationalContentPolicy;
use App\Policies\OrganizationPolicy;
use App\Policies\FeedbackPolicy;

class AppServiceProvider extends ServiceProvider
{
    protected $policies = [
        \App\Models\User::class => \App\Policies\UserPolicy::class,
        \App\Models\Organization::class => \App\Policies\OrganizationPolicy::class,
        \App\Models\Animal::class => \App\Policies\AnimalPolicy::class,
        \App\Models\AnimalPhoto::class => \App\Policies\AnimalPhotoPolicy::class,
        \App\Models\Adoption::class => \App\Policies\AdoptionPolicy::class,
        \App\Models\AdoptionFollowup::class => \App\Policies\AdoptionFollowupPolicy::class,
        \App\Models\Category::class => \App\Policies\CategoryPolicy::class,
        \App\Models\Content::class => \App\Policies\ContentPolicy::class,
        \App\Models\Report::class => \App\Policies\ReportPolicy::class,
        \App\Models\ReportAttachment::class => \App\Policies\ReportAttachmentPolicy::class,
        \App\Models\AuditLog::class => \App\Policies\AuditLogPolicy::class,
    ];
    
    public function boot(): void
    {
        $this->registerPolicies();
    }
}
