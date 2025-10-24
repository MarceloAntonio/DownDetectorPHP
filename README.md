# Painel Down Detector 🚦

Um painel de monitoramento simples, para ser usado de modelo para implementação de um downdetctor em sites da intituição, desenvolvido em PHP e containerizado com Docker, que verifica o status (HTTP 200) de uma lista pré-definida de sites. Ele fornece uma visão rápida do que está "No Ar" (🟩) ou "Fora do Ar" (🟥).

O projeto é totalmente empacotado com Docker e Docker Compose, garantindo um setup de ambiente com zero atrito.

## ✨ Features Principais

- **Verificação de Status:** Utiliza PHP-cURL para verificar se os sites retornam o código HTTP 200.
- **Feedback Visual:** Exibe um ícone 🟩 (No ar) ou 🟥 (Fora do ar) para cada site.
- **Filtro Dinâmico:** Permite filtrar a lista de sites em tempo real usando JavaScript.
- **Recarregamento Automático:** A página atualiza automaticamente a cada 60 segundos.
- **Ambiente Containerizado:** Configuração de ambiente 100% gerenciada por Docker e Docker Compose.

## 🚀 Stack Tecnológica (Pré-requisitos)

Para executar este projeto, você precisará apenas de:

- **Docker:** (Qualquer versão recente)
- **Docker Compose:** (Qualquer versão recente)

O ambiente interno do container (definido no `Dockerfile`) gerencia:
- `PHP 8.2`
- `Servidor Apache`
- Extensão `php-curl`

## 🛠️ Configuração do Ambiente (Setup)

1.  **Clone o repositório:**
    ```bash
    git clone https://github.com/MarceloAntonio/DownDetectorPHP
    ```

2.  **Estrutura de Arquivos (Crítico):**
    O `docker-compose.yml` espera que seu código-fonte esteja em um diretório `./src`. Crie a seguinte estrutura:

    ```
    .
    ├── docker-compose.yml
    ├── Dockerfile
    └── src/
        ├── index.php         <-- (Seu arquivo PHP principal)
        └── Assets/
            ├── style.css
            ├── favicon.ico
            └── Logo.png
    ```

3.  **Personalize o `<title>` e o `<footer>`:**
    ```html
      <title>Sua Instituição aqui - DownDetector</title>
    ```
    ```html
    <p> Copyright © 2025 - Sua instituição aqui | All Rights Reserved </p>
    ```

4.  **Configure os Sites (src/index.php):**
    Abra o arquivo `src/index.php` e edite o array `$Sites` para incluir as URLs que você deseja monitorar:

    ```php
    // Em src/index.php
    $Sites = [
        "[https://github.com]",
        "[https://www.google.com/]",
        "[https://seu-outro-site.com]"
    ];
    ```

## 📦 Instalação, Build e ativação da aplicação

O Docker Compose cuida do build da imagem automaticamente. Para Criar e rodar o serviço basta rodas o seguinte comando 

```bash
docker-compose up -d --build
````

O container `php_curl_app` será construído (se ainda não foi) e iniciado em background. A porta `8080` do seu host será mapeada para a porta `80` do container.

Para parar a aplicação:

```bash
docker-compose down
```

## 🖥️ Acessando o Painel

Após iniciar o container, acesse o painel no seu navegador:

  - **URL:** `http://localhost:8080`

## 📁 Estrutura do Projeto

A estrutura de arquivos final deve ser:

```
.
├── docker-compose.yml    # Orquestra o serviço
├── Dockerfile            # Define a imagem (PHP + Apache + cURL)
└── src/                  # Montado como o web root (/var/www/html)
    ├── index.php         # Lógica principal e HTML
    └── Assets/
        ├── style.css     # (Estilos)
        ├── favicon.ico   # (Ícone)
        └── Logo.png      # (Logo no rodapé)
```

## ⚖️ Licença

Este projeto está sob a licença MIT. Veja o arquivo [LICENSE](LICENSE) para mais detalhes.
