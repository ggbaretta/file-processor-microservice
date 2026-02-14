# CSV Import API

API Laravel para importação e processamento assíncrono de arquivos CSV utilizando filas.

## Requisitos

- PHP 8.2+
- Composer
- Node.js & NPM
- PostgreSQL

## Instalação

```bash
# Clonar e instalar dependências
composer setup
```

Ou manualmente:

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
npm install && npm run build
```

## Executando

```bash
# Inicia servidor, fila, logs e Vite simultaneamente
composer dev
```

Ou individualmente:

```bash
php artisan serve
php artisan queue:listen --tries=1
```

## Uso da API

### Importar CSV

```bash
POST /api/import
Content-Type: multipart/form-data

file: arquivo.csv
```

Resposta:
```json
{
  "message": "Arquivo em processamento!"
}
```

O arquivo CSV deve ter cabeçalho na primeira linha. Cada linha é processada de forma assíncrona via job na fila `imports`.

## Docker (Laravel Sail)

```bash
./vendor/bin/sail up -d
./vendor/bin/sail artisan migrate
./vendor/bin/sail artisan queue:work
```

## Estrutura Principal

```
app/
├── Http/Controllers/ImportController.php  # Endpoint de upload
├── Jobs/ProcessCsvLine.php                # Job de processamento
└── Services/FileProcessorService.php      # Leitura e dispatch do CSV
```

## Testes

```bash
composer test
```
