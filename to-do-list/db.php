<?php

$host = '127.0.0.1';
$db   = 'to-do-list';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host={$host};dbname={$db};charset={$charset}";
$options = [
  PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
  PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
  $pdo = new PDO($dsn, $user, $pass, $options);
  // echo "<h3>$db Connected Successfully.</h3>";
} catch (\PDOException $e) {
  http_response_code(500);
  echo json_encode(['error' => 'Database connection failed']);
  exit;
}
