<?php
// check_config.php - run from project root: php check_config.php
$bad = [];
foreach (glob(__DIR__ . '/config/*.php') as $f) {
    $result = @include $f;
    if (!is_array($result)) {
        $bad[] = ['file' => basename($f), 'type' => gettype($result)];
    }
}
if (empty($bad)) {
    echo "All config files return arrays.\n";
} else {
    foreach ($bad as $b) {
        echo $b['file'] . " returns " . $b['type'] . "\n";
    }
}