<p align="center">
    <img width="400" alt="Votus Logo" src="https://github.com/user-attachments/assets/391c325b-9cb0-4998-a657-c7f587cbefa9" />
</p>

<p align="center"> 
    <img loading="lazy" src="http://img.shields.io/static/v1?label=STATUS&message=EM%20DESENVOLVIMENTO&color=FFDE21&style=for-the-badge"/> 
</p>

## Sobre o projeto

O **Votus** é um sistema de transparência política desenvolvido para o **Ceará Científico 2026**. Ele monitora deputados e senadores do Ceará, cruzando o discurso público deles com suas ações reais por meio de um **Índice de Confiabilidade** (percentual de coerência legislativa) e uma aba de notícias .

O projeto será dividido em múltiplos repositórios. Portanto, este repositório é dedicado especificamente ao **módulo do Perfil Parlamentar**, sendo responsável por integrar e exibir:
* Histórico político do parlamentar;
* Segmentos e áreas de atuação declaradas;
* Dados e trajetórias legislativas.

## 🚀 Começando

Essas instruções permitirão que você obtenha uma cópia do projeto em operação na sua máquina local para fins de desenvolvimento e teste.

### 📋 Pré-requisitos

* PHP 8.3+
* Composer

### 🔧 Instalação
 
1. Clone o repositório e instale as dependências:
 
```bash
git clone https://github.com/NotCrazyDog-hub/votus-api-laravel.git
```
```bash
cd votus-api-laravel
```
```bash
composer install
```
 
2. Preencha as credenciais no `.env`:

```bash
cp .env.example .env
```
```bash
php artisan key:generate
```

Descomente as linhas de código abaixo e preencha as variáveis conforme às credenciais do seu ambiente

```env
DB_CONNECTION=sqlite
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=laravel
# DB_USERNAME=root
# DB_PASSWORD=
```

Rode o comando artisan abaixo no terminal para gerar uma string de segurança

```bash
php artisan tinker --execute="echo Str::random(40);"
```

Em seguida, copie o resultado e cole na variável "SCHEDULER_TOKEN" do .env

2. Rode as migrations e sincronize os dados:
 
```bash
php artisan migrate
```
```bash
php artisan sync:legislators-lower-house && php artisan sync:committees-lower-house && php artisan sync:legislators-senate && php artisan sync:committees-senate && php artisan sync:bills-lower-house && php artisan sync:bills-senate
```
```bash
php artisan serve
```
 
A API estará disponível em `http://localhost:8000`.
 
## 📡 Endpoints
 
```
GET /api/deputies                    Lista deputados federais
GET /api/deputies/{external_id}      Perfil de um deputado
GET /api/senators                    Lista senadores
GET /api/senators/{external_id}      Perfil de um senador
GET /api/schedule/status             Dispara o Laravel Scheduler via HTTP
```

## 🔄 Sincronização de dados
 
Os dados são sincronizados semanalmente via Laravel Scheduler, a partir das APIs públicas:
 
* **Câmara dos Deputados:** `dadosabertos.camara.leg.br/api/v2`
* **Senado Federal:** `legis.senado.leg.br/dadosabertos`

Para sincronizar manualmente:
 
```bash
php artisan sync:legislators-lower-house
```
```bash
php artisan sync:committees-lower-house
```
```bash
php artisan sync:bills-lower-house
```
```bash
php artisan sync:legislators-senate
```
```bash
php artisan sync:committees-senate
```
```bash
php artisan sync:bills-senate
```

## 🛠️ Stack
 
* [Laravel](https://laravel.com) - API Backend
* [Supabase](https://supabase.com) - Banco de dados PostgreSQL
* [Render](https://render.com/) - Deploy
* [cron-job.org](https://cron-job.org/en/) - Disparo das tarefas agendadas com Cron

 ## 📁 Estrutura do projeto
 
```
app/
  Console/Commands/
    SyncLowerHouseBills.php         Sincroniza proposições de deputados
    SyncLowerHouseCommittees.php    Sincroniza comissões de deputados
    SyncLowerHouseLegislators.php   Sincroniza deputados federais
    SyncSenateBills.php             Sincroniza proposições de senadores
    SyncSenateCommittees.php        Sincroniza comissões de senadores
    SyncSenateLegislators.php       Sincroniza senadores
  Enums/
    LegislatorStatus.php            active | on_leave | unknown
    ElectoralStatus.php             sitting | alternate | unknown
  Http/Controllers/
    LegislatorController.php        Endpoints da API
    SchedulerController.php         Execução de tarefas agendadas via HTTP
  Http/Resources/
    LegislatorResource.php          Formata os campos expostos na API
Models/
  Bill.php                        Model de proposições
  Committee.php                   Model de comissões parlamentares
  Legislator.php                  Model da tabela legislators
Services/
  LowerHouseApiService.php        Comunicação com API da Câmara
  SenateApiService.php            Comunicação com API do Senado
  LegislatorService.php           Queries no banco de dados
```

---

~ Equipe de desenvolvimento do Votus
