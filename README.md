# Esercizi PHP con PDO

Tutorial a esercizi giornalieri di **PHP con PDO**, organizzati per difficoltà crescente. Si può usare con **SQLite** (nessuna installazione, un database per ogni studente) oppure con **MySQL** (XAMPP o Altervista), in locale o online.

## 🚀 Setup Rapido

### 1. Prepara VSCode (profilo `5sia_lab112`)

Importa il [profilo VSCode](https://gist.github.com/sonia-guerci/919b29e9d19bd9c56305630e88d89c08) (⚙️ → Profili → Importa profilo). Include estensioni (Intelephense, SQLTools, SFTP, Favorites panel), snippet PDO e task per avviare il server PHP, creare `connessione.php`, collegarsi ad Altervista, ecc.

### 2. Scarica il progetto

```bash
git clone https://github.com/itzanon-sia-2026-2027/esercizi-php.git
```

Apri la cartella con VSCode.

### 3. Avvia gli esercizi (SQLite, predefinito)

1. Apri `giorno-01/esercizio-01/index.php`
2. Esegui il task **"4. Avvia Server PHP (file corrente)"** (pulsante ▶️ nel pannello Favorites)
3. Si apre `http://localhost:3000/giorno-01/esercizio-01/index.php`

Il database `database/esercizi.sqlite` viene creato da solo, con i dati di esempio. Non serve avviare XAMPP.

Senza il profilo: `php -S localhost:3000` dalla cartella principale del progetto.

### 4. (Opzionale) Usare MySQL

In `config/db_config.php` imposta `DB_DRIVER` a `'mysql'`, inserisci le credenziali e importa `database/schema.sql`.

| Ambiente | DB_USER | DB_PASS | DB_NAME |
|----------|---------|---------|---------|
| XAMPP | `root` | _(vuota)_ | `esercizi_php` |
| Altervista | `username` | password database | `my_username` |

### 5. (Opzionale) Pubblicare su Altervista

1. Esegui il task **"1. Inizializza Progetto & SFTP Altervista"** e compila `.vscode/sftp.json`
2. Carica il progetto (`SFTP: Upload Project`)
3. Apri `https://NOMEACCOUNT.altervista.org/cartella/`

Con SQLite ogni cartella pubblicata ha il suo database: si aggira il limite di un solo database MySQL per account.

## 📖 Documentazione Completa

**👉 [Apri la Guida Completa (HTML)](docs/index.html) 👈**

Include: profilo VSCode e task, scelta SQLite/MySQL, setup XAMPP, Altervista, problemi comuni.
Per le buone pratiche vedi [docs/best-practices.md](docs/best-practices.md).

## 📁 Struttura del Repository

```
esercizi-php/
├── index.html              # Home con link alla documentazione
├── docs/
│   ├── index.html          # Guida setup interattiva
│   └── best-practices.md   # Buone pratiche PHP/PDO
├── config/
│   └── db_config.php       # Configurazione database (UNICO FILE)
├── database/
│   ├── schema.sql          # Schema MySQL
│   ├── schema_sqlite.sql   # Schema SQLite (eseguito in automatico)
│   └── .htaccess           # Protegge il file .sqlite
├── giorno-01/              # Esercizi giorno 1
├── giorno-02/              # Esercizi giorno 2
└── utils/
    └── functions.php       # Funzioni comuni
```

## ⚙️ Configurazione Database

**File unico**: `config/db_config.php`

```php
define('DB_DRIVER', 'sqlite');          // 'sqlite' oppure 'mysql'

// Solo per MySQL:
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'esercizi_php');
```

Negli esercizi la connessione si ottiene così (funziona con entrambi i database):

```php
require_once '../../config/db_config.php';

try {
    $pdo = connetti_database();
    $stmt = $pdo->prepare("SELECT * FROM studenti WHERE id = :id");
    $stmt->execute(['id' => $id]);
    $studente = $stmt->fetch();
} catch (PDOException $e) {
    echo 'Errore: ' . htmlspecialchars($e->getMessage());
}
```

## 📚 Come Usare gli Esercizi

1. Avvia il server (vedi sopra)
2. Vai agli esercizi:
   - `giorno-01/esercizio-01/` - Test connessione
   - `giorno-01/esercizio-02/` - Lista studenti
   - `giorno-01/esercizio-03/` - Dettagli studente
   - `giorno-02/esercizio-01/` - Inserimento (da completare)
   - `giorno-02/esercizio-02/` - Modifica ed eliminazione (da completare)

## 🔧 Problemi?

Consulta la sezione [Problemi Comuni](docs/index.html) della guida (driver PDO mancante, permessi SQLite, MySQL non avviato, FTP Altervista).

## 📝 Convenzioni

- **Lingua**: Commenti e documentazione in italiano
- **Stile**: PHP procedurale con PDO, sempre prepared statements
- **SQL**: standard, valido sia per SQLite sia per MySQL
- **Encoding**: UTF-8
- **Indentazione**: 4 spazi

## 🔗 Risorse Utili

- [PHP Manual](https://www.php.net/manual/it/)
- [PDO](https://www.php.net/manual/it/book.pdo.php)
- [SQLite](https://www.sqlite.org/docs.html)
- [XAMPP Download](https://www.apachefriends.org/it/index.html)
- [Altervista](https://it.altervista.org/)

## 📄 Licenza

Repository a scopo didattico.
