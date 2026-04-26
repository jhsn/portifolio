<?php

namespace App\Queries\Vacancies;

use App\Models\Vacancy;
use Illuminate\Database\Eloquent\Collection;

class ListRelatedVacanciesQuery
{
    public function handle(Vacancy $vacancy, int $limit = 3): Collection
    {
        return Vacancy::query()
            ->published()
            ->whereKeyNot($vacancy->getKey())
            ->latest('published_at')
            ->limit($limit)
            ->get();
    }
}
