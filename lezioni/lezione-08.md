# Lezione 8 (ultima) - fetch: aggiornare la pagina senza ricaricarla

**Obiettivo**: finora ogni azione ricarica la pagina. Con JavaScript `fetch` il browser chiede a PHP un **pezzo di HTML** e lo inserisce nella pagina già aperta.

Il PHP **non restituisce JSON**: restituisce direttamente HTML, scritto con le stesse tecniche di sempre.

## Come funziona

```
pulsante (onclick) -> funzione JavaScript -> fetch("pagina.php?...") -> PHP risponde con HTML -> innerHTML
```

## 1. Il PHP che restituisce un frammento: `libri_frammento.php`

Niente `<html>`, `<head>`, `<body>`: solo gli elementi che servono.

```php
<?php
require_once 'connessione.php';

$categoria_id = $_GET['categoria_id'];

$stmt = $pdo->prepare("SELECT id, titolo, anno_pubblicazione FROM libri WHERE categoria_id = ?");
$stmt->execute([$categoria_id]);
$libri = $stmt->fetchAll();

foreach ($libri as $l) { ?>
    <article>
        <h2><?= htmlspecialchars($l['titolo']) ?> (<?= $l['anno_pubblicazione'] ?>)</h2>
        <button onclick="carica_autori(<?= $l['id'] ?>)">Mostra autori</button>
        <div id="autori_<?= $l['id'] ?>"></div>
    </article>
<?php }
```

Anche i pulsanti del frammento hanno il loro `onclick`.

## 2. Il JavaScript: `js/catalogo.js`

```javascript
async function carica_libri(categoria_id) {
    let risposta = await fetch("libri_frammento.php?categoria_id=" + categoria_id);
    let html = await risposta.text();
    document.getElementById("elenco_libri").innerHTML = html;
}
```

- `fetch(...)` fa la richiesta; con `await` si aspetta la risposta (per questo la funzione è `async`).
- `risposta.text()` legge il corpo della risposta come testo (cioè l'HTML scritto dal PHP).
- `innerHTML` mette quel testo dentro il `div`.

**Regole di stile per questa lezione**: solo funzioni con nome (`function nome() { ... }`), niente funzioni anonime, niente frecce `=>`, niente `.then`. I pulsanti hanno l'attributo `onclick="nome_funzione(...)"` direttamente nell'HTML, senza `addEventListener`.

## 3. La pagina: `catalogo_ajax.php`

```php
<script src="js/catalogo.js"></script>
...
<?php foreach ($categorie as $c) { ?>
    <button onclick="carica_libri(<?= $c['id'] ?>)"><?= htmlspecialchars($c['nome']) ?></button>
<?php } ?>

<div id="elenco_libri"></div>
```

## Verifica

Apri `catalogo_ajax.php`: clicca una categoria e poi "Mostra autori". La pagina non si ricarica mai (guarda la scheda Rete degli strumenti di sviluppo del browser per vedere le richieste `fetch`).

## Esercizio

Scrivi `autori_frammento.php` e la funzione `carica_autori(libro_id)` (la soluzione è in `biblioteca/`).
