<?php

namespace App\Contracts;

use App\Models\Vacancy;

interface DeleteVacancyActionInterface
{
    public function execute(Vacancy $vacancy): void;
}
