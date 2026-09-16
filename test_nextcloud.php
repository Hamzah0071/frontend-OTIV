<?php

// Test PHP direct avec curl
$baseUrl = 'http://otiv_nextcloud:80';
$username = 'admin';
$password = 'Otivdiana@2026/';

$testContent = "Test PHP direct - " . date('Y-m-d H:i:s');
$tempFile = tempnam(sys_get_temp_dir(), 'test_');
file_put_contents($tempFile, $testContent);

$url = $baseUrl . '/remote.php/dav/files/admin/test_php_' . time() . '.txt';

echo "Tentative d'upload vers: $url\n";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
curl_setopt($ch, CURLOPT_POSTFIELDS, file_get_contents($tempFile));
curl_setopt($ch, CURLOPT_USERPWD, $username . ':' . $password);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_TIMEOUT, 30);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$error = curl_error($ch);
curl_close($ch);

unlink($tempFile);

if ($error) {
    echo "❌ Erreur curl: $error\n";
} elseif ($httpCode >= 200 && $httpCode < 300) {
    echo "✅ Upload réussi ! (HTTP $httpCode)\n";
} else {
    echo "❌ Erreur HTTP $httpCode\n";
    echo "Réponse: $response\n";
}