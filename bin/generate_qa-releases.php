<?php
include "../web-php-repo/include/branches.inc";
include "../web-php-repo/include/release-qa.php";


function _format_short_version(string $v): string {
    return preg_replace('/^(\d+\.\d+).*$/', '\1', $v);
}
$activeVersionList = array_flip(
    array_merge(
        ...array_values(
            array_map(
                static fn (array $data): array => array_keys($data),
                get_active_branches()
            )
        )
    )
);
$qaReleaseList = $QA_RELEASES;
ksort($qaReleaseList, SORT_REGULAR);

$releaseList = [];
$nightly = null;
foreach ($qaReleaseList as $version => $data) {
    if (is_array($data) && $data['active'] === true && $data['release']['number'] > 0) {
        $majorVersion = preg_replace('/^(\d+)\..*$/', '\1', $version);
        $shortVersion = _format_short_version($version);
        $isSupported = array_key_exists($shortVersion, $activeVersionList);

        $releaseList[$majorVersion] ??= [];
        $releaseList[$majorVersion][$shortVersion] = [
            ...$data,
            'version' => $version,
            'short_version' => $shortVersion,
            'major_version' => $majorVersion,
            'supported' => $isSupported
        ];

        if (!$isSupported) {
            $nightly = $shortVersion;
        }
    }
}

echo json_encode($releaseList, JSON_PRETTY_PRINT)."\n";
