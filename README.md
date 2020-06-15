Model Wish corresponds the logic:

1. Entity could be: created, obtained or archived state.
2. State transition is coherently.
3. Entity not allowed for modification when is archived.
4. Entity title could be min 2 and max 256 length. 

## Install

1. `cp .env.example .env`
2. `composer install`
3. `php bin/console doctrine:migrations:migrate`
4. Make path `@projectPath/var/` writable

## Test

### Functional:
`./vendor/bin/phpunit tests/Functional`

### Unit:

`./vendor/bin/phpunit tests/Unit`

### Manual:

1. Make sure port 9000 and 80 are available
2. Make path `@projectPath/var/log/nginx` writable
3. `docker-compose up -d --build`

- Create

`curl -X POST http://localhost/wishes -d '{"title":"BMW","price":100}' -H 'application/json'`

- Get

`curl -X GET http://localhost/wishes/392c8b1b-cead-49c0-a17f-fa6db037ae07`

- Update

`curl -X PUT http://localhost/wishes/392c8b1b-cead-49c0-a17f-fa6db037ae07 -d '{"title":"Tesla", "price":200}' -H 'application/json'`

- Mark as obtained

`curl -X PUT http://localhost/wishes/392c8b1b-cead-49c0-a17f-fa6db037ae07/state/obtained -H 'application/json'`

- Move to archive

`curl -X PUT http://localhost/wishes/392c8b1b-cead-49c0-a17f-fa6db037ae07/state/archived -H 'application/json'`

- Delete

`curl -X DELETE http://localhost/wishes/392c8b1b-cead-49c0-a17f-fa6db037ae07`

- Index

`curl -X GET http://localhost/wishes`