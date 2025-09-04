[![Versions updater](https://github.com/yoanm/php-versions/actions/workflows/update-versions.yml/badge.svg?branch=master)](https://github.com/yoanm/php-versions/actions/workflows/update-versions.yml)

# php-versions
Container to retrieve php versions infos programmatically.

_Created to replace fetching infos from php.net website, as a DDOS prevention mechanism has been implemented, preventing people to use it programmatically._

## Active/Supported versions
See `actives.json` file, content is the same as [https://www.php.net/releases/active.php](https://www.php.net/releases/active.php)

Example with `7.4+` versions:
```json
{
    "7": {
        "7.4": { [...] },
    },
    "8": {
        "8.0": { [...] },
        "8.1": { [...] },
        [...]
    }
```

## Nightly versions
See `nightly-versions.json` file, content mostly comes from [https://www.php.net/release-candidates.php?format=json](https://www.php.net/release-candidates.php?format=json) but is filtered and enhanced

> [!CAUTION]
> Be aware that the list may be empty !
> 
> In that case, it means there is no nightly version to test at this point in time

The original content is filtered to remove dev versions for any currently supported versions (and therefore ends up with only nightly versions)

Resulting output ressemble to the one use for `actives.json` file !

Root keys and/or the `version` fields are most likely all you need.

Example with `8.5` version:
```json
{
  "8": {
    "8.5": {"version": "8.5.0", [...] }
  }
}
```

<hr/>

## Automatic updates

- Version files are updated each week on Sunday morning thanks to [`update-versions`](./.github/workflows/update-versions.yml) workflow

## Conditional requests - GitHub quota

In case you use gitHub API, you can leverage conditional requests mechanism to avoid consuming uselessly your quota if file hasn't been updated since your last fetch
