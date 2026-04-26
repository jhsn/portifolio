<?php

namespace App\Services;

use App\Contracts\RecruitmentDashboardServiceInterface;
use App\Models\Application;
use App\Models\Vacancy;
use App\Queries\Dashboard\ListDashboardVacanciesQuery;
use App\Queries\Dashboard\ListRecentApplicationsQuery;
use Illuminate\Database\Eloquent\Collection;

class RecruitmentDashboardService implements RecruitmentDashboardServiceInterface
{
    public function __construct(
        private readonly ListDashboardVacanciesQuery $listDashboardVacanciesQuery,
        private readonly ListRecentApplicationsQuery $listRecentApplicationsQuery,
    ) {
    }

    public function stats(): array
    {
        return [
            'vacancies' => Vacancy::query()->published()->count(),
            'applications' => Application::query()->count(),
            'new_applications' => Application::query()->where('status', 'new')->count(),
            'companies' => Vacancy::query()->published()->distinct('company')->count('company'),
        ];
    }

    public function recentVacancies(): Collection
    {
        return $this->listDashboardVacanciesQuery->handle();
    }

    public function recentApplications(int $limit = 12): Collection
    {
        return $this->listRecentApplicationsQuery->handle($limit);
    }
}
