<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Esercizio 1 - Prima Connessione</title>
    <link rel="stylesheet" href="../../assets/css/style.css">
</head>
<body>
    <div class="container">
        <div class="breadcrumb">
            🏠 <a href="../../">Home</a> <span>›</span> <a href="../">Giorno 1</a> <span>›</span> Esercizio 1
        </div>
        
        <h1>🔌 Esercizio 1: Prima Connessione al Database</h1>
        
        <?php
        // Includi file di configurazione
        require_once '../../config/db_config.php';
        
        // Variabili per memorizzare messaggi
        $messaggio = '';
        $tipo = '';
        $info_database = '';
        
        try {
            // Tenta la connessione al database (PDO lancia un'eccezione se fallisce)
            $pdo = connetti_database();
            
            $messaggio = "Connessione al database riuscita!";
            $tipo = "success";
            
            // Ottieni informazioni aggiuntive sul database
            $driver = $pdo->getAttribute(PDO::ATTR_DRIVER_NAME);
            $versione = $pdo->getAttribute(PDO::ATTR_SERVER_VERSION);
            
            if ($driver === 'sqlite') {
                $nome_db = basename(SQLITE_FILE);
                $charset = $pdo->query("PRAGMA encoding")->fetchColumn();
            } else {
                $nome_db = DB_NAME;
                $charset = $pdo->query("SELECT @@character_set_connection")->fetchColumn();
            }
            
            $info_database = "
                <div class='info'>
                    <strong>ℹ️ Informazioni Database:</strong>
                    🗄️ Driver PDO: <strong>" . htmlspecialchars($driver) . "</strong><br>
                    📦 Database: <strong>" . htmlspecialchars($nome_db) . "</strong><br>
                    🔢 Versione: <strong>" . htmlspecialchars($versione) . "</strong><br>
                    🔤 Charset: <strong>" . htmlspecialchars($charset) . "</strong>
                </div>
            ";
            
            // Chiudi la connessione
            chiudi_database($pdo);
        } catch (PDOException $e) {
            $messaggio = "Errore di connessione: " . $e->getMessage();
            $tipo = "error";
        }
        ?>
        
        <!-- Visualizza il messaggio -->
        <?php if ($tipo === 'success'): ?>
            <div class="icon">✅</div>
        <?php else: ?>
            <div class="icon">❌</div>
        <?php endif; ?>
        
        <div class="message <?php echo $tipo; ?>">
            <?php echo htmlspecialchars($messaggio); ?>
        </div>
        
        <?php echo $info_database; ?>
        
        <div style="margin-top: 30px; text-align: center; color: #666; font-size: 14px;">
            <p>📚 <strong>Giorno 1</strong> - Esercizio 1</p>
            <p>PHP con PDO</p>
        </div>
    </div>
</body>
</html>
