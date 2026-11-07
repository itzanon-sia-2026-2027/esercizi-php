# Esercizi PHP con PDO

Tutorial di **PHP con PDO** che parte da zero e porta a costruire un **portale gestionale completo** (biblioteca: categorie, libri, autori, relazione N:M). Si può usare con **SQLite** (nessuna installazione, un database per ogni studente) oppure con **MySQL** (XAMPP o Altervista), in locale o online.

## 🚀 Setup Rapido

### 1. Prepara VSCode (profilo `5sia_lab112`)

Importa il [profilo VSCode](https://gist.github.com/sonia-guerci/919b29e9d19bd9c56305630e88d89c08) (⚙️ → Profili → Importa profilo). Include estensioni (Intelephense, SQLTools, SFTP, Favorites panel), snippet PDO e task per avviare il server PHP, creare `connessione.php`, collegarsi ad Altervista, ecc.


### 2. Scarica il progetto

```bash
git clone https://github.com/itzanon-sia-2026-2027/esercizi-php.git

```

Apri la cartella con VSCode.

### 3. Segui le lezioni (MySQL)

Gli esercizi nella cartella `lavoro/` usano **MySQL**, come nelle lezioni. Avvia MySQL da XAMPP e importa `database/schema.sql` in phpMyAdmin: il file crea il database `biblioteca`.

1. Crea `lavoro/categorie.php` seguendo la [lezione 1](lezioni/lezione-01.html).
2. Esegui il task **"4. Avvia Server PHP (file corrente)"** (pulsante ▶️ nel pannello Favorites).
3. Si apre `http://localhost:3000/lavoro/categorie.php`.

*Senza il profilo VSCode:* assicurati di aver avviato i servizi di XAMPP, apri il terminale ed esegui `php -S localhost:3000` dalla cartella principale del progetto.

### 4. Configurazione MySQL per gli esercizi

La connessione degli esercizi è in `lavoro/connessione.php`. Per XAMPP i valori iniziali sono già pronti. Su Altervista modifica `$host`, `$db`, `$user` e `$pass` con i dati del tuo account:

| Ambiente | `$host` | `$user` | `$pass` | `$db` |
| --- | --- | --- | --- | --- |
| XAMPP | `localhost` | `root` | *(vuota)* | `biblioteca` |
| Altervista | `localhost` | `tuousername` | password database | `my_tuousername` |

### 5. Soluzione completa e SQLite

La soluzione pronta in `biblioteca/` tiene separate le connessioni: `biblioteca/connessione.mysql.php` contiene i dati MySQL, mentre `biblioteca/connessione.sqlite.php` crea e inizializza `database/biblioteca.sqlite`. Il selettore è `biblioteca/connessione.php`; per gli esercizi del corso continua a usare MySQL in `lavoro/`.

### 6. (Opzionale) Pubblicare su Altervista

1. Esegui il task **"1. Inizializza Progetto & SFTP Altervista"** e compila `.vscode/sftp.json`
2. Carica il progetto (`SFTP: Upload Project`)
3. Apri `https://NOMEACCOUNT.altervista.org/cartella/`

Con SQLite ogni cartella pubblicata ha il suo database: si aggira il limite di un solo database MySQL per account.

In alternativa, per pubblicare questo repository nella cartella `5bs/esercizi-php` usa la **workflow manuale GitHub Actions**. Configura i secret `FTP_USERNAME` e `FTP_PASSWORD` e avvia **Deploy su Altervista (Manuale)** dalla scheda Actions; trovi istruzioni e avvertenze nella [guida HTML](docs/index.html).

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
├── database/
│   ├── schema.sql          # Schema MySQL
│   ├── schema_sqlite.sql   # Schema SQLite (eseguito in automatico)
│   └── .htaccess           # Protegge il file .sqlite
├── lezioni/                # Lezioni del tutorial, incluso il passo 7b
├── biblioteca/             # Soluzione completa con connessioni MySQL e SQLite separate
└── lavoro/                 # Esercizi: connessione MySQL e CSS già pronti
```

## ⚙️ Configurazione Database

Negli esercizi, `lavoro/connessione.php` apre la connessione MySQL e gestisce i messaggi di sessione. In ogni pagina includi il file in cima:

```php
require_once 'connessione.php';

```

Per la soluzione completa, `biblioteca/connessione.php` seleziona il file di connessione della cartella `biblioteca/`; SQLite è la scelta iniziale. I due driver sono configurati separatamente in `biblioteca/connessione.sqlite.php` e `biblioteca/connessione.mysql.php`.

Le query utilizzano PDO con i **prepared statements** e i segnaposto `?` per garantire la sicurezza contro le SQL injection:

```php
$stmt = $pdo->prepare("SELECT * FROM libri WHERE id = ?");
$stmt->execute([$id]);
$libro = $stmt->fetch();

```

## 📚 Come Usare il Tutorial

1. Avvia il server (vedi sopra)
2. Segui le [lezioni](lezioni/index.html) in ordine, scrivendo il codice in una tua cartella:

   | # | Lezione |
   |---|---------|
   | 1 | Leggere i dati |
   | 2 | Inserire e cancellare |
   | 3 | Modificare |
   | 4 | Messaggi ed errori |
   | 5 | Seconda tabella: JOIN e menu a tendina |
   | 6 | Relazione N:M (padre-figlio) |
   | 7 | Il catalogo pubblico |
   | 7b | Ricerca nel catalogo e limite ai risultati |
   | 7c | Statistiche del catalogo |
   | 8 | fetch: aggiornare la pagina senza ricaricarla |

3. La soluzione completa (`biblioteca/`) è inclusa nel repository.

## 🔧 Problemi?

Consulta la sezione [Problemi Comuni](docs/index.html) della guida (driver PDO mancante, permessi SQLite, MySQL non avviato, FTP Altervista).

## 📝 Convenzioni

- **Lingua**: Commenti e documentazione in italiano
- **Stile**: PHP procedurale con PDO, sempre prepared statements con segnaposto `?`
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
