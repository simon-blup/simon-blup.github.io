<?php

session_start();

if (!isset($_SESSION['codiceFiscale']) || $_SESSION['ruolo'] !== 'insegnante') {
    header("Location: index.php");
    exit();
}

$conn = new mysqli("localhost", "root", "", "scuolaguida");
// AVVISI PULSANTI
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['form_type']) && $_POST['form_type'] === 'avvisi') {
    if (isset($_POST['elimina'])) {
        $id = intval($_POST['elimina']);
        $conn->query("DELETE FROM avviso WHERE num_avviso = $id");
    } elseif (isset($_POST['modifica'])) {
        $id = intval($_POST['id']);
        $testo = $conn->real_escape_string($_POST['testo']);
        $conn->query("UPDATE avviso SET avviso = '$testo', data_creazione = NOW() WHERE num_avviso = $id");
    } elseif (isset($_POST['nuovo'])) {
        $testo = $conn->real_escape_string($_POST['nuovo_testo']);
        $conn->query("INSERT INTO avviso (avviso) VALUES ('$testo')");
    }
    header("Location: " . $_SERVER['PHP_SELF'] . "#avvisi");
    exit();
}
$avvisi = $conn->query("SELECT * FROM avviso ORDER BY data_creazione DESC");

// PATENTI PULSANTI
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['form_type']) && $_POST['form_type'] === 'patenti') {
    if (isset($_POST['elimina'])) {
        $id = intval($_POST['elimina']);
        $conn->query("DELETE FROM patente WHERE num_patente = $id");
    } else{
        $id = intval($_POST['id']);
        $patente = $conn->real_escape_string($_POST['patente']);
        $mezzi = $conn->real_escape_string($_POST['mezzi']);
        $eta = $conn->real_escape_string($_POST['eta']);
        $veicolo = $conn->real_escape_string($_POST['veicolo']);
        $info = $conn->real_escape_string($_POST['info']);
        $orari = $conn->real_escape_string($_POST['orari']);

        if (isset($_POST['modifica'])){
            $conn->query("UPDATE patente SET mezzi = '$mezzi',eta = '$eta',veicolo = '$veicolo',foto = ' ',info = '$info',orari = '$orari' WHERE num_patente = $id");
        }
        elseif(isset($_POST['nuovo'])){
            $conn->query("INSERT INTO patente (num_patente,patente,mezzi,eta,veicolo,foto,info,orari) VALUES (NULL,'$patente','$mezzi','$eta','$veicolo',' ','$info','$orari')");
        }
    }
    header("Location: " . $_SERVER['PHP_SELF'] . "#patenti");
    exit();
}
$patenti = $conn->query("SELECT * FROM patente");

// ORARI GENERICI PULSANTI
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['form_type']) && $_POST['form_type'] === 'orari_generici') {
    if (isset($_POST['orari_gen'])) {
        foreach ($_POST['orari_gen'] as $id => $nuovo_orario) {
            $id = (int)$id;
            $orario_sanitizzato = $conn->real_escape_string($nuovo_orario);
            $conn->query("UPDATE orari SET orari='$orario_sanitizzato' WHERE id=$id");
        }
    }
    header("Location: " . $_SERVER['PHP_SELF'] . "#orari_generici");
    exit();
}
$orari_gen = $conn->query("SELECT * FROM orari ORDER BY id ASC");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Area privata</title>
    <link rel="stylesheet" href="gestione.css">
</head>

<body>
    <header id="header">
        <h1>Area Modifica</h1>
        <button class="logout-button" onclick="window.location.href='logout.php'">Logout</button>
    </header>
    <main>
        <div class="container">
            <div id="avvisi">
                <h2>Avvisi</h2>
            </div>

            <div id="patenti">
                <h2>Patenti</h2>
            </div>

            <div id="orari_generici">
                <h2>Orari generici</h2>
            </div>
        </div>
        <div class="contenitore_destra">
            <div id="avvisi_destra">

                <?php while ($row = $avvisi->fetch_assoc()): ?>
                    <form method="post" class="avviso-box">
                        <input type="hidden" name="form_type" value="avvisi">
                        <div class="data">
                            <?php
                            $data = new DateTime($row['data_creazione']);
                            echo $data->format('d/m/Y');
                            ?>
                        </div>
                        <div class="testo">
                            <input type="text" name="testo" value="<?= htmlspecialchars($row['avviso']) ?>">
                        </div>
                        <div class="azioni">
                            <input type="hidden" name="id" value="<?= $row['num_avviso'] ?>">
                            <button type="submit" name="modifica">Modifica</button>
                            <button type="submit" name="elimina" value="<?= $row['num_avviso'] ?>" onclick="return confirm('Sei sicuro di voler eliminare questo avviso?')">Elimina</button>
                        </div>
                    </form>
                <?php endwhile; ?>

                <div class="nuovo-box">
                    <h3>Nuovo Avviso</h3>
                    <form method="post">
                        <input type="hidden" name="form_type" value="avvisi">
                        <input type="text" name="nuovo_testo"><br>
                        <button type="submit" name="nuovo">Aggiungi Avviso</button>
                    </form>
                </div>

            </div>


            <div id="patenti_destra" style="display: none;">

                <?php while ($row = $patenti->fetch_assoc()): ?>
                    <form method="post" class="avviso-box">
                        <input type="hidden" name="form_type" value="patenti">
                        <div class="testo">
                            <label style='padding-left: 10px;'><strong><?php echo $row['patente']; ?></strong></label>
                            <input type="text" name="mezzi" value="<?= htmlspecialchars($row['mezzi']) ?>">
                            <input type="text" name="eta" value="<?= htmlspecialchars($row['eta']) ?>">
                            <input type="text" name="veicolo" value="<?= htmlspecialchars($row['veicolo']) ?>">
                            <input type="text" name="info" value="<?= htmlspecialchars($row['info']) ?>">
                            <input type="text" name="orari" value="<?= htmlspecialchars($row['orari']) ?>">
                        </div>
                        <div class="azioni">
                            <input type="hidden" name="id" value="<?= $row['num_patente'] ?>">
                            <button type="submit" name="modifica">Modifica</button>
                            <button type="submit" name="elimina" value="<?= $row['num_patente'] ?>" onclick="return confirm('Sei sicuro di voler eliminare questa patente?')">Elimina</button>
                        </div>
                    </form>
                <?php endwhile; ?>

                <div class="nuovo-box">
                    <h3>Nuova Patente</h3>
                    <form method="post">
                        <input type="hidden" name="form_type" value="patenti">
                        <input type="text" name="patente" placeholder="patente">
                        <input type="text" name="mezzi" placeholder="mezzi intesi">
                        <input type="text" name="eta" placeholder="eta minima">
                        <input type="text" name="veicolo" placeholder="veicolo per le guide">
                        <input type="text" name="info" placeholder="info">
                        <input type="text" name="orari" placeholder="orari"><br>
                        <button type="submit" name="nuovo">Aggiungi Patente</button>
                    </form>
                </div>

            </div>


            <div id="orari_generici_destra" style="display: none;">
                <div class="box_orari_gen">
                    <form method="post">
                        <input type="hidden" name="form_type" value="orari_generici">
                        <?php while ($row = $orari_gen->fetch_assoc()): ?>
                            <div class="riga_orario">
                                <label><strong><?php echo $row['giorno']; ?>:</strong></label>
                                <input type="text" name="orari_gen[<?php echo $row['id']; ?>]" value="<?php echo htmlspecialchars($row['orari']); ?>">
                            </div>
                        <?php endwhile; ?>
                        <div class="submit_container">
                            <input type="submit" value="Salva modifiche">
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </main>

    <script>

        document.getElementById("avvisi").addEventListener("click", function() {
            faiTutto("avvisi", "avvisi_destra");
        });
        document.getElementById("patenti").addEventListener("click", function() {
            faiTutto("patenti", "patenti_destra");
        });
        document.getElementById("orari_generici").addEventListener("click", function() {
            faiTutto("orari_generici", "orari_generici_destra");
        });
        
        //GESTIONE TASTI IMPOSTAZIONI SINISTRA
        function nascondiTuttiDivDestra() {
            const divDestra = document.querySelectorAll('.contenitore_destra > div');
            divDestra.forEach(divD => {
                divD.style.display = "none";
            });
            const divSinistra = document.querySelectorAll('.container > div');
            divSinistra.forEach(divS => {
                divS.classList.remove('attivo');
            });
        }

        function faiTutto($dato1, $dato2) {
            nascondiTuttiDivDestra();
            document.getElementById($dato1).classList.add('attivo');
            document.getElementById($dato2).style.display = "block";
        }
        

        //per tornare allimpostazione selezioanta dopo salvataggio 
        window.addEventListener('DOMContentLoaded', function() {
            const avvisi = document.getElementById("avvisi");
            const patenti = document.getElementById("patenti");
            const orari_generici = document.getElementById("orari_generici");
            if (window.location.hash === "#avvisi" && avvisi) {
                avvisi.click();
            }else if (window.location.hash === "#patenti" && patenti) {
                patenti.click();
            } else if (window.location.hash === "#orari_generici" && orari_generici) {
                orari_generici.click();
            }
        });
    </script>
</body>

</html>