<?php
/**
 * Utility e funzioni comuni per gli esercizi
 */

/**
 * Sanitizza input HTML per prevenire XSS
 * 
 * @param string $data Input da sanitizzare
 * @return string Input sanitizzato
 */
function pulisci_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
    return $data;
}

/**
 * Valida indirizzo email
 * 
 * @param string $email Email da validare
 * @return bool True se valida, false altrimenti
 */
function valida_email($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

/**
 * Valida data nel formato YYYY-MM-DD
 * 
 * @param string $data Data da validare
 * @return bool True se valida, false altrimenti
 */
function valida_data($data) {
    $d = DateTime::createFromFormat('Y-m-d', $data);
    return $d && $d->format('Y-m-d') === $data;
}

/**
 * Formatta data da YYYY-MM-DD a formato italiano DD/MM/YYYY
 * 
 * @param string $data Data in formato YYYY-MM-DD
 * @return string Data in formato DD/MM/YYYY
 */
function formatta_data_italiana($data) {
    if (!$data) return '';
    $d = DateTime::createFromFormat('Y-m-d', $data);
    return $d ? $d->format('d/m/Y') : $data;
}

/**
 * Genera messaggio di errore formattato
 * 
 * @param string $messaggio Messaggio di errore
 * @return string HTML del messaggio di errore
 */
function mostra_errore($messaggio) {
    return '<div class="alert alert-danger">' . pulisci_input($messaggio) . '</div>';
}

/**
 * Genera messaggio di successo formattato
 * 
 * @param string $messaggio Messaggio di successo
 * @return string HTML del messaggio di successo
 */
function mostra_successo($messaggio) {
    return '<div class="alert alert-success">' . pulisci_input($messaggio) . '</div>';
}

/**
 * Debug: stampa array o oggetto in modo leggibile
 * 
 * @param mixed $var Variabile da visualizzare
 * @return void
 */
function debug($var) {
    echo '<pre>';
    print_r($var);
    echo '</pre>';
}

/**
 * Esegue una query (con o senza parametri) e ritorna tutte le righe
 *
 * Usa sempre prepared statements: i valori forniti dall'utente
 * vanno passati in $parametri, MAI concatenati nella query.
 *
 * @param PDO $pdo Connessione database
 * @param string $sql Query SQL con eventuali segnaposto (? oppure :nome)
 * @param array $parametri Valori da associare ai segnaposto
 * @return array Array di righe (array associativi)
 *
 * @example
 * $studenti = esegui_query($pdo, "SELECT * FROM studenti");
 * $studente = esegui_query($pdo, "SELECT * FROM studenti WHERE id = ?", [$id]);
 * $studenti = esegui_query($pdo, "SELECT * FROM studenti WHERE citta = :citta", ['citta' => $citta]);
 */
function esegui_query($pdo, $sql, $parametri = []) {
    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute($parametri);
        return $stmt->fetchAll();
    } catch (PDOException $e) {
        // In produzione, loggare l'errore invece di mostrarlo
        error_log("Errore query: " . $e->getMessage());
        die("Si è verificato un errore nel recupero dei dati.");
    }
}

/**
 * Redirect a un'altra pagina in modo sicuro
 * 
 * ⚠️ IMPORTANTE: Accetta solo URL relativi per prevenire open redirect
 * 
 * @param string $url URL relativo di destinazione (es. 'index.php', '../lista.php')
 * @return void
 */
function redirect($url) {
    // Valida che l'URL sia relativo (non inizia con http:// o https:// o //)
    if (preg_match('#^(https?:)?//#i', $url)) {
        error_log("Tentativo di redirect a URL esterno bloccato: $url");
        die("Redirect non valido.");
    }
    
    header("Location: $url");
    exit();
}
?>
