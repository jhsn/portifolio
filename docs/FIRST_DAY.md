# FIRST_DAY.md

## Objetivo
Checklist curto para deixar um projeto novo funcional no primeiro dia.

## Passos
1. criar o projeto Laravel
2. configurar `.env`
3. criar chave com `php artisan key:generate`
4. configurar banco
5. rodar `php artisan migrate`
6. rodar `npm install`
7. rodar `npm run build`
8. rodar `php artisan test`
9. abrir com `php artisan serve`

## Se for usar este esqueleto
1. copiar os arquivos base
2. revisar configs antes de sobrescrever
3. manter `AGENTS.md` generico
4. comecar `LEARNING.md` logo no inicio

## Validacao minima
- home abrindo
- login abrindo
- build sem erro
- testes passando
