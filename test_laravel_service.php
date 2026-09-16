<?php

require __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

$service = new App\Services\NextcloudService();
$tempFile = tempnam(sys_get_temp_dir(), 'test_');
file_put_contents($tempFile, 'Test Laravel service - ' . date('Y-m-d H:i:s'));

try {
    $service->uploadFile('test_laravel_service_' . time() . '.txt', $tempFile);
    echo '✅ Upload réussi via Laravel service !';
} catch (Exception $e) {
    echo '❌ Erreur: ' . $e->getMessage();
}

unlink($tempFile);