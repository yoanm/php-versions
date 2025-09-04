<?php

include "../web-php-repo/include/branches.inc";

echo json_encode(get_active_branches(), JSON_PRETTY_PRINT)."\n";
