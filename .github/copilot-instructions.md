# Istruzioni per AI Coding Agents

Questo repository contiene esercizi didattici di PHP con PDO per studenti.

## Contesto del Progetto

### Scopo
Repository educativo per insegnare PHP procedurale con PDO a studenti in ambiente laboratorio/casa.

### Ambienti di Sviluppo
1. **Laboratorio/Casa**: Windows con XAMPP (htdocs) + VSCode
2. **Online**: Altervista con caricamento FTP tramite VSCode (task del profilo)
3. **VSCode**: profilo `5sia_lab112` (https://gist.github.com/sonia-guerci/919b29e9d19bd9c56305630e88d89c08) con estensioni, snippet `php-pdo*` e task numerati (es. "4. Avvia Server PHP (file corrente)" su `http://localhost:3000`, radice = cartella del progetto)

### Configurazione
- **File di configurazione**: `config/db_config.php` (UNICO file, nessun template/local/env)
- **Database**: costante `DB_DRIVER` in `config/db_config.php`: `'sqlite'` (predefinito, file `database/biblioteca.sqlite` creato in automatico da `database/schema_sqlite.sql`) oppure `'mysql'` (`database/schema.sql`)
- **Credenziali XAMPP**: user=`root`, password=`` (vuota)
- **Credenziali Altervista**: user=`username`, database=`my_username`

## Linee Guida per Modifiche

### Priorità
1. **Semplicità**: Il codice deve essere comprensibile per principianti
2. **Didattica**: Privilegiare chiarezza su efficienza
3. **PHP Procedurale**: NO OOP, NO framework, solo PHP procedurale
4. **PDO**: Usare PDO (NO MySQLi) con `connetti_database()`; SQL portabile, valido sia per SQLite sia per MySQL

### Struttura File
```
esercizi-php/
├── index.html              # Home navigabile
├── docs/
│   └── index.html          # Documentazione HTML (NON markdown)
├── config/
│   └── db_config.php       # UNICO file configurazione
├── database/
│   ├── schema.sql          # Schema MySQL
│   └── schema_sqlite.sql   # Schema SQLite
├── lezioni/                # Tutorial: lezione-01.html ... lezione-08.html (si riparte da zero)
└── lavoro/                 # Cartella di lavoro degli studenti (solo connessione.php e css/)
    └── connessione.php     # Crea $pdo e gestisce i messaggi di sessione
```

**Soluzione ed esempi**: il portale completo (`biblioteca/`) è incluso nello stesso branch delle lezioni, quindi è visibile agli studenti. Convenzione dei file: un file per operazione (`categorie.php`, `_insert`, `_delete`, `_edit`, `_update`); `libri*`, `autori*`, `libro_autori*` per 1:N e N:M (tabella ponte); `catalogo_ajax.php` per la lezione finale con fetch.

### Convenzioni Codice

#### PHP
- Stile: **Procedurale** (no classi, no namespace)
- Funzioni: `snake_case`
- Variabili: `snake_case` o `camelCase` (consistente)
- Costanti: `UPPER_SNAKE_CASE`
- Commenti: **Italiano**
- Indentazione: 4 spazi

#### Database
- PDO con `ERRMODE_EXCEPTION` e `FETCH_ASSOC` (NO MySQLi), gestione errori con try/catch
- Sempre prepared statements per sicurezza, con segnaposto posizionali `?` e `execute([$a, $b])` (NO parametri nominali `:nome`, NO sintassi `=>` negli array di `execute`): è la convenzione usata in classe
- Funzioni helper: `connetti_database()` (ritorna un oggetto PDO), `chiudi_database($pdo)`
- Charset: UTF-8 (utf8mb4)

#### HTML/CSS
- HTML5 semantico
- CSS inline o in `<style>` per semplicità
- Form con validazione lato server
- Responsive design base

### Cosa NON Fare
❌ Non usare framework (Laravel, Symfony, ecc.)
❌ Non usare Composer o package manager
❌ Non usare OOP avanzata
❌ Non usare MySQLi
❌ Non creare file .env o sistemi di config complessi
❌ Non usare JavaScript framework (Vue, React, ecc.)
❌ Non modificare la struttura principale senza necessità

### Cosa Fare
✅ Codice PHP procedurale semplice e chiaro
✅ PDO con prepared statements (segnaposto `?`)
✅ Un file per operazione (`x.php`, `x_insert.php`, `x_delete.php`, `x_edit.php`, `x_update.php`), messaggi tra pagine con `$_SESSION['messaggio']`
✅ JavaScript (solo ultima lezione): `fetch` con funzioni con nome e `async/await`, il PHP restituisce frammenti HTML (NO JSON); NO funzioni anonime/arrow function/`.then`; `onclick` diretto sui pulsanti, NO `addEventListener`
✅ Commenti esplicativi in italiano
✅ Validazione input server-side
✅ Gestione errori appropriata
✅ HTML/CSS pulito e leggibile
✅ Documentazione HTML (non Markdown per guide principali)

## Documentazione

### Formato
- **Guide setup**: HTML (`docs/index.html`) per visualizzazione diretta in htdocs/Altervista
- **Lezioni**: HTML in `lezioni/` (una per passo, `index.html` è l'indice)
- **Codice**: Commenti inline in italiano

### Aggiornamento Documentazione
Quando modifichi configurazione o workflow:
1. Aggiorna `docs/index.html` (non creare nuovi .md)
2. Aggiorna `README.md` con riferimenti alla guida HTML
3. Mantieni coerenza tra tutte le guide

## Testing

### Ambienti di Test
1. XAMPP su Windows (ambiente target principale)
2. PHP built-in server per test rapidi (`php -S localhost:3000` dalla radice)
3. Altervista per test deployment
4. Entrambi i driver: SQLite e MySQL

### Verifica Modifiche
Quando aggiungi/modifichi esercizi:
1. Testa su XAMPP Windows con credenziali default
2. Verifica che `config/db_config.php` funzioni
3. Controlla che non ci siano dipendenze da librerie esterne
4. Verifica encoding UTF-8 per caratteri accentati
5. Testa form e validazione input

## Sicurezza

### Best Practices da Rispettare
- Prepared statements per tutte le query con input utente
- Escape output con `htmlspecialchars()`
- Validazione server-side sempre
- Password hashing con `password_hash()`
- Session management sicuro

### Note
- Il file `config/db_config.php` è nel repository per scopi didattici
- Contiene credenziali di esempio (root/vuoto per XAMPP)
- Studenti devono modificarlo con le proprie credenziali

## Risorse

### Link Utili
- [PHP Manual (IT)](https://www.php.net/manual/it/)
- [PDO Reference](https://www.php.net/manual/it/book.pdo.php)
- [XAMPP Download](https://www.apachefriends.org/it/)
- [Altervista](https://it.altervista.org/)

### Repository
- GitHub: `itzanon-sia-2026-2027/esercizi-php`
- Documentazione: Apri `index.html` o `docs/index.html` nel browser

## Changelog

### Come Mantenere Aggiornato
Quando fai modifiche significative:
1. Aggiorna questa documentazione
2. Aggiorna `docs/index.html` se cambia setup/workflow
3. Aggiungi note nella PR description
4. Mantieni il README.md principale aggiornato

---

**Ultimo aggiornamento**: 2025-12-23
**Configurazione**: File unico `config/db_config.php`
**Documentazione**: HTML in `docs/index.html`
