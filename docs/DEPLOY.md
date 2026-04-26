# DEPLOY.md

## Fluxo recomendado
1. validar localmente
2. gerar build
3. subir codigo
4. aplicar migrations
5. limpar e recachear
6. validar fluxo principal

## Checklist rapido
- `php artisan test`
- `npm run build`
- `php artisan migrate --force`
- `php artisan optimize:clear`
- `php artisan config:cache`
- `php artisan route:cache`
- `php artisan view:cache`

## Cuidados
- nao sobrescrever `.env`
- nao apagar uploads
- nao subir cache local
- preservar arquivos publicos gerados pelo usuario
