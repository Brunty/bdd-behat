#!/usr/bin/env bash
docker exec -it bdd_php_1 /app/bin/behat --suite=domain -c /app/behat.yml