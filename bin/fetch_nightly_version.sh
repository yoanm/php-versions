#!/usr/bin/env sh

set -eu

SCRIPT_PATH=$(dirname "$0")

jq -r 'last(.[] | .[] | select(.supported == false)) | .short_version' "${SCRIPT_PATH}/../qa-releases.json"
