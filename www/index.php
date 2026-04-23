<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8">
  <title>PHP & MySQL omgeving</title>
  <style>
    :root{ --max-width:1100px; --accent:#2b6cb0; --muted:#666; }
    body { font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial; max-width: var(--max-width); margin: 28px auto; padding: 20px; color:#222; line-height:1.5 }
    h1,h2{ color:var(--accent); margin-top:1.2em }
    .ok  { color: #2a9d4a; font-weight: 700; }
    .err { color: #e63946; font-weight: 700; }
    pre  { background: #f7fafc; padding: 14px; border-radius: 6px; border: 1px solid #e6eef8; overflow:auto }
    code { background:#f1f5f9; padding:2px 6px; border-radius:4px; }
    ul{ padding-left:1.1rem }
    a{ color:var(--accent) }
    .meta { color:var(--muted); font-size:0.95rem }
    .phpinfo-frame{ width:100%; height:620px; border:1px solid #e6eef8; border-radius:6px }
    @media (max-width:800px){ body{padding:12px} .phpinfo-frame{height:420px} }
  </style>
</head>
<body>

<h1>PHP & MySQL omgeving</h1>

<h2>PHP</h2>
<p class="ok">✓ PHP <?= phpversion() ?> werkt!</p>

<h2>Database verbinding</h2>
<?php
$host = 'db';
$db   = 'school';
$user = 'student';
$pass = 'student';

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    echo '<p class="err">✗ Verbinding mislukt: ' . htmlspecialchars($conn->connect_error) . '</p>';
} else {
    echo '<p class="ok">✓ Verbinding met de database gelukt!</p>';
    $conn->close();
}
?>

<h2>Jouw PHP bestanden</h2>
<p>Zet jouw <code>.php</code> bestanden in de map <code>www/</code>.<br>
Ze zijn meteen beschikbaar op <a href="http://localhost:8080">http://localhost:8080</a>.</p>

<h2>Handige links</h2>
<ul>
  <li><a href="http://localhost:8080">Jouw PHP site</a></li>
  <li><a href="http://localhost:8082">PHPMyAdmin (database beheer)</a> — als dit niet werkt, probeer poort 8082 (we gebruiken 8082 wanneer 8081 geblokkeerd is)</li>
</ul>

<h2>Database gegevens</h2>
<pre>
Host:      db
Database:  school
Gebruiker: student
Wachtwoord: student

Root wachtwoord: root  (alleen voor PHPMyAdmin)
</pre>

<h2>PHP info</h2>
<p class="meta">Embedded phpinfo() output (for debugging PHP configuration).</p>
<iframe class="phpinfo-frame" src="/phpinfo.php" title="phpinfo"></iframe>

</body>
</html>
