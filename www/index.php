<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8">
  <title>PHP & MySQL omgeving</title>
  <style>
    body { font-family: sans-serif; max-width: 700px; margin: 40px auto; padding: 0 20px; }
    .ok  { color: green; font-weight: bold; }
    .err { color: red;   font-weight: bold; }
    pre  { background: #f4f4f4; padding: 12px; border-radius: 4px; }
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
  <li><a href="http://localhost:8081">PHPMyAdmin (database beheer)</a></li>
</ul>

<h2>Database gegevens</h2>
<pre>
Host:      db
Database:  school
Gebruiker: student
Wachtwoord: student

Root wachtwoord: root  (alleen voor PHPMyAdmin)
</pre>

</body>
</html>
