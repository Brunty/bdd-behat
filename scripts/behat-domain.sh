#!/usr/bin/env bash
docker exec -it bdd_php_1 sh -c "bin/behat --suite=domain --append-snippets"
