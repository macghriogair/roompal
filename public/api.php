<?php

require_once __DIR__ . "/../vendor/autoload.php";

header('Content-Type: application/json;charset=utf-8');

try {
    $config = require __DIR__ . '/../config.php';
    $client = isset($_GET['client']) ? $_GET['client'] : null;
    $parser = new \Macghriogair\Konfi\ICalReader($config, $client);
    $data = $parser->parse();

    echo json_encode([
        'success' => true,
        'events' => $data,
        'total'=> count($data)
    ]);
} catch (\Exception $e) {
    echo json_encode([
        'success' => false,
        'error' => $e->getMessage()
    ]);
}
