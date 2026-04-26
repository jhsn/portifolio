<?php

namespace App\Services;

use App\Contracts\PublicVacancyServiceInterface;
use App\Models\Vacancy;
use App\Queries\Vacancies\ListRelatedVacanciesQuery;
use App\Queries\Vacancies\SearchPublishedVacanciesQuery;
use Illuminate\Database\Eloquent\Collection;

class PublicVacancyService implements PublicVacancyServiceInterface
{
    public function __construct(
        private readonly SearchPublishedVacanciesQuery $searchPublishedVacanciesQuery,
        private readonly ListRelatedVacanciesQuery $listRelatedVacanciesQuery,
    ) {
    }

    public function searchPublished(string $search = ''): Collection
    {
        return $this->searchPublishedVacanciesQuery->handle($search);
    }

    public function ensurePublished(Vacancy $vacancy): Vacancy
    {
        abort_unless($vacancy->is_published && $vacancy->published_at?->isPast(), 404);

        return $vacancy;
    }

    public function relatedTo(Vacancy $vacancy, int $limit = 3): Collection
    {
        return $this->listRelatedVacanciesQuery->handle($vacancy, $limit);
    }
}
