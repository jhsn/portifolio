@extends('layouts.admin')

@section('title', 'Candidatura | Atlas Recruta')
@section('page_title', 'Ficha da candidatura')

@section('content')
    <div class="row g-3">
        <div class="col-12 col-xl-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title mb-0">Candidato</h3>
                    <span class="badge rounded-pill text-bg-secondary">{{ $statusOptions[$application->status] ?? $application->status }}</span>
                </div>
                <div class="card-body d-grid gap-3">
                    <div>
                        <div class="text-muted small">Nome</div>
                        <strong>{{ $application->name }}</strong>
                    </div>
                    <div>
                        <div class="text-muted small">E-mail</div>
                        <span>{{ $application->email }}</span>
                    </div>
                    <div>
                        <div class="text-muted small">Telefone</div>
                        <span>{{ $application->phone }}</span>
                    </div>
                    <div>
                        <div class="text-muted small">LinkedIn</div>
                        @if ($application->linkedin_url)
                            <a href="{{ $application->linkedin_url }}" target="_blank" rel="noreferrer">Abrir perfil</a>
                        @else
                            <span class="text-muted">Nao informado</span>
                        @endif
                    </div>
                    <div>
                        <div class="text-muted small">Portfolio / GitHub</div>
                        @if ($application->portfolio_url)
                            <a href="{{ $application->portfolio_url }}" target="_blank" rel="noreferrer">Abrir link</a>
                        @else
                            <span class="text-muted">Nao informado</span>
                        @endif
                    </div>
                    <div>
                        <div class="text-muted small">Curriculo</div>
                        @if ($application->resume_path)
                            <a href="{{ route('dashboard.applications.resume', $application) }}" class="btn btn-outline-primary btn-sm mt-2">Baixar curriculo</a>
                        @else
                            <span class="text-muted">Nenhum arquivo anexado</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-xl-8">
            <div class="card shadow-sm border-0 mb-3">
                <div class="card-header">
                    <h3 class="card-title mb-0">Oportunidade</h3>
                </div>
                <div class="card-body application-summary-grid">
                    <div>
                        <div class="text-muted small">Vaga</div>
                        <strong>{{ $application->vacancy?->title }}</strong>
                    </div>
                    <div>
                        <div class="text-muted small">Empresa</div>
                        <span>{{ $application->vacancy?->company }}</span>
                    </div>
                    <div>
                        <div class="text-muted small">Localizacao</div>
                        <span>{{ $application->vacancy?->location }}</span>
                    </div>
                    <div>
                        <div class="text-muted small">Modelo</div>
                        <span>{{ $application->vacancy?->work_model }}</span>
                    </div>
                </div>
            </div>

            <div class="card shadow-sm border-0 mb-3">
                <div class="card-header">
                    <h3 class="card-title mb-0">Apresentacao</h3>
                </div>
                <div class="card-body">
                    <p class="mb-0 application-cover-letter">{{ $application->cover_letter }}</p>
                </div>
            </div>

            <div class="card shadow-sm border-0">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title mb-0">Triagem interna</h3>
                    <a href="{{ route('dashboard.home') }}" class="btn btn-outline-secondary btn-sm">Voltar ao painel</a>
                </div>
                <form method="POST" action="{{ route('dashboard.applications.update', $application) }}">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-12 col-lg-4">
                                <label for="status" class="form-label">Status *</label>
                                <select id="status" name="status" class="form-select @error('status') is-invalid @enderror" required>
                                    @foreach ($statusOptions as $value => $label)
                                        <option value="{{ $value }}" @selected(old('status', $application->status) === $value)>{{ $label }}</option>
                                    @endforeach
                                </select>
                                @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-12">
                                <label for="notes" class="form-label">Observacoes internas</label>
                                <textarea id="notes" name="notes" rows="8" class="form-control @error('notes') is-invalid @enderror" placeholder="Ex.: perfil com boa base em Laravel, comunicacao clara e aderencia para seguir para entrevista.">{{ old('notes', $application->notes) }}</textarea>
                                @error('notes')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">Salvar avaliacao</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection