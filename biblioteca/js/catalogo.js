// Carica i libri di una categoria e li scrive dentro il div "elenco_libri"
async function carica_libri(categoria_id) {
    let risposta = await fetch("libri_frammento.php?categoria_id=" + categoria_id);
    let html = await risposta.text();
    document.getElementById("elenco_libri").innerHTML = html;
}

// Carica gli autori di un libro e li scrive dentro il div "autori_<id>"
async function carica_autori(libro_id) {
    let risposta = await fetch("autori_frammento.php?libro_id=" + libro_id);
    let html = await risposta.text();
    document.getElementById("autori_" + libro_id).innerHTML = html;
}
