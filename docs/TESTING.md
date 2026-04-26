# TESTING.md

## Validacao minima por rodada
- `php artisan test`
- `php artisan view:cache`
- `npm run build`

## Quando usar PHPStan
- antes de encerrar refatoracoes
- depois de alterar services, providers, controllers e componentes reativos

Comando sugerido:
- `vendor/bin/phpstan analyse --memory-limit=1G`

## Quando usar Playwright
- smoke publico
- fluxos autenticados criticos
- preview visual de telas importantes

## Boa pratica
- seeds tecnicos de E2E devem ser idempotentes
- testes HTTP nao devem depender de ambiente inseguro ou variavel
