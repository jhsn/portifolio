@extends('layouts.admin')

@section('title', 'Painel Atlas | Atlas Recruta')
@section('page_title', 'Visao geral')

@section('content')
    <div class="row g-3 mb-4">
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="small-box text-bg-primary shadow-sm">
                <div class="inner">
                    <h3>{{ $stats['vacancies'] }}</h3>
                    <p>Vagas abertas</p>
                </div>
                <div class="small-box-icon"><i class="bi bi-briefcase"></i></div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="small-box text-bg-success shadow-sm">
                <div class="inner">
                    <h3>{{ $stats['applications'] }}</h3>
                    <p>Candidaturas totais</p>
                </div>
                <div class="small-box-icon"><i class="bi bi-send-check"></i></div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="small-box text-bg-warning shadow-sm">
                <div class="inner">
                    <h3>{{ $stats['new_applications'] }}</h3>
                    <p>Novas entradas</p>
                </div>
                <div class="small-box-icon"><i class="bi bi-lightning-charge"></i></div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="small-box text-bg-dark shadow-sm">
                <div class="inner">
                    <h3>{{ $stats['companies'] }}</h3>
                    <p>Empresas ativas</p>
                </div>
                <div class="small-box-icon"><i class="bi bi-buildings"></i></div>
            </div>
        </div>
    </div>

    <div class="row g-3">
        <div class="col-12 col-xl-8">
            <div class="card shadow-sm border-0">
                <div class="card-header d-flex justify-content-between align-items-center gap-2 flex-wrap">
                    <h3 class="card-title mb-0">Vagas</h3>
                    <div class="d-flex gap-2">
                        <a href="{{ route('home') }}" class="btn btn-outline-secondary btn-sm">Abrir portal</a>
                        <a href="{{ route('dashboard.vacancies.create') }}" class="btn btn-primary btn-sm">Nova vaga</a>
                    </div>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover align-middle mb-0">
                        <thead>
                            <tr>
                                <th>Vaga</th>
                                <th>Empresa</th>
                                <th>Modelo</th>
                                <th>Candidaturas</th>
                                <th class="text-end">Acoes</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($vacancies as $vacancy)
                                <tr>
                                    <td>
                                        <strong>{{ $vacancy->title }}</strong>
                                        <div class="text-muted small">{{ $vacancy->location }}</div>
                                    </td>
                                    <td>{{ $vacancy->company }}</td>
                                    <td><span class="badge text-bg-light">{{ $vacancy->work_model }}</span></td>
                                    <td>{{ $vacancy->applications_count }}</td>
                                    <td class="text-end">
                                        <div class="d-inline-flex flex-wrap justify-content-end gap-2">
                                            <a href="{{ route('vacancies.show', $vacancy) }}" class="btn btn-outline-secondary btn-xs">Ver</a>
                                            <a href="{{ route('dashboard.vacancies.edit', $vacancy) }}" class="btn btn-outline-primary btn-xs">Editar</a>
                                            <form method="POST" action="{{ route('dashboard.vacancies.destroy', $vacancy) }}" onsubmit="return confirm('Deseja remover esta vaga?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-outline-danger btn-xs">Excluir</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-4 text-muted">Nenhuma vaga cadastrada ainda.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-12 col-xl-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header">
                    <h3 class="card-title mb-0">Candidaturas recentes</h3>
                </div>
                <div class="card-body d-grid gap-3">
                    @forelse ($applications as $application)
                        <div class="admin-application-card">
                            <div class="d-flex justify-content-between gap-3 align-items-start">
                                <div>
                                    <strong>{{ $application->name }}</strong>
                                    <div class="text-muted small">{{ $application->vacancy?->title }}</div>
                                </div>
                                <span class="badge rounded-pill text-bg-secondary">{{ config('recruitment.application.status_labels.' . $application->status, $application->status) }}</span>
                            </div>
                            <div class="small text-muted mt-2">{{ $application->email }}</div>
                            <div class="admin-application-meta">
                                <a href="{{ route('dashboard.applications.show', $application) }}" class="btn btn-outline-secondary btn-xs">Abrir ficha</a>
                                @if ($application->resume_path)
                                    <a href="{{ route('dashboard.applications.resume', $application) }}" class="btn btn-outline-primary btn-xs">Baixar curriculo</a>
                                @else
                                    <span class="badge text-bg-light">Sem curriculo</span>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="text-muted small">As candidaturas aparecerao aqui assim que o portal comecar a receber novos perfis.</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection
