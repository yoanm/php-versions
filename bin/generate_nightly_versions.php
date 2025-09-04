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
$qaReleaseList = array_filter(
  $QA_RELEASES, 
  fn (string $key): bool => !array_key_exists(_format_short_version($key), $activeVersionList),
  ARRAY_FILTER_USE_KEY,
);

$output = [];
foreach ($qaReleaseList as $version => $data) {
  if (is_array($data) && $data['active'] === true && $data['release']['number'] > 0) {
    $rootKey = preg_replace('/^(\d+)\..*$/', '\1', $v);
    $subKey = _format_short_version($version);
    $output[$rootKey] ?= []
    $output[$rootKey][$subKey] ?= []
    $output[$rootKey][$subKey][$version] = $data;
  }
}
ksort($output, SORT_REGULAR);

echo json_encode($output, JSON_PRETTY_PRINT)."\n";
