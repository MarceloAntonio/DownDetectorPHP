<?php
function VerificarStatus($url) {
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 5);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Para HTTPS sem verificação de certificado
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; DownDetectorToccato/1.0)');



    curl_exec($ch);

    
 
    if (curl_errno($ch)) {
        // Erro de conexão ou timeout
        $status = "🟥";
    } else {
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if ($httpCode == 200) {
            $status = "🟩"; // No ar
        }
         else {
            $status = "🟥"; // Outro tipo de resposta
        }
    }
    curl_close($ch);
    return $status;
}

//
$Sites = [

	"https://github.com",
	"https://www.google.com/"

];

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="Assets/style.css">
  <link rel='icon' type='image' href='/Assets/favicon.ico' />
  <title>[nome da empresa] - DownDetector</title>
</head>
<body>


    <main>
        <div id="Filtro">
    <div style="margin-bottom: 20px; text-align: center;">
  <input type="text" id="filtroSite" placeholder="Filtrar sites..." style="padding: 8px; width: 60%; font-size: large; border-radius: 8px; border: 1px solid #ccc;">
</div>

        <div id="ListaSites">
        <ul id="listaDeSites">
            <?php foreach($Sites as $site):  ?>
                <li>
                    <?php  echo VerificarStatus($site)?>
                    <a href="<?php echo htmlspecialchars($site)?>" target="_blank" rel="noopener noreferrer">
                    <?php echo htmlspecialchars($site)?>
                    </a>
                </li>
                <?php endforeach ?>
            </ul>
        </div>
        </div>
    </main>

<footer>
    
    <img src="Assets/Logo.png">
  <p> Copyright © 2025 - [Nome da empresa] | All Rights Reserved </p>
   <div id="Legenda">
    <br>
        <p>
           <p id="TituloLegenda"><strong>Legenda</strong></p>
    🟩 - No ar <br />
    🟥 - Fora do ar <br />
        </p>
        </div>
</footer>



<script>
    
     document.getElementById('filtroSite').addEventListener('input', function() {
    const filtro = this.value.toLowerCase();
    const lista = document.getElementById('listaDeSites');
    const itens = lista.getElementsByTagName('li');
    for (let i = 0; i < itens.length; i++) {
      const texto = itens[i].innerText.toLowerCase();
      itens[i].style.display = texto.includes(filtro) ? '' : 'none';
    }
  });

  setInterval(function() {
    location.reload();
  }, 60000);
</script>
</body>
</html>
