#!/usr/bin/env sh

set -eu

SCRIPT_PATH=$(dirname "$0")

jq -r '(.[] | keys | sort) | first' "${SCRIPT_PATH}/../actives.json"
