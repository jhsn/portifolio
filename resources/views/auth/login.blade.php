<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Acesso interno | Atlas Recruta</title>
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/css/views/auth/login.css'])
</head>
<body class="portfolio-page auth-page">
    <main class="auth-shell">
        <section class="auth-card">
            <div>
                <span class="eyebrow">Acesso interno</span>
                <h1>Entrar no painel da Atlas Recruta</h1>
                <p>Este acesso protege a operacao interna de triagem, acompanhamento de vagas e avaliacao das candidaturas recebidas pelo portal.</p>
                <div class="auth-demo-box">
                    <strong>Conta tecnica local</strong>
                    <span>E-mail: admin@atlasrecruta.test</span>
                    <span>Senha: password</span>
                </div>
            </div>
            <form method="POST" action="{{ route('login.store') }}" class="auth-form">
                @csrf
                <div>
                    <label for="email">E-mail *</label>
                    <input id="email" name="email" type="email" value="{{ old('email', 'admin@atlasrecruta.test') }}" required>
                    @error('email')<small class="field-error">{{ $message }}</small>@enderror
                </div>
                <div>
                    <label for="password">Senha *</label>
                    <input id="password" name="password" type="password" value="password" required>
                    @error('password')<small class="field-error">{{ $message }}</small>@enderror
                </div>
                <label class="remember-row"><input type="checkbox" name="remember" value="1"> Manter conectado neste navegador</label>
                <button type="submit" class="button button-primary">Entrar no painel</button>
                <a href="{{ route('home') }}" class="button button-secondary">Voltar para vagas</a>
            </form>
        </section>
    </main>
</body>
</html>