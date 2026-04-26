<?php

namespace App\Services;

use App\Contracts\VacancyApplicationServiceInterface;
use App\Data\ApplicationSubmissionData;
use App\Models\Application;
use App\Models\Vacancy;

class VacancyApplicationService implements VacancyApplicationServiceInterface
{
    public function submit(Vacancy $vacancy, array|ApplicationSubmissionData $payload, mixed $resume = null): Application
    {
        if ($payload instanceof ApplicationSubmissionData) {
            $resume = $payload->resume;
            $payload = $payload->toArray();
        }

        if ($resume instanceof \Illuminate\Http\UploadedFile) {
            $payload['resume_path'] = $resume->store('applications/resumes');
            $payload['resume_original_name'] = $resume->getClientOriginalName();
        }

        return $vacancy->applications()->create([
            ...$payload,
            'status' => 'new',
        ]);
    }
}
