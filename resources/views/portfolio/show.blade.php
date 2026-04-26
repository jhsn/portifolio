<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $vacancy->title }} | Atlas Recruta</title>
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/css/views/portfolio/show.css'])
</head>
<body class="portfolio-page">
    <main class="portfolio-shell portfolio-shell-detail">
        <a href="{{ route('home') }}" class="back-link">Voltar para vagas</a>
        <section class="detail-hero">
            <div>
                <span class="eyebrow">{{ $vacancy->company }}</span>
                <h1>{{ $vacancy->title }}</h1>
                <p>{{ $vacancy->summary }}</p>
                <ul class="tag-list">
                    <li>{{ $vacancy->location }}</li>
                    <li>{{ $vacancy->work_model }}</li>
                    <li>{{ $vacancy->contract_type }}</li>
                    @if ($vacancy->salary_range)<li>{{ $vacancy->salary_range }}</li>@endif
                </ul>
            </div>
            <aside class="detail-highlight">
                <strong>Publicada em {{ $vacancy->published_at?->format('d/m/Y') }}</strong>
                <span>Triagem interna com leitura de perfil, observacoes e acompanhamento do processo em uma unica fila.</span>
            </aside>
        </section>
        @if (session('application_success'))
            <div class="feedback-success">{{ session('application_success') }}</div>
        @endif
        <section class="detail-grid">
            <article class="panel-card">
                <h2>Sobre a oportunidade</h2>
                <p>{{ $vacancy->description }}</p>
                <h3>Requisitos</h3>
                <ul class="content-list">
                    @foreach ($vacancy->requirements ?? [] as $requirement)
                        <li>{{ $requirement }}</li>
                    @endforeach
                </ul>
                <h3>Beneficios e destaques</h3>
                <ul class="content-list">
                    @foreach ($vacancy->benefits ?? [] as $benefit)
                        <li>{{ $benefit }}</li>
                    @endforeach
                </ul>
            </article>
            <aside class="panel-card">
                <h2>Candidatar-se</h2>
                <p>Preencha seus dados, conte um pouco da sua experiencia e, se fizer sentido, anexe o curriculo para acelerar a avaliacao.</p>
                <form method="POST" action="{{ route('vacancies.apply', $vacancy) }}" class="application-form" enctype="multipart/form-data">
                    @csrf
                    <div><label for="name">Nome *</label><input id="name" name="name" type="text" value="{{ old('name') }}">@error('name')<small class="field-error">{{ $message }}</small>@enderror</div>
                    <div><label for="email">E-mail *</label><input id="email" name="email" type="email" value="{{ old('email') }}">@error('email')<small class="field-error">{{ $message }}</small>@enderror</div>
                    <div><label for="phone">Telefone *</label><input id="phone" name="phone" type="text" value="{{ old('phone') }}">@error('phone')<small class="field-error">{{ $message }}</small>@enderror</div>
                    <div><label for="linkedin_url">LinkedIn</label><input id="linkedin_url" name="linkedin_url" type="url" value="{{ old('linkedin_url') }}">@error('linkedin_url')<small class="field-error">{{ $message }}</small>@enderror</div>
                    <div><label for="portfolio_url">GitHub ou portfolio</label><input id="portfolio_url" name="portfolio_url" type="url" value="{{ old('portfolio_url') }}">@error('portfolio_url')<small class="field-error">{{ $message }}</small>@enderror</div>
                    <div>
                        <label for="resume">Curriculo</label>
                        <input id="resume" name="resume" type="file" accept=".pdf,.doc,.docx">
                        <small class="field-hint">Aceita PDF, DOC ou DOCX com ate 3 MB.</small>
                        @error('resume')<small class="field-error">{{ $message }}</small>@enderror
                    </div>
                    <div><label for="cover_letter">Apresentacao *</label><textarea id="cover_letter" name="cover_letter" rows="6">{{ old('cover_letter') }}</textarea>@error('cover_letter')<small class="field-error">{{ $message }}</small>@enderror</div>
                    <button type="submit" class="button button-primary">Enviar candidatura</button>
                </form>
            </aside>
        </section>
        @if ($relatedVacancies->isNotEmpty())
            <section class="related-section">
                <div class="section-header"><h2>Outras vagas abertas</h2><a href="{{ route('home') }}">ver todas</a></div>
                <div class="vacancy-grid compact-grid">
                    @foreach ($relatedVacancies as $relatedVacancy)
                        <article class="vacancy-card">
                            <div class="vacancy-meta"><span>{{ $relatedVacancy->company }}</span><span>{{ $relatedVacancy->location }}</span></div>
                            <h3>{{ $relatedVacancy->title }}</h3>
                            <p>{{ $relatedVacancy->summary }}</p>
                            <a href="{{ route('vacancies.show', $relatedVacancy) }}" class="button button-secondary">Abrir vaga</a>
                        </article>
                    @endforeach
                </div>
            </section>
        @endif
    </main>
</body>
</html>