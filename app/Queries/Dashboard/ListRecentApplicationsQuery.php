<?php

namespace App\Queries\Dashboard;

use App\Models\Application;
use Illuminate\Database\Eloquent\Collection;

class ListRecentApplicationsQuery
{
    public function handle(int $limit = 12): Collection
    {
        return Application::query()
            ->with('vacancy:id,title,slug')
            ->latest()
            ->limit($limit)
            ->get();
    }
}
