<?php

namespace App\Services;

use App\Contracts\ApplicationReviewServiceInterface;
use App\Data\ApplicationReviewData;
use App\Models\Application;

class ApplicationReviewService implements ApplicationReviewServiceInterface
{
    public function loadDetails(Application $application): Application
    {
        $application->load('vacancy:id,title,slug,company,location,work_model,contract_type');

        return $application;
    }

    public function update(Application $application, array|ApplicationReviewData $validated): Application
    {
        $payload = $validated instanceof ApplicationReviewData ? $validated->toArray() : $validated;

        $application->update($payload);

        return $application->fresh();
    }

    public function statusOptions(): array
    {
        return config('recruitment.application.status_labels', []);
    }
}
