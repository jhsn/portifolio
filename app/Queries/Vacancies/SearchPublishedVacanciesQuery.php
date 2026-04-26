<?php

namespace App\Queries\Vacancies;

use App\Models\Vacancy;
use Illuminate\Database\Eloquent\Collection;

class SearchPublishedVacanciesQuery
{
    public function handle(string $search = ''): Collection
    {
        return Vacancy::query()
            ->published()
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($nested) use ($search): void {
                    $nested->where('title', 'like', "%{$search}%")
                        ->orWhere('company', 'like', "%{$search}%")
                        ->orWhere('location', 'like', "%{$search}%")
                        ->orWhere('summary', 'like', "%{$search}%");
                });
            })
            ->latest('published_at')
            ->get();
    }
}
