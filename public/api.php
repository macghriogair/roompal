<?php

require_once __DIR__ . "/../vendor/autoload.php";
ini_set('max_execution_time', 60);
header('Content-Type: application/json;charset=utf-8');

try {
    $config = require __DIR__ . '/../config.php';
    $client = isset($_GET['client']) ? $_GET['client'] : null;
    $parser = new \Macghriogair\Konfi\ICalReader($config, $client);
    $data = $parser->parse();

    // sort by start date
    usort($data, function($a, $b) {
        return $a->sort - $b->sort;
    });

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
