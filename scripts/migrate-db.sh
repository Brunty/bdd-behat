#!/usr/bin/env bash
docker exec -it bdd_php_1 /app/bin/console doctrine:migrations:migrate