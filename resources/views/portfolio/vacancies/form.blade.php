@extends('layouts.admin')

@section('title', $pageTitle . ' | Atlas Recruta')
@section('page_title', $pageTitle)

@section('content')
    <div class="row justify-content-center">
        <div class="col-12 col-xl-10">
            <div class="card shadow-sm border-0">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title mb-0">Dados da vaga</h3>
                    <a href="{{ route('dashboard.home') }}" class="btn btn-outline-secondary btn-sm">Voltar</a>
                </div>
                <form method="POST" action="{{ $action }}">
                    @csrf
                    @if ($method !== 'POST')
                        @method($method)
                    @endif

                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-12 col-lg-6">
                                <label for="title" class="form-label">Titulo *</label>
                                <input type="text" id="title" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $vacancy->title) }}" required>
                                @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-12 col-lg-6">
                                <label for="company" class="form-label">Empresa *</label>
                                <input type="text" id="company" name="company" class="form-control @error('company') is-invalid @enderror" value="{{ old('company', $vacancy->company) }}" required>
                                @error('company')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-12 col-lg-4">
                                <label for="location" class="form-label">Localizacao *</label>
                                <input type="text" id="location" name="location" class="form-control @error('location') is-invalid @enderror" value="{{ old('location', $vacancy->location) }}" required>
                                @error('location')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-12 col-lg-4">
                                <label for="work_model" class="form-label">Modelo de trabalho *</label>
                                <select id="work_model" name="work_model" class="form-select @error('work_model') is-invalid @enderror" required>
                                    @foreach (['Remoto', 'Hibrido', 'Presencial'] as $option)
                                        <option value="{{ $option }}" @selected(old('work_model', $vacancy->work_model) === $option)>{{ $option }}</option>
                                    @endforeach
                                </select>
                                @error('work_model')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-12 col-lg-4">
                                <label for="contract_type" class="form-label">Contrato *</label>
                                <select id="contract_type" name="contract_type" class="form-select @error('contract_type') is-invalid @enderror" required>
                                    @foreach (['CLT', 'PJ', 'Estagio', 'Freelance'] as $option)
                                        <option value="{{ $option }}" @selected(old('contract_type', $vacancy->contract_type) === $option)>{{ $option }}</option>
                                    @endforeach
                                </select>
                                @error('contract_type')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-12 col-lg-6">
                                <label for="salary_range" class="form-label">Faixa salarial</label>
                                <input type="text" id="salary_range" name="salary_range" class="form-control @error('salary_range') is-invalid @enderror" value="{{ old('salary_range', $vacancy->salary_range) }}">
                                @error('salary_range')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-12 col-lg-6">
                                <label for="published_at" class="form-label">Data de publicacao</label>
                                <input type="datetime-local" id="published_at" name="published_at" class="form-control @error('published_at') is-invalid @enderror" value="{{ old('published_at', $vacancy->published_at?->format('Y-m-d\TH:i')) }}">
                                @error('published_at')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-12">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch" id="is_published" name="is_published" value="1" @checked(old('is_published', $vacancy->is_published))>
                                    <label class="form-check-label" for="is_published">Publicar esta vaga no portal</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <label for="summary" class="form-label">Resumo *</label>
                                <textarea id="summary" name="summary" rows="3" class="form-control @error('summary') is-invalid @enderror" required>{{ old('summary', $vacancy->summary) }}</textarea>
                                @error('summary')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-12">
                                <label for="description" class="form-label">Descricao *</label>
                                <textarea id="description" name="description" rows="7" class="form-control @error('description') is-invalid @enderror" required>{{ old('description', $vacancy->description) }}</textarea>
                                @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-12 col-lg-6">
                                <label for="requirements" class="form-label">Requisitos</label>
                                <textarea id="requirements" name="requirements" rows="7" class="form-control @error('requirements') is-invalid @enderror" placeholder="Um item por linha">{{ old('requirements', collect($vacancy->requirements ?? [])->implode("\n")) }}</textarea>
                                @error('requirements')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-12 col-lg-6">
                                <label for="benefits" class="form-label">Beneficios</label>
                                <textarea id="benefits" name="benefits" rows="7" class="form-control @error('benefits') is-invalid @enderror" placeholder="Um item por linha">{{ old('benefits', collect($vacancy->benefits ?? [])->implode("\n")) }}</textarea>
                                @error('benefits')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>

                    <div class="card-footer d-flex justify-content-end gap-2">
                        <a href="{{ route('dashboard.home') }}" class="btn btn-outline-secondary">Cancelar</a>
                        <button type="submit" class="btn btn-primary">{{ $submitLabel }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection