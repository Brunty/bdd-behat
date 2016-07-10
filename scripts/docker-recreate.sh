#!/usr/bin/env bash
DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"
bash ${DIR}/docker-down.sh
bash ${DIR}/docker-build.sh
bash ${DIR}/docker-up.sh
bash ${DIR}/docker-ps.sh