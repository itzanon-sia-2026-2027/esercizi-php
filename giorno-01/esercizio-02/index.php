<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Esercizio 2 - Lista Studenti</title>
    <link rel="stylesheet" href="../../assets/css/style.css">
</head>
<body>
    <div class="container">
        <div class="breadcrumb">
            🏠 <a href="../../">Home</a> <span>›</span> <a href="../">Giorno 1</a> <span>›</span> Esercizio 2
        </div>
        
        <h1>👥 Lista Studenti</h1>
        <p class="subtitle">📚 Giorno 1 - Esercizio 2</p>
        
        <?php
        // Includi file di configurazione e funzioni comuni
        require_once '../../config/db_config.php';
        require_once '../../utils/functions.php';
        
        try {
            // Connetti al database
            $pdo = connetti_database();
            
            // Query per ottenere tutti gli studenti (statica, senza input utente)
            $query = "SELECT id, nome, cognome, email, data_nascita, citta, corso 
                      FROM studenti 
                      ORDER BY cognome, nome";
            
            // Esegui la query e ottieni tutte le righe in un array
            $stmt = $pdo->query($query);
            $studenti = $stmt->fetchAll();
        } catch (PDOException $e) {
            echo '<div class="error">❌ Errore database: ' . 
                 htmlspecialchars($e->getMessage()) . '</div>';
            exit;
        }
        
        // Conta il numero di risultati
        $num_studenti = count($studenti);
        ?>
        
        <!-- Mostra il numero totale di studenti -->
        <div class="info-box">
            📊 Totale Studenti: <strong><?php echo $num_studenti; ?></strong>
        </div>
        
        <?php if ($num_studenti > 0): ?>
            <!-- Tabella con i dati degli studenti -->
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Cognome</th>
                        <th>Email</th>
                        <th>Data Nascita</th>
                        <th>Città</th>
                        <th>Corso</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($studenti as $studente): ?>
                        <tr>
                            <td><strong>#<?php echo htmlspecialchars($studente['id']); ?></strong></td>
                            <td><?php echo htmlspecialchars($studente['nome']); ?></td>
                            <td><?php echo htmlspecialchars($studente['cognome']); ?></td>
                            <td><?php echo htmlspecialchars($studente['email']); ?></td>
                            <td>
                                <?php 
                                if ($studente['data_nascita']) {
                                    echo formatta_data_italiana($studente['data_nascita']);
                                } else {
                                    echo '-';
                                }
                                ?>
                            </td>
                            <td>📍 <?php echo htmlspecialchars($studente['citta']); ?></td>
                            <td>
                                <span class="badge badge-primary">
                                    <?php echo htmlspecialchars($studente['corso']); ?>
                                </span>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <!-- Messaggio se non ci sono studenti -->
            <div class="no-data">
                📭 Nessuno studente trovato nel database.
            </div>
        <?php endif; ?>
        
        <?php
        // Chiudi la connessione al database
        chiudi_database($pdo);
        ?>
        
        <div class="footer">
            <p>🔗 Esercizio completato con successo!</p>
            <p>PHP con PDO</p>
        </div>
    </div>
</body>
</html>
