<?php

namespace App\Contracts;

use App\Data\ApplicationReviewData;
use App\Models\Application;

interface ApplicationReviewServiceInterface
{
    public function loadDetails(Application $application): Application;

    public function update(Application $application, array|ApplicationReviewData $validated): Application;

    public function statusOptions(): array;
}
