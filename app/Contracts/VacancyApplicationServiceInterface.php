<?php

namespace App\Contracts;

use App\Data\ApplicationSubmissionData;
use App\Models\Application;
use App\Models\Vacancy;

interface VacancyApplicationServiceInterface
{
    public function submit(Vacancy $vacancy, array|ApplicationSubmissionData $payload, mixed $resume = null): Application;
}
