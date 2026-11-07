// Carica i libri di una categoria e li scrive dentro il div "elenco_libri"
async function carica_libri(categoria_id, e) {
     // 1. Rimuovi la classe 'active' da tutti i bottoni
    const bottoni = document.querySelectorAll('.categorie-container button');
    bottoni.forEach(btn => btn.classList.remove('active'));

    // 2. Usa il target dell'evento passato per aggiungere la classe
    if (e && e.target) {
        e.target.classList.add('active');
    }

    // 3. fecth
    let risposta = await fetch("libri_frammento.php?categoria_id=" + categoria_id);
    let html = await risposta.text();
    document.getElementById("elenco_libri").innerHTML = html;
}

// Carica gli autori di un libro e li scrive dentro il div "autori_<id>"
async function carica_autori(libro_id, e) {

    // 1. Nasconde il bottone che è stato appena cliccato
    e.target.style.display = 'none';

    let risposta = await fetch("autori_frammento.php?libro_id=" + libro_id);
    let html = await risposta.text();
    document.getElementById("autori_" + libro_id).innerHTML = html;
}
