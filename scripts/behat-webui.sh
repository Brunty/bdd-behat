#!/usr/bin/env bash
docker exec -it bdd_php_1 /app/bin/behat --suite=webui -c /app/behat.yml