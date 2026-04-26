<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Vacancy;

class VacancyPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Vacancy $vacancy): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, Vacancy $vacancy): bool
    {
        return true;
    }

    public function delete(User $user, Vacancy $vacancy): bool
    {
        return true;
    }
}
