# PHP & MySQL ontwikkelomgeving

Een lokale ontwikkelomgeving met PHP, MariaDB en PHPMyAdmin via Docker.

---

## Eenmalige installatie

1. Download en installeer **Docker Desktop**:
   - Windows: https://www.docker.com/products/docker-desktop/
   - Mac: https://www.docker.com/products/docker-desktop/

2. Start Docker Desktop en wacht tot het klaar is (het walvisje in de taakbalk brandt).

   > **Windows:** Docker Desktop vereist WSL2. Bij Windows 11 wordt dit automatisch geïnstalleerd. Bij Windows 10 kan het zijn dat je dit handmatig moet doen — Docker Desktop vraagt er om als dat nodig is.

3. Clone deze repository **buiten** OneDrive/Dropbox/iCloud:
   ```bash
   # Goed:  C:\dev\  of  ~/dev/
   # Fout:  OneDrive, Documenten, iCloud Drive
   git clone https://github.com/jklos-smc/informatica-phpsql.git
   cd informatica-phpsql
   ```

---

## Opstarten

```bash
docker compose up -d
```

De eerste keer duurt dit langer omdat Docker de benodigde images downloadt (~800 MB–1 GB).

Daarna open je:
| Wat | Adres |
|-----|-------|
| Jouw PHP site | http://localhost:8080 |
| PHPMyAdmin | http://localhost:8081 |

---

## Stoppen

```bash
docker compose down
```

Je database-inhoud blijft bewaard. Wil je alles wissen (inclusief de database)?

```bash
docker compose down -v
```

---

## PHP bestanden schrijven

Zet al je `.php` bestanden in de map `www/`. Ze zijn **meteen** zichtbaar op http://localhost:8080 — geen herstart nodig.

Voorbeeld: `www/mijnpagina.php` → http://localhost:8080/mijnpagina.php

---

## Database verbinden in PHP

```php
<?php
$conn = new mysqli('db', 'student', 'student', 'school');

if ($conn->connect_error) {
    die('Verbinding mislukt: ' . $conn->connect_error);
}

echo 'Verbonden!';
?>
```

| Instelling | Waarde |
|------------|--------|
| Host | `db` |
| Database | `school` |
| Gebruiker | `student` |
| Wachtwoord | `student` |

---

## Veelgestelde vragen

**De site laadt niet.**
Wacht 10-15 seconden na `docker compose up -d` en probeer opnieuw. De database heeft even tijd nodig om op te starten.

**Poort 8080 is al in gebruik.**
Verander in `docker-compose.yml` de regel `"8080:80"` naar bijvoorbeeld `"8090:80"` en herstart met `docker compose up -d`. Ga dan naar http://localhost:8090.

**PHPMyAdmin geeft een foutmelding.**
De database start soms iets langzamer op. Wacht even en herlaad de pagina.

**Hoe reset ik mijn database?**
```bash
docker compose down -v
docker compose up -d
```

**Docker Desktop staat niet aan.**
Start Docker Desktop eerst, wacht tot het walvisje stabiel brandt, en probeer daarna `docker compose up -d` opnieuw.
