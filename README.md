[![Versions updater](https://github.com/yoanm/php-versions/actions/workflows/update-versions.yml/badge.svg?branch=master)](https://github.com/yoanm/php-versions/actions/workflows/update-versions.yml)

# php-versions
Container to retrieve php versions infos programmatically.

_Created to replace fetching infos from php.net website, as a DDOS prevention mechanism has been implemented, preventing people to use it programmatically._

## Active php versions
See `actives.json` file, content is the same as `https://www.php.net/releases/active.php`

<hr/>

## Automatic updates

- `actives.json` file is updated each week on Sunday morning thanks to [`update-versions`](./.github/workflows/update-versions.yml) workflow

## Conditional requests - GitHub quota

In case you use gitHub API, you can leverage conditional requests mechanism to avoid consuming uselessly your quota if file hasn't been updated since your last fetch