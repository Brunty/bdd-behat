#!/usr/bin/env bash
docker exec -it bdd_php_1 bin/console doctrine:migrations:migrate