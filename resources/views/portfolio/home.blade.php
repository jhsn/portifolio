<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Atlas Recruta | Vagas de tecnologia</title>
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/views/portfolio/home.js', 'resources/css/views/portfolio/home.css'])
</head>
<body class="portfolio-page">
    <main class="portfolio-shell">
        <section class="hero-card">
            <div class="hero-copy">
                <span class="eyebrow">Recrutamento tech com processo claro</span>
                <h1>Vagas de tecnologia com informacao objetiva, candidatura simples e triagem organizada.</h1>
                <p>A Atlas Recruta conecta profissionais de produto, engenharia e operacao a empresas que valorizam clareza no processo seletivo. Aqui voce encontra oportunidades reais, entende o contexto da vaga e se candidata sem friccao.</p>
                <div class="hero-actions">
                    <a href="#vagas" class="button button-primary">Ver vagas abertas</a>
                    @auth
                        <a href="{{ route('dashboard.home') }}" class="button button-secondary">Abrir painel</a>
                    @else
                        <a href="{{ route('login') }}" class="button button-secondary">Acesso interno</a>
                    @endauth
                </div>
                <div class="hero-proof">
                    <span>Foco em tecnologia</span>
                    <span>Curriculo opcional</span>
                    <span>Retaguarda organizada</span>
                </div>
            </div>
            <div class="hero-side">
                <div class="stats-grid">
                    <article class="stat-card stat-card-primary"><strong>{{ $stats['vacancies'] }}</strong><span>vagas abertas</span></article>
                    <article class="stat-card"><strong>{{ $stats['applications'] }}</strong><span>candidaturas recebidas</span></article>
                    <article class="stat-card"><strong>{{ $stats['companies'] }}</strong><span>empresas ativas</span></article>
                    <article class="stat-card"><strong>{{ $stats['new_applications'] }}</strong><span>novas entradas</span></article>
                </div>
            </div>
        </section>

        <section class="capability-grid">
            <article class="capability-card">
                <strong>Busca direta</strong>
                <p>Filtre por stack, localidade ou formato de trabalho sem passar por uma navegacao cansativa.</p>
            </article>
            <article class="capability-card">
                <strong>Candidatura rapida</strong>
                <p>Abra a vaga, entenda o contexto e envie seus dados no mesmo fluxo, com opcao de anexar curriculo.</p>
            </article>
            <article class="capability-card">
                <strong>Triagem consistente</strong>
                <p>O time interno acompanha status, observacoes e curriculos em um painel focado na operacao.</p>
            </article>
        </section>

        <section class="search-card" id="vagas">
            <div class="search-heading">
                <div>
                    <span class="eyebrow eyebrow-soft">Oportunidades abertas</span>
                    <h2>Escolha uma vaga alinhada ao seu momento tecnico e profissional.</h2>
                </div>
                <p>Use a busca para encontrar oportunidades por stack, formato de trabalho ou localidade.</p>
            </div>
            <form method="GET" action="{{ route('home') }}" class="search-form">
                <label for="search">Buscar vaga</label>
                <div class="search-row">
                    <input id="search" type="text" name="search" value="{{ $search }}" placeholder="Ex.: laravel, remoto, produto, campinas">
                    <button type="submit" class="button button-primary">Filtrar</button>
                </div>
            </form>
        </section>

        <section class="vacancy-grid">
            @forelse ($vacancies as $vacancy)
                <article class="vacancy-card">
                    <div class="vacancy-meta"><span>{{ $vacancy->company }}</span><span>{{ $vacancy->published_at?->format('d/m/Y') }}</span></div>
                    <h2>{{ $vacancy->title }}</h2>
                    <p>{{ $vacancy->summary }}</p>
                    <ul class="tag-list">
                        <li>{{ $vacancy->location }}</li>
                        <li>{{ $vacancy->work_model }}</li>
                        <li>{{ $vacancy->contract_type }}</li>
                        @if ($vacancy->salary_range)<li>{{ $vacancy->salary_range }}</li>@endif
                    </ul>
                    <a href="{{ route('vacancies.show', $vacancy) }}" class="button button-secondary">Ver detalhes</a>
                </article>
            @empty
                <article class="empty-card">
                    <strong>Nenhuma vaga encontrada.</strong>
                    <p>Tente outro termo de busca ou volte depois para conferir novas oportunidades da Atlas Recruta.</p>
                </article>
            @endforelse
        </section>
    </main>
</body>
</html>