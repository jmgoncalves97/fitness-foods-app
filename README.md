# FITNESS FOODS APP

This project imports and synchronizes data from Open Food Facts using two microservices: one to fetch and process data, and another to handle CRUD operations and store data.

## Architecture

```mermaid
graph TD
    OF[Open Food]
    subgraph SD[MS Sync Data]
        L[APP LARAVEL]
        R[Redis]
    end
    subgraph API[MS API]
        Y[API]
        P[POSTGRES]
    end
    OF --> |GET Data| SD
    SD --> |POST /import| API
```

## Running the project

```sh
docker compose up -d
```
```sh
docker compose exec sync-data php artisan queue:work
```
```sh
docker compose exec sync-data php artisan openfoodfacts:import
```