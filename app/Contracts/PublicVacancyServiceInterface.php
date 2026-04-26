<?php

namespace App\Contracts;

use App\Models\Vacancy;
use Illuminate\Database\Eloquent\Collection;

interface PublicVacancyServiceInterface
{
    public function searchPublished(string $search = ''): Collection;

    public function ensurePublished(Vacancy $vacancy): Vacancy;

    public function relatedTo(Vacancy $vacancy, int $limit = 3): Collection;
}
