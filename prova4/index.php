<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ScuolaGuidaDaGio</title>
    <link rel="stylesheet" href="styleee.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>
    <header>
        <h1>Scuola Guida Da Gio</h1>
        <h4>Prepariamo i guidatori di domani</h4>
        
    </header>

    <main>
        <div class="slider-container">
            <!-- <img class="mySlides" src="img1.jpg" alt="Immagine scuola guida" style="display:block;" > -->
            <img class="mySlides" src="img2.jpg" alt="Immagine scuola guida">

            <button class="slider-button left" onclick="changeSlide(-1)">&#10094;</button>
            <button class="slider-button right" onclick="changeSlide(1)">&#10095;</button>
        </div>

        <div class="contenuto-sotto-slider">
            <div class="avvisi_orari-box-sinistra">
                <div class="avvisi-box">
                    <?php
                            $conn = new mysqli("localhost", "root", "", "scuolaguida");
                            if ($conn->connect_error) {
                                die("Connessione fallita: " . $conn->connect_error);
                            }
                            $sql = "SELECT avviso, data_creazione FROM avviso ORDER BY data_creazione DESC";
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                                echo"<p class='dove_siamo' style='padding-left:10px;'><i class='fas fa-bell' style='padding-right:10px;'></i><strong> AVVISI</strong></p>";
                                echo "<ul>";
                                while ($row = $result->fetch_assoc()) {
                                    $data = date("d/m/Y", strtotime($row['data_creazione']));
                                    echo "<li ><strong>$data</strong>: " . htmlspecialchars($row['avviso']) . "</li>";
                                }
                                echo "</ul>";
                            }
                            $conn->close();
                    ?>
                </div>
                <div class="orari-box">
                    <p class="dove_siamo" style="margin-bottom:10px;padding-left:10px;" ><i class="fas fa-clock" style="padding-right:10px;"></i><strong> ORARI</strong></p>
                        <?php
                                $conn = new mysqli("localhost", "root", "", "scuolaguida");
                                if ($conn->connect_error) {
                                    die("Connessione fallita: " . $conn->connect_error);
                                }
                                $sql = "SELECT giorno, orari FROM orari WHERE orari != '' ORDER BY id ASC";
                                $result = $conn->query($sql);

                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo '<p><strong>' . htmlspecialchars($row['giorno']) . ': </strong> ' . htmlspecialchars($row['orari']) . '</p>';
                                    }
                                } else {
                                    echo "<p>Nessun orario disponibile.</p>";
                                }

                                $conn->close();
                        ?>
                </div>
            </div>

            <div class="mappa-box-destra">
                <p class="dove_siamo" style='text-align:center;'><i class="fas fa-map-marker-alt"></i><strong> DOVE SIAMO</strong></p>
                <p style='text-align:center;'>Via della liberta 13, Milano</p>
                <iframe 
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2889.9500933899426!2d9.191383115500003!3d45.46420337910059!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNDUuNDY0MjMsIDkuMTkxMzgz!5e0!3m2!1sit!2sit!4v1616085000000!5m2!1sit!2sit" 
                    allowfullscreen="" 
                    loading="lazy">
                </iframe>
            </div>
        </div>
        <div class="servizi-box">
            <button onclick="mostraSezione('consegui_patenti')">Conseguimento patenti</button>
            <button onclick="mostraSezione('rinnovo_patenti')">Rinnovo patente di guida</button>
            <button onclick="mostraSezione('revisione_patenti')">Revisione della patente</button>
            <button onclick="mostraSezione('conversione_patenti')">Conversione patente estera</button>
            <button onclick="mostraSezione('duplicato_patenti')">Duplicato patente smarrita o rubata</button>
        </div>
        <div class="zoom">
            <div class="sezione" id="consegui_patenti">
                <?php
                        $conn = new mysqli("localhost", "root", "", "scuolaguida");
                        if ($conn->connect_error) {die("Connessione fallita: " . $conn->connect_error);}
                        $sql = "SELECT patente, mezzi, eta, orari, info FROM patente";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            echo '<div class="grid-patenti">';
                            while($row = $result->fetch_assoc()) {
                                $patente = htmlspecialchars($row["patente"]);
                                $mezzi = htmlspecialchars($row["mezzi"]);
                                $eta = htmlspecialchars($row["eta"]);
                                $orari = htmlspecialchars($row["orari"]);
                                $info = htmlspecialchars($row["info"]);

                                echo '<div class="card-patente">';
                                    echo '<div class="titolo-patente">Patente ' . $patente . '</div>';
                                    echo '<div class="dettagli-patente">';
                                        echo '<p><strong>Mezzo:</strong> ' . $mezzi . '</p>';
                                        echo '<p><strong>Età minima:</strong> ' . $eta . ' anni</p>';
                                        echo '<p><strong>Orari:</strong> ' . $orari . '</p>';
                                        echo '<p><strong>Info:</strong> ' . $info . '</p>';
                                    echo '</div>';
                                echo '</div>';
                            }
                            echo '</div>';
                        } else {
                            echo "<p style='text-align: center; padding: 2rem;'>Nessuna patente trovata.</p>";
                        }
                        $conn->close();
                ?>
            </div>
            <div class="sezione" id="rinnovo_patenti">
                <div class="testo">
                    <div class="card-servizi">
                        <p>Offriamo un servizio completo per il rinnovo della patente di guida. Il nostro staff ti guiderà nella prenotazione della visita medica in sede.</p>
                        <p style="margin-top: 10px;"><strong>Per il rinnovo, è necessario presentare:</strong></p>
                        <ul>
                            <li>Patente in scadenza o scaduta da meno di 5 anni</li>
                            <li>Codice fiscale</li>
                            <li>Documento d'identità in corso di validità</li>
                            <li>2 fototessere recenti</li>
                        </ul>
                        <p>Una volta effettuata la visita medica, ci occupiamo noi dell'invio della documentazione alla Motorizzazione.</p>
                    </div>
                </div>
            </div>
            <div class="sezione" id="revisione_patenti">
                <div class="testo">
                    <div class="card-servizi">
                        <p>Prepariamo i candidati all'esame di revisione della patente, obbligatorio in caso di sospensione o revoca. Offriamo supporto sia per la parte teorica che per quella pratica.</p>
                        <p style="margin-top: 10px;"><strong>Per iniziare la procedura servono:</strong></p>
                        <ul>
                            <li>Documento di notifica della revisione (della Prefettura o della Motorizzazione)</li>
                            <li>Documento d'identità</li>
                            <li>Codice fiscale</li>
                            <li>2 fototessere</li>
                        </ul>
                        <p>Organizziamo anche simulazioni d'esame per aumentare le probabilità di successo.</p>
                    </div>
                </div>
            </div>
            <div class="sezione" id="conversione_patenti">
                <div class="testo">
                    <div class="card-servizi">
                        <p>Forniamo assistenza completa per la conversione di patenti estere in patenti italiane. Il servizio include la verifica della convertibilità, la compilazione dei moduli e la gestione degli appuntamenti.</p>
                        <p style="margin-top: 10px;"><strong>Per avviare la pratica occorrono:</strong></p>
                        <ul>
                            <li>Patente estera originale</li>
                            <li>Traduzione giurata (se necessaria)</li>
                            <li>Documento d'identità e codice fiscale</li>
                            <li>2 fototessere</li>
                            <li>Permesso di soggiorno in corso di validità (per cittadini extra-UE)</li>
                        </ul>
                        <p>Ci occupiamo di tutta la burocrazia fino al rilascio della patente italiana.</p>
                    </div>
                </div>
            </div>
            <div class="sezione" id="duplicato_patenti">
                <div class="testo">
                    <div class="card-servizi">
                        <p>In caso di smarrimento, furto o deterioramento della patente, ti aiutiamo ad ottenere rapidamente un duplicato. Gestiamo la denuncia e la pratica presso la Motorizzazione.</p>
                        <p style="margin-top: 10px;"><strong>Porta con te:</strong></p>
                        <ul>
                            <li>Denuncia presentata alle autorità (in caso di furto o smarrimento)</li>
                            <li>Documento d'identità e codice fiscale</li>
                            <li>2 fototessere recenti</li>
                            <li>Modulo di richiesta compilato (fornito da noi)</li>
                        </ul>
                        <p>Il duplicato viene generalmente spedito al domicilio indicato entro pochi giorni.</p>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer>
        <div class="footer-spacer"></div> 
        <div class="footer-center">
            <p>📞 +39 333 1236547 | 📧 info@scuolaguidagio.it</p>
            <p>&copy; 2025 Scuola Guida Da Gio</p>
        </div>
        <div class="header-buttons">
            <button class="quitz-btn" onclick="window.location.href='https://www.quizpatenteonline.it'">Area Quitz</button>
            <button class="area-personale-btn" onclick="window.location.href='accesso.php'">Area Personale</button>
        </div>
    </footer>

    <script>
        var slideIndex = 0;
        var slideInterval;
        function showSlide(n) {
            var slides = document.getElementsByClassName("mySlides");
            if (slides.length === 0) return;

            slideIndex = (n + slides.length) % slides.length;

            for (var i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }

            slides[slideIndex].style.display = "block";
        }
        function changeSlide(n) {
            showSlide(slideIndex + n);
            resetInterval();
        }
        function resetInterval() {
            clearInterval(slideInterval);
            slideInterval = setInterval(() => {
                showSlide(slideIndex + 1);
            }, 5000);
        }
        document.addEventListener("DOMContentLoaded", function() {
            showSlide(slideIndex);
            resetInterval();
            mostraSezione('consegui_patenti');
        });


        function mostraSezione(id) {
            const sezioni = document.querySelectorAll('.sezione');
            sezioni.forEach(sez => {
                sez.style.display = (sez.id === id) ? 'block' : 'none';
            });
        }
    </script>

</body>
</html>