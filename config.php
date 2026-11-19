<?php
declare(strict_types=1);
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
if (session_status() !== PHP_SESSION_ACTIVE) {
    ini_set('session.use_strict_mode', '1');
    ini_set('session.use_only_cookies', '1');
    $https = !empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off';
    session_set_cookie_params(['lifetime'=>0,'path'=>'/','secure'=>$https,'httponly'=>true,'samesite'=>'Lax']);
    session_start();
}
header('X-Content-Type-Options: nosniff');
header('Referrer-Policy: strict-origin-when-cross-origin');
header('X-Frame-Options: SAMEORIGIN');
$host=getenv('DB_HOST')?:'localhost'; $user=getenv('DB_USER')?:'root'; $password=getenv('DB_PASSWORD')?:''; $database=getenv('DB_NAME')?:'bdsellami';
try { $db=new mysqli($host,$user,$password,$database); $db->set_charset('utf8mb4'); }
catch(mysqli_sql_exception $e) { http_response_code(500); exit('Connexion impossible. Importez bdsellami.sql et vérifiez les paramètres DB_HOST, DB_USER, DB_PASSWORD et DB_NAME.'); }
function h(string $v): string { return htmlspecialchars($v,ENT_QUOTES|ENT_SUBSTITUTE,'UTF-8'); }
function csrf(): string { if(empty($_SESSION['csrf'])) $_SESSION['csrf']=bin2hex(random_bytes(32)); return $_SESSION['csrf']; }
function verify_csrf(): void { if(!is_string($_POST['csrf']??null)||!hash_equals($_SESSION['csrf']??'',$_POST['csrf'])) { http_response_code(419); exit('Formulaire expiré. Rechargez la page.'); } }
