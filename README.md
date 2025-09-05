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
        "7.4": { [...Original content...] },
    },
    "8": {
        "8.0": { [...Original content...] },
        "8.1": { [...Original content...] },
        [...]
    }
```


> [!TIP]
>
> - Find the **lowest** supported version:
>   ```bash
>   jq -r '(.[] | keys | sort) | first' actives.json
>   # output: 7.4
>   ```
> - Find the **latest** supported version:
>   ```bash
>   jq -r '(.[] | keys | sort) | last' actives.json
>   # output: 8.1
>   ```
>

## QA releases
See `qa-releases.json` file, content mostly comes from [https://www.php.net/release-candidates.php?format=json](https://www.php.net/release-candidates.php?format=json) but is filtered and enhanced.

> [!CAUTION]
> 
> Be aware that the list may be empty !
> 
> In that case, it means there is no QA releases to test at this point in time


The original content is filtered to remove versions without any releases available.

Additional properties are added:
- `version`: The long version (e.g. `X.Y.Z`)
- `short_version`: Major and minor version (e.g. `X.Y`)
- `major_version`: Only the major version (e.g. `X`)
- `supported`: Whether the version is supported (=active) or not.

Resulting output resemble to the one use for `actives.json` file !

Example with `8.5` version:
```json
{
  "8": {
    "8.4": {
      [...Original content...]
      "version": "8.4.12",
      "short_version": "8.4",
      "major_version": "8",
      "supported": true
    },
    "8.5": {
      [...Original content...]
      "version": "8.5.0",
      "short_version": "8.5",
      "major_version": "8",
      "supported": false
    }
  }
}
```

> [!TIP]
>
> In order to find the nightly version, you can use the following `jq` filter command:
> ```bash
> jq -r 'last(.[] | .[] | select(.supported == false)) | .short_version' qa-releases.json
> # output: 8.5
> ```
>

<hr/>

## Automatic updates

- Version files are updated each week on Sunday morning thanks to [`update-versions`](./.github/workflows/update-versions.yml) workflow

## Conditional requests - GitHub quota

In case you use gitHub API, you can leverage conditional requests mechanism to avoid consuming uselessly your quota if file hasn't been updated since your last fetch
