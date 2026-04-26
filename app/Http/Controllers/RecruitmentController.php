<?php

namespace App\Http\Controllers;

use App\Contracts\ApplicationReviewServiceInterface;
use App\Contracts\BuildVacancyDraftActionInterface;
use App\Contracts\CreateVacancyActionInterface;
use App\Contracts\DeleteVacancyActionInterface;
use App\Contracts\PublicVacancyServiceInterface;
use App\Contracts\RecruitmentDashboardServiceInterface;
use App\Contracts\UpdateVacancyActionInterface;
use App\Data\ApplicationReviewData;
use App\Data\VacancyData;
use App\Http\Requests\StoreVacancyRequest;
use App\Http\Requests\UpdateApplicationReviewRequest;
use App\Models\Application;
use App\Models\Vacancy;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class RecruitmentController extends Controller
{
    public function __construct(
        private readonly RecruitmentDashboardServiceInterface $dashboardService,
        private readonly PublicVacancyServiceInterface $publicVacancyService,
        private readonly ApplicationReviewServiceInterface $applicationReviewService,
        private readonly BuildVacancyDraftActionInterface $buildVacancyDraftAction,
        private readonly CreateVacancyActionInterface $createVacancyAction,
        private readonly UpdateVacancyActionInterface $updateVacancyAction,
        private readonly DeleteVacancyActionInterface $deleteVacancyAction,
    ) {
    }

    public function home(Request $request): View
    {
        $search = trim((string) $request->string('search'));

        return view('portfolio.home', [
            'vacancies' => $this->publicVacancyService->searchPublished($search),
            'search' => $search,
            'stats' => $this->dashboardService->stats(),
        ]);
    }

    public function show(Vacancy $vacancy): View
    {
        $vacancy = $this->publicVacancyService->ensurePublished($vacancy);

        return view('portfolio.show', [
            'vacancy' => $vacancy,
            'relatedVacancies' => $this->publicVacancyService->relatedTo($vacancy),
        ]);
    }

    public function admin(): View
    {
        $this->authorize('viewAny', Vacancy::class);

        return view('portfolio.admin', [
            'stats' => $this->dashboardService->stats(),
            'vacancies' => $this->dashboardService->recentVacancies(),
            'applications' => $this->dashboardService->recentApplications(),
        ]);
    }

    public function showApplication(Application $application): View
    {
        $this->authorize('view', $application);

        return view('portfolio.applications.show', [
            'application' => $this->applicationReviewService->loadDetails($application),
            'statusOptions' => $this->applicationReviewService->statusOptions(),
        ]);
    }

    public function updateApplication(UpdateApplicationReviewRequest $request, Application $application): RedirectResponse
    {
        $this->authorize('update', $application);

        $this->applicationReviewService->update(
            $application,
            ApplicationReviewData::fromValidated($request->validated())
        );

        return redirect()
            ->route('dashboard.applications.show', $application)
            ->with('dashboard_feedback', config('recruitment.application.messages.updated'));
    }

    public function createVacancy(): View
    {
        $this->authorize('create', Vacancy::class);

        return view('portfolio.vacancies.form', [
            'pageTitle' => 'Nova vaga',
            'submitLabel' => 'Criar vaga',
            'action' => route('dashboard.vacancies.store'),
            'method' => 'POST',
            'vacancy' => $this->buildVacancyDraftAction->make(),
        ]);
    }

    public function storeVacancy(StoreVacancyRequest $request): RedirectResponse
    {
        $this->authorize('create', Vacancy::class);

        $this->createVacancyAction->execute(VacancyData::fromValidated($request->validated()));

        return redirect()->route('dashboard.home')->with('dashboard_feedback', config('recruitment.vacancy.messages.created'));
    }

    public function editVacancy(Vacancy $vacancy): View
    {
        $this->authorize('update', $vacancy);

        return view('portfolio.vacancies.form', [
            'pageTitle' => 'Editar vaga',
            'submitLabel' => 'Salvar alteracoes',
            'action' => route('dashboard.vacancies.update', $vacancy),
            'method' => 'PUT',
            'vacancy' => $vacancy,
        ]);
    }

    public function updateVacancy(StoreVacancyRequest $request, Vacancy $vacancy): RedirectResponse
    {
        $this->authorize('update', $vacancy);

        $this->updateVacancyAction->execute($vacancy, VacancyData::fromValidated($request->validated()));

        return redirect()->route('dashboard.home')->with('dashboard_feedback', config('recruitment.vacancy.messages.updated'));
    }

    public function destroyVacancy(Vacancy $vacancy): RedirectResponse
    {
        $this->authorize('delete', $vacancy);

        $this->deleteVacancyAction->execute($vacancy);

        return redirect()->route('dashboard.home')->with('dashboard_feedback', config('recruitment.vacancy.messages.deleted'));
    }
}
