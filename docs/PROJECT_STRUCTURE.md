# PROJECT_STRUCTURE.md

## Estrutura recomendada

### Backend
- `app/Http/Controllers`: controle de fluxo HTTP
- `app/Services`: regra de negocio reutilizavel
- `app/Livewire`: componentes reativos quando houver ganho real
- `app/Models`: entidades e relacoes

### Front-end
- `resources/views`: blades
- `resources/js/views`: comportamento especifico por tela
- `resources/css/views`: estilo especifico por tela
- `resources/js/app.js`: base global
- `resources/css/app.css`: base global

### Testes
- `tests/Unit`: regra isolada
- `tests/Feature`: fluxo HTTP e tela
- `tests/e2e`: smoke e navegacao real

### Suporte
- `scripts`: automacoes locais
- `docs`: manuais e referencias

## Regra de ouro
- o que for especifico de tela fica na tela
- o que for global fica no global
- o que for regra de negocio nao fica na view
