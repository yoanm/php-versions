#!/usr/bin/env sh

set -eu

SCRIPT_PATH=$(dirname "$0")

jq -r '(.[] | keys | sort) | last' "${SCRIPT_PATH}/../actives.json"
