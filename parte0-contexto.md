# ORION — CONTEXTO GERAL DO PROJETO

> **LEIA ESTE ARQUIVO PRIMEIRO.** Ele contém o contexto geral do projeto. Depois, leia o arquivo da parte específica que eu pedir para desenvolver.

---

## O QUE É O ORION

O ORION é um sistema web completo de **gestão de pessoas e processos para operações complexas**, inspirado no sistema DRAKE da Sapiensia Tecnologia. É voltado principalmente para o setor **offshore (petróleo e gás)**, mas adaptável a mineração, navegação, ferrovias e outras indústrias com escalas de trabalho contínuas.

O sistema gerencia: escalas de embarque, trocas de turma, logística de colaboradores, treinamentos, compliance de documentos e qualificações, controle de POB (People On Board), recursos humanos, fornecedores terceirizados, e toda a operação com dashboards e relatórios.

---

## STACK TECNOLÓGICA (OBRIGATÓRIA)

- **PHP 8.2+** com **Laravel 11**
- **MySQL 8.0+**
- **Livewire 3** para componentes reativos
- **Blade Templates** para views
- **Tailwind CSS 3** para estilização
- **Alpine.js** para interações leves no frontend
- **Spatie Laravel Permission** para RBAC (roles e permissions)
- **Spatie Laravel Activitylog** para audit log
- **DomPDF** (barryvdh/laravel-dompdf) para relatórios PDF
- **Laravel Excel** (maatwebsite/excel) para exportação Excel
- **Chart.js** para gráficos nos dashboards
- **FullCalendar.js** para visualização de escalas em calendário
- **Docker + Docker Compose** (PHP-FPM + Nginx + MySQL + Redis + Mailhog)
- **Laravel Queue** com driver database ou Redis para jobs assíncronos
- **Laravel Mail** com SMTP configurável para emails
- **Laravel Storage** para upload de arquivos

---

## MULTI-TENANCY

O sistema é **multi-tenant por coluna**. Todas as tabelas principais têm `company_id`. Cada empresa vê apenas seus dados.

Implementar um **Global Scope** automático:

```php
// app/Scopes/CompanyScope.php
class CompanyScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        if (auth()->check()) {
            $builder->where($model->getTable() . '.company_id', auth()->user()->company_id);
        }
    }
}

// Trait para usar nos Models
trait BelongsToCompany
{
    protected static function bootBelongsToCompany()
    {
        static::addGlobalScope(new CompanyScope);

        static::creating(function ($model) {
            if (auth()->check()) {
                $model->company_id = auth()->user()->company_id;
            }
        });
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
```

---

## PADRÕES DE CÓDIGO (SEGUIR EM TODAS AS PARTES)

### Arquitetura
- **Controllers magros**: apenas recebem request, chamam Service, retornam response
- **Service Layer**: toda lógica de negócio em `app/Services/`
- **Form Requests**: toda validação em classes Request em `app/Http/Requests/`
- **Policies**: toda autorização em `app/Policies/`
- **Observers**: para audit log e side effects em `app/Observers/`
- **Enums PHP 8.2**: para status, tipos e constantes em `app/Enums/`

### Banco de Dados
- Migrations com foreign keys, indexes e soft deletes onde apropriado
- Eloquent Relationships completos em todos os Models
- Factories e Seeders para dados de demonstração

### Frontend
- Blade Components reutilizáveis em `resources/views/components/`
- Componentes Livewire para interatividade (busca, filtros, formulários dinâmicos)
- Tailwind CSS com classes responsivas (sm:, md:, lg:)
- Alpine.js para interações pontuais (modais, dropdowns, toggles)
- Tema claro/escuro com toggle

### Segurança
- CSRF em todos os formulários
- Sanitização de inputs
- Rate limiting no login
- Middleware de autorização em todas as rotas
- Soft deletes (nunca deletar dados fisicamente)

---

## ESTRUTURA DE PASTAS DO PROJETO

```
orion/
├── docker-compose.yml
├── Dockerfile
├── nginx/default.conf
├── app/
│   ├── Enums/
│   ├── Events/
│   ├── Exports/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/
│   │   │   ├── Portal/
│   │   │   └── Supplier/
│   │   ├── Livewire/
│   │   ├── Middleware/
│   │   └── Requests/
│   ├── Jobs/
│   ├── Listeners/
│   ├── Models/
│   ├── Notifications/
│   ├── Observers/
│   ├── Policies/
│   ├── Scopes/
│   └── Services/
├── database/
│   ├── factories/
│   ├── migrations/
│   └── seeders/
├── resources/views/
│   ├── admin/
│   ├── auth/
│   ├── components/
│   ├── emails/
│   ├── layouts/
│   ├── portal/
│   └── supplier/
├── routes/
│   ├── web.php
│   └── api.php
├── config/
├── tests/
└── .env.example
```

---

## REGRA DE OURO PARA TODAS AS PARTES

### ⚠️ SÓ ME ENTREGUE QUANDO ESTIVER FUNCIONAL

Para CADA parte que eu pedir para desenvolver, você DEVE:

1. **Desenvolver** todos os arquivos solicitados (migrations, models, controllers, services, views, routes, etc.)
2. **Executar e testar** tudo antes de me entregar:
   - Rodar as migrations (`php artisan migrate`)
   - Rodar os seeders (`php artisan db:seed`)
   - Verificar que as rotas existem (`php artisan route:list`)
   - Testar no navegador que as páginas carregam sem erro
   - Testar que os CRUDs funcionam (criar, editar, listar, excluir)
   - Testar que as validações funcionam (submeter formulário vazio, dados inválidos)
   - Testar que as permissões funcionam (usuário sem permissão não acessa)
3. **Corrigir** qualquer erro encontrado nos testes
4. **Só então me entregar** confirmando: "Fase X concluída e testada. Tudo funcional."

Se algo não funcionar durante os testes, **corrija antes de me informar**. Eu não quero receber código com erros. Itere quantas vezes for necessário até tudo funcionar perfeitamente.

---

## LISTA DE PARTES

| Arquivo | Conteúdo |
|---------|----------|
| `parte0-contexto.md` | Este arquivo (contexto geral) |
| `parte1-setup.md` | Setup do projeto, Docker, configs, dependências |
| `parte2-auth.md` | Autenticação, RBAC, registro de empresa |
| `parte3-layout.md` | Layout admin, portal, componentes Blade base |
| `parte4-colaboradores.md` | Cadastro de colaboradores e documentos |
| `parte5-unidades-pob.md` | Unidades operacionais e controle de POB |
| `parte6-escalas.md` | Escalas de trabalho e trocas de turma |
| `parte7-compliance.md` | Compliance e matriz de qualificação |
| `parte8-treinamentos.md` | Treinamentos presenciais e EAD |
| `parte9-logistica.md` | Logística de colaboradores |
| `parte10-rh.md` | Recursos humanos, férias, timesheet |
| `parte11-operacoes.md` | Operações, custos, KPIs |
| `parte12-portal-colaborador.md` | Portal My ORION |
| `parte13-portal-fornecedor.md` | Portal iORION Suppliers |
| `parte14-comunicacao.md` | Mensagens e notificações |
| `parte15-dashboards.md` | Dashboards e relatórios |
| `parte16-seeds-testes.md` | Seeds completos, testes, documentação final |

---

## INSTRUÇÕES ESPECÍFICAS PARA O GITHUB COPILOT AGENT

Este projeto está sendo desenvolvido usando o **GitHub Copilot Coding Agent**. Siga estas diretrizes adicionais:

### Comunicação e Entrega
- Mantenha comunicação clara sobre o progresso de cada tarefa
- Use a função `report_progress` após completar unidades significativas de trabalho
- Documente qualquer desvio dos requisitos originais e explique os motivos
- Se encontrar bloqueios ou ambiguidades, peça esclarecimentos ao invés de fazer suposições

### Qualidade do Código
- Siga os padrões PSR-12 para PHP
- Use type hints em todos os métodos e propriedades (PHP 8.2+)
- Escreva código autodocumentado com nomes descritivos
- Adicione comentários apenas quando a lógica for complexa ou não óbvia
- Use strict types (`declare(strict_types=1);`) em todos os arquivos PHP

### Testes e Validação
- Execute os testes antes de reportar conclusão de tarefas
- Verifique logs de erro do Laravel (`storage/logs/laravel.log`)
- Teste todas as rotas e funcionalidades manualmente quando possível
- Valide que não há erros de sintaxe ou warnings PHP

### Segurança
- Nunca commitar credenciais ou dados sensíveis
- Use variáveis de ambiente (.env) para configurações sensíveis
- Implemente proteção CSRF em todos os formulários
- Valide e sanitize todas as entradas de usuário
- Use prepared statements (Eloquent) para todas as queries

### Performance
- Use eager loading para evitar N+1 queries
- Implemente cache quando apropriado
- Otimize queries complexas
- Use índices de banco de dados adequadamente

### Versionamento
- Faça commits atômicos e descritivos
- Use mensagens de commit em português claro
- Não inclua arquivos temporários ou de build nos commits
- Mantenha o .gitignore atualizado

---

## RECURSOS ÚTEIS

- [Documentação Laravel 11](https://laravel.com/docs/11.x)
- [Documentação Livewire 3](https://livewire.laravel.com/docs)
- [Documentação Tailwind CSS 3](https://tailwindcss.com/docs)
- [Spatie Laravel Permission](https://spatie.be/docs/laravel-permission/v6/introduction)
- [Laravel Best Practices](https://github.com/alexeymezenin/laravel-best-practices)

---

## DIAGRAMA CONCEITUAL DO SISTEMA

```
┌─────────────────────────────────────────────────────────────┐
│                      ORION SYSTEM                            │
├─────────────────────────────────────────────────────────────┤
│                                                               │
│  ┌──────────────┐  ┌──────────────┐  ┌──────────────┐      │
│  │   ADMIN      │  │  COLABORADOR │  │  FORNECEDOR  │      │
│  │   Portal     │  │   My ORION   │  │   iORION     │      │
│  └──────────────┘  └──────────────┘  └──────────────┘      │
│         │                  │                  │              │
│         └──────────────────┴──────────────────┘              │
│                           │                                  │
│         ┌─────────────────┴─────────────────┐               │
│         │                                     │               │
│    ┌────▼────┐                         ┌─────▼─────┐        │
│    │  AUTH   │                         │  CORE     │        │
│    │  RBAC   │                         │  MODULES  │        │
│    └─────────┘                         └───────────┘        │
│         │                                     │               │
│         │    ┌─────────────────────────────┐ │              │
│         └────┤   Colaboradores             ├─┘              │
│              ├─────────────────────────────┤                │
│              │   Escalas & POB             │                │
│              ├─────────────────────────────┤                │
│              │   Compliance & Docs         │                │
│              ├─────────────────────────────┤                │
│              │   Treinamentos              │                │
│              ├─────────────────────────────┤                │
│              │   Logística                 │                │
│              ├─────────────────────────────┤                │
│              │   RH & Timesheet            │                │
│              ├─────────────────────────────┤                │
│              │   Operações & KPIs          │                │
│              ├─────────────────────────────┤                │
│              │   Comunicação               │                │
│              ├─────────────────────────────┤                │
│              │   Dashboards & Reports      │                │
│              └─────────────────────────────┘                │
│                           │                                  │
│                    ┌──────▼──────┐                          │
│                    │  DATABASE   │                          │
│                    │  (MySQL)    │                          │
│                    └─────────────┘                          │
│                                                               │
└─────────────────────────────────────────────────────────────┘
```

---

## FLUXO BÁSICO DE TRABALHO

1. **Leia este arquivo (parte0-contexto.md)** para entender o contexto geral
2. **Leia o arquivo da parte específica** que foi solicitada
3. **Desenvolva todos os componentes** listados na parte
4. **Execute os testes** e valide que tudo funciona
5. **Corrija quaisquer erros** encontrados
6. **Reporte o progresso** usando `report_progress`
7. **Confirme a conclusão** da parte

---

## NOTAS FINAIS

- Este é um projeto educacional baseado no sistema DRAKE real
- O foco é criar um sistema funcional e bem estruturado
- Priorize qualidade sobre velocidade
- Quando em dúvida, pergunte antes de implementar
- Mantenha o código limpo, organizado e bem documentado

**Boa sorte e bom desenvolvimento!** 🚀
