# PHP & MySQL ontwikkelomgeving

Een lokale ontwikkelomgeving met PHP, MariaDB en PHPMyAdmin via Docker.

---

## Eenmalige installatie

1. Download en installeer **Docker Desktop**:
   - Windows: https://www.docker.com/products/docker-desktop/
   - Mac: https://www.docker.com/products/docker-desktop/

2. Start Docker Desktop en wacht tot het klaar is (het walvisje in de taakbalk brandt).

   > **Windows:** Docker Desktop vereist WSL2. Bij Windows 11 wordt dit automatisch geïnstalleerd. Bij Windows 10 kan het zijn dat je dit handmatig moet doen — Docker Desktop vraagt er om als dat nodig is.

3. Clone de repository **buiten** OneDrive/Dropbox/iCloud:
   ```bash
   # Goed:  C:\dev\  of  ~/dev/
   # Fout:  OneDrive, Documenten, iCloud Drive
   git clone https://github.com/St-Michael-College/informatica-phpsql.git
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

---

## Classroom safety: don't remove the root password

- Never set the MariaDB root password to an empty value — this allows anyone or automated tools to access and modify student data.
- Use the `MARIADB_ROOT_PASSWORD` variable in `docker-compose.yml` (default: `root` in this project) and do not commit changes that set it blank.
- To reset the environment (this removes all student data):
```bash
docker compose down -v
docker compose up -d
```

If you want to change the root password, update `MARIADB_ROOT_PASSWORD` and then reinitialize the stack (data will be wiped) or ALTER the user inside the DB as described in the classroom notes.

---

## Troubleshooting: port binding and what happened here

- **Cause:** Docker could not publish host port `8081` for the `phpmyadmin` container on this machine. This can happen when a host process already holds the port, Windows/Docker Desktop networking temporarily fails, or firewall/network rules block Docker from binding the port. In this run the container started but Compose did not show a host binding for `8081`, so requests to `http://localhost:8081` were refused.

- **What I did (solution):** I started a temporary phpMyAdmin container bound to `8082` and verified it served correctly. Then I updated `docker-compose.yml` to publish `8082:80` for the `phpmyadmin` service so the mapping is permanent for the project.

- **How to apply the change on your machine:** after pulling the update, run from the project folder:
```powershell
docker compose down
docker compose up -d
```
This recreates containers so the new `8082:80` mapping will be published.

- **How to revert to 8081 (only if you free the port):** if you later free/confirm `8081` is available, edit `docker-compose.yml` and change the phpMyAdmin port line back to `"8081:80"`, then run `docker compose down && docker compose up -d` again.

- **Quick check for a blocked port:** on Windows run `netstat -ano | findstr :8081` to see if a host PID is using the port. If so, inspect with `tasklist /FI "PID eq <PID>"` and stop it if safe.

If you want, I can also add an `.env.example` and switch `docker-compose.yml` to read ports from an env file to make it safer for students.
