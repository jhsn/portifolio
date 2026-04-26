<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Collection;

interface RecruitmentDashboardServiceInterface
{
    public function stats(): array;

    public function recentVacancies(): Collection;

    public function recentApplications(int $limit = 12): Collection;
}
