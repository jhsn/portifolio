<?php

namespace App\Providers;

use App\Actions\Vacancies\BuildVacancyDraftAction;
use App\Actions\Vacancies\CreateVacancyAction;
use App\Actions\Vacancies\DeleteVacancyAction;
use App\Actions\Vacancies\UpdateVacancyAction;
use App\Contracts\ApplicationReviewServiceInterface;
use App\Contracts\BuildVacancyDraftActionInterface;
use App\Contracts\CreateVacancyActionInterface;
use App\Contracts\DeleteVacancyActionInterface;
use App\Contracts\PublicVacancyServiceInterface;
use App\Contracts\RecruitmentDashboardServiceInterface;
use App\Contracts\VacancyApplicationServiceInterface;
use App\Contracts\UpdateVacancyActionInterface;
use App\Models\Application;
use App\Models\Vacancy;
use App\Policies\ApplicationPolicy;
use App\Policies\VacancyPolicy;
use App\Services\ApplicationReviewService;
use App\Services\PublicVacancyService;
use App\Services\RecruitmentDashboardService;
use App\Services\VacancyApplicationService;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(RecruitmentDashboardServiceInterface::class, RecruitmentDashboardService::class);
        $this->app->bind(PublicVacancyServiceInterface::class, PublicVacancyService::class);
        $this->app->bind(ApplicationReviewServiceInterface::class, ApplicationReviewService::class);
        $this->app->bind(VacancyApplicationServiceInterface::class, VacancyApplicationService::class);
        $this->app->bind(BuildVacancyDraftActionInterface::class, BuildVacancyDraftAction::class);
        $this->app->bind(CreateVacancyActionInterface::class, CreateVacancyAction::class);
        $this->app->bind(UpdateVacancyActionInterface::class, UpdateVacancyAction::class);
        $this->app->bind(DeleteVacancyActionInterface::class, DeleteVacancyAction::class);
    }

    public function boot(): void
    {
        Gate::policy(Vacancy::class, VacancyPolicy::class);
        Gate::policy(Application::class, ApplicationPolicy::class);
    }
}
