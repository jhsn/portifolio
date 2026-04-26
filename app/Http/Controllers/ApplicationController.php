<?php

namespace App\Http\Controllers;

use App\Contracts\PublicVacancyServiceInterface;
use App\Contracts\VacancyApplicationServiceInterface;
use App\Data\ApplicationSubmissionData;
use App\Http\Requests\StoreApplicationRequest;
use App\Models\Application;
use App\Models\Vacancy;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ApplicationController extends Controller
{
    public function __construct(
        private readonly PublicVacancyServiceInterface $publicVacancyService,
        private readonly VacancyApplicationServiceInterface $vacancyApplicationService,
    ) {
    }

    public function store(StoreApplicationRequest $request, Vacancy $vacancy): RedirectResponse
    {
        $vacancy = $this->publicVacancyService->ensurePublished($vacancy);

        $this->vacancyApplicationService->submit(
            $vacancy,
            ApplicationSubmissionData::fromValidated(
                $request->validated(),
                $request->file('resume')
            )
        );

        return redirect()->route('vacancies.show', $vacancy)
            ->with('application_success', config('recruitment.application.messages.submitted'));
    }

    public function downloadResume(Application $application): StreamedResponse
    {
        $this->authorize('view', $application);

        abort_unless($application->resume_path, 404);

        return Storage::download(
            $application->resume_path,
            $application->resume_original_name ?: 'curriculo-'.$application->id.'.pdf'
        );
    }
}
