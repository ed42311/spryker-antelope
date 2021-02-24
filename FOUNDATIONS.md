# Foundations

## Middleware

You will need to install the middleware package

```bash
composer require spryker-middleware/process
docker/sdk cli composer require spryker-middleware/process
```

If it fails with memory issues, we might want to buff the process a little bit up:

```bash
php -d memory_limit=-1 $(which composer) require spryker-middleware/process
```

### Antelope Middleware

```bash
console middleware:process:run -p ANTELOPE_PROCESS -i data/import/demo/in.json -o data/import/demo/out.json
```
