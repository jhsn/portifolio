<?php

namespace App\Queries\Dashboard;

use App\Models\Vacancy;
use Illuminate\Database\Eloquent\Collection;

class ListDashboardVacanciesQuery
{
    public function handle(): Collection
    {
        return Vacancy::query()
            ->withCount('applications')
            ->latest('published_at')
            ->get();
    }
}
