#!/bin/bash

SCRIPT_DIRECTORY="$( cd "$( dirname "${BASH_SOURCE[0]}" )" >/dev/null 2>&1 && pwd )"

cd ${SCRIPT_DIRECTORY}/../../
/usr/local/bin/docker-compose stop
/usr/local/bin/docker-compose up -d database

cd ${SCRIPT_DIRECTORY}/../../application/

echo "${SCRIPT_DIRECTORY}/../../application/"

symfony server:stop
symfony server:start --port=8811 -d
