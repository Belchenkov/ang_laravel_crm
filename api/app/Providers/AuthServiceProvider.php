<?php

namespace App\Providers;

use App\Modules\Admin\LeadComment\Models\LeadComment;
use App\Modules\Admin\LeadComment\Policies\LeadCommentPolicy;
use App\Modules\Admin\Role\Models\Role;
use App\Modules\Admin\Role\Policies\RolePolicy;
use App\Modules\Admin\Sources\Models\Source;
use App\Modules\Admin\Sources\Policies\SourcePolicy;
use App\Modules\Admin\Task\Models\Task;
use App\Modules\Admin\Task\Policies\TaskPolicy;
use App\Modules\Admin\TaskComment\Models\TaskComment;
use App\Modules\Admin\TaskComment\Policies\TaskCommentPolicy;
use App\Modules\Admin\User\Policies\UserPolicy;
use App\Modules\Admin\User\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Role::class => RolePolicy::class,
        User::class => UserPolicy::class,
        Source::class => SourcePolicy::class,
        LeadComment::class => LeadCommentPolicy::class,
        Task::class => TaskPolicy::class,
        TaskComment::class => TaskCommentPolicy::class,
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
